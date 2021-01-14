<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Country;
use App\Favorite;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Wax\Core\Contracts\AuthorizationRepositoryContract;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = trans('app.users');

        $search = $request->input('search');
        if (!empty($search)) {
            $users = User::orWhere('email', 'like', '%' . $search . '%')
                ->orWhere('firstname', 'like', '%' . $search . '%')
                ->orWhere('lastname', 'like', '%' . $search . '%')
                ->paginate(20)
                ->appends(['search' => $search]);
        } else {
            $users = User::paginate(20);
        }


        return view('dashboard.users', [
            'title' => trans('app.users'),
            'users' => $users,
        ]);
    }

    public function userInfo($id)
    {
        $title = trans('app.user_info');
        $user = User::find($id);

        if (!$user) {
            return view('dashboard.error.error_404');
        }

        return view('dashboard.user_info', compact('title', 'user'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            abort(404);
        }

        if (Auth::user()->hasPrivilege('Users')) {
            $this->saveUserPermissions(
                $user,
                collect($request->input('permissions')),
            );
        }

        return redirect()
            ->back()
            ->with('success', 'Edited User');
    }

    protected function saveUserPermissions(User $user, Collection $permissions)
    {
        if ($user->id === Auth::user()->id) {
            // nah, the front-end won't let you edit yoruself. Gotta go to the developer
            return;
        }

        $authRepo = app()->make(AuthorizationRepositoryContract::class);
        $assignableGroups = Auth::user()->descendant_groups;
        $permissions
            ->each(function ($permission) use ($assignableGroups, $authRepo, $user) {
                if ($assignableGroups->pluck('name')->contains($permission)) {
                    $authRepo->addUserToGroup($user, $authRepo->getGroup($permission));
                } else {
                    throw new \Exception('Impermissable attempt by ' . Auth::user()->email . ' to give someone else ' . $permission);
                }
            });

        foreach ($assignableGroups as $deleteableGroup) {
            if (! $permissions->contains($deleteableGroup->name)) {
                $authRepo->removeUserFromGroup($user, $deleteableGroup);
            }
        }
    }

    public function profile()
    {
        $title = trans('app.profile');
        $user = Auth::user();
        return view('dashboard.profile.profile', compact('title', 'user'));
    }

    public function profileEdit()
    {
        $title = trans('app.profile_edit');
        $user = Auth::user();
        $countries = Country::all();

        return view('dashboard.profile.profile_edit', compact('title', 'user', 'countries'));
    }

    public function profileEditPost(Request $request)
    {
        $user_id = Auth::user()->id;
        $user = User::find($user_id);

        //Validating
        $this->validate(
            $request,
            [
                'email' => 'required|email|unique:users,email,' . $user_id,
                'newsletter_subscribed' => 'boolean',
            ]
        );

        $input = $request->only(['firstname', 'lastname', 'email', 'newsletter_subscription']);
        if (!isset($input['newsletter_subscription'])) {
            $input['newsletter_subscription'] = false;
        }

        $user
            ->whereId($user_id)
            ->update($input);

        return redirect(route('profile'))->with('success', trans('app.profile_edit_success_msg'));
    }

    public function changePassword()
    {
        $title = trans('app.change_password');
        return view('dashboard.change_password', compact('title'));
    }

    public function changePasswordPost(Request $request)
    {
        $rules = [
            'old_password'  => 'required',
            'new_password'  => 'required|confirmed',
            'new_password_confirmation'  => 'required',
        ];
        $this->validate($request, $rules);

        $old_password = $request->old_password;
        $new_password = $request->new_password;
        //$new_password_confirmation = $request->new_password_confirmation;

        if (Auth::check()) {
            $logged_user = Auth::user();

            if (Hash::check($old_password, $logged_user->password)) {
                $logged_user->password = Hash::make($new_password);
                $logged_user->save();
                return redirect()->back()->with('success', trans('app.password_changed_msg'));
            }
            return redirect()->back()->with('error', trans('app.wrong_old_password'));
        }
    }


    /**
     * @param Request $request
     * @return array
     */

    public function watchListing(Request $request)
    {
        if (! Auth::check()) {
            return ['status' => 0, 'msg' => trans('app.error_msg'), 'redirect_url' => route('login')];
        }

        $user = Auth::user();

        $id = $request->input('id');
        $listing = Listing::where('id', $id)->first();

        if ($listing) {
            $existingFavorite = Favorite::where('user_id', $user->id)->where('listing_id', $listing->id)->first();
            if (! $existingFavorite) {
                Favorite::create(['user_id' => $user->id, 'listing_id' => $listing->id]);
                return ['status' => 1, 'action' => 'added', 'msg' => trans('app.remove_from_favorite') . ' <i class="fa fa-eye-slash"></i> '];
            } else {
                $existingFavorite->delete();
                return ['status' => 1, 'action' => 'removed', 'msg' => trans('app.save_ad_as_favorite') . ' <i class="fa fa-eye"></i> '];
            }
        }

        return ['status' => 0, 'msg' => trans('app.error_msg')];
    }

    public function replyByEmailPost(Request $request)
    {
        $data = $request->all();
        $data['email'];
        $ad_id = $request->ad_id;
        $ad = Listing::find($ad_id);
        if ($ad) {
            $to_email = $ad->user->email;
            if ($to_email) {
                try {
                    Mail::send('emails.reply_by_email', ['data' => $data], function ($m) use ($data, $ad) {
                        $m->from(get_option('email_address'), get_option('site_name'));
                        $m->to($ad->user->email, $ad->user->name)->subject('query from ' . $ad->title);
                        $m->replyTo($data['email'], $data['name']);
                    });
                } catch (\Exception $e) {
                    //
                }
                return ['status' => 1, 'msg' => trans('app.email_has_been_sent')];
            }
        }
        return ['status' => 0, 'msg' => trans('app.error_msg')];
    }
}
