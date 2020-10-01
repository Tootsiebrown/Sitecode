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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
//    public function create()
//    {
//        $countries = Country::all();
//        return view('theme.user_create', compact('countries'));
//    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
//    public function store(Request $request)
//    {
//
//        $rules = [
//            'first_name'    => 'required',
//            'email'    => 'required|email',
//            'gender'    => 'required',
//            'country'    => 'required',
//            'password'    => 'required|confirmed',
//            'password_confirmation'    => 'required',
//            'phone'    => 'required',
//            'agree'    => 'required',
//        ];
//        $this->validate($request, $rules);
//
//        $active_status = get_option('verification_email_after_registration');
//
//        $data = [
//            'first_name'        => $request->first_name,
//            'last_name'         => $request->last_name,
//            'name'              => $request->first_name . ' ' . $request->last_name,
//            'email'             => $request->email,
//            'password'          => bcrypt($request->password),
//            'phone'             => $request->phone,
//            'gender'             => $request->gender,
//            'country_id'             => $request->country,
//
//            'user_type'         => 'user',
//            'active_status'     => ($active_status == '1') ? '0' : '1',
//            'activation_code'   => str_random(30)
//        ];
//
//        $user_create = User::create($data);
//
//        if ($user_create) {
//            $registration_success_activating_msg = "";
//            if ($active_status == '1') {
//                try {
//                    $registration_success_activating_msg = ", we've sent you an activation email, please follow email instruction";
//
//                    Mail::send('emails.activation_email', ['user' => $data], function ($m) use ($data) {
//                        $m->from(get_option('email_address'), get_option('site_name'));
//                        $m->to($data['email'], $data['name'])->subject(trans('app.activate_email_subject'));
//                    });
//                } catch (\Exception $e) {
//                    $registration_success_activating_msg = ", we can't sending you activation email during an email error, please contact with your admin";
//                    //
//                }
//            }
//            return redirect(route('login'))->with('registration_success', trans('app.registration_success') . $registration_success_activating_msg);
//        } else {
//            return back()->withInput()->with('error', trans('app.error_msg'));
//        }
//    }
//
//    public function activatingAccount($activation_code)
//    {
//        $get_user = User::whereActivationCode($activation_code)->first();
//        if (! $get_user) {
//            $error = trans('app.invalid_activation_code');
//            return view('theme.invalid', compact('error'));
//        }
//        $get_user->active_status = '1';
//        $get_user->activation_code = '';
//        $get_user->save();
//
//        return redirect(route('login'))->with('registration_success', trans('app.account_activated'));
//    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
//    public function edit($id)
//    {
//        //
//    }

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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function profile()
    {
        $title = trans('app.profile');
        $user = Auth::user();
        return view('dashboard.profile', compact('title', 'user'));
    }

    public function profileEdit()
    {
        $title = trans('app.profile_edit');
        $user = Auth::user();
        $countries = Country::all();

        return view('dashboard.profile_edit', compact('title', 'user', 'countries'));
    }

    public function profileEditPost(Request $request)
    {
        $user_id = Auth::user()->id;
        $user = User::find($user_id);

        //Validating
        $rules = [
            'email'    => 'required|email|unique:users,email,' . $user_id,
        ];
        $this->validate($request, $rules);

        $inputs = array_except($request->input(), ['_token', 'photo']);
        $user_update = $user->whereId($user_id)->update($inputs);

        if ($request->hasFile('photo')) {
            $rules = ['photo' => 'mimes:jpeg,jpg,png'];
            $this->validate($request, $rules);

            $image = $request->file('photo');
            $file_base_name = str_replace('.' . $image->getClientOriginalExtension(), '', $image->getClientOriginalName());
            $resized_thumb = Image::make($image)->resize(300, 300)->stream();

            $image_name = strtolower(time() . str_random(5) . '-' . str_slug($file_base_name)) . '.' . $image->getClientOriginalExtension();

            $imageFileName = 'uploads/avatar/' . $image_name;

            //Upload original image
            $is_uploaded = current_disk()->put($imageFileName, $resized_thumb->__toString(), 'public');

            if ($is_uploaded) {
                $previous_photo = $user->photo;
                $previous_photo_storage = $user->photo_storage;

                $user->photo = $image_name;
                $user->photo_storage = get_option('default_storage');
                $user->save();

                if ($previous_photo) {
                    $previous_photo_path = 'uploads/avatar/' . $previous_photo;
                    $storage = Storage::disk($previous_photo_storage);
                    if ($storage->has($previous_photo_path)) {
                        $storage->delete($previous_photo_path);
                    }
                }
            }
        }

        return redirect(route('profile'))->with('success', trans('app.profile_edit_success_msg'));
    }

//    public function administrators()
//    {
//        $title = trans('app.administrators');
//        //$users = User::whereUserType('admin')->get();
//        $users = User::get();
//
//        return view('dashboard.administrators', compact('title', 'users'));
//    }
//
//    public function addAdministrator()
//    {
//        $title = trans('app.add_administrator');
//        $countries = Country::all();
//
//        return view('dashboard.add_administrator', compact('title', 'countries'));
//    }
//
//
//    public function storeAdministrator(Request $request)
//    {
//        $rules = [
//            'name'                  => 'required',
//            'email'                 => 'required|email',
//            'phone'                 => 'required',
//            'gender'                => 'required',
//            'country'               => 'required',
//            'password'              => 'required|confirmed',
//            'password_confirmation' => 'required',
//        ];
//        $this->validate($request, $rules);
//
//        $data = [
//            'name'              => $request->name,
//            'email'             => $request->email,
//            'password'          => bcrypt($request->password),
//            'phone'             => $request->phone,
//            'gender'            => $request->gender,
//            'country_id'        => $request->country,
//            'user_type'         => 'admin',
//            'active_status'     => '1',
//            'activation_code'   => str_random(30)
//        ];
//
//        $user_create = User::create($data);
//        return redirect(route('administrators'))->with('success', trans('app.registration_success'));
//    }
//
//    public function administratorBlockUnblock(Request $request)
//    {
//        $status = $request->status == 'unblock' ? '1' : '2';
//        $user_id = $request->user_id;
//        User::whereId($user_id)->update(['active_status' => $status]);
//
//        if ($status == 1) {
//            return ['success' => 1, 'msg' => trans('app.administrator_unblocked')];
//        }
//        return ['success' => 1, 'msg' => trans('app.administrator_blocked')];
//    }

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

        $slug = $request->slug;
        $listing = Listing::whereSlug($slug)->first();

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
