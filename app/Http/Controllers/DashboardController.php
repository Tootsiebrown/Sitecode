<?php

namespace App\Http\Controllers;

use App\Ad;
use App\Contact_query;
use App\Payment;
use App\Report_ad;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        if ($user->is_admin()) {
            $approved_ads = Ad::whereStatus('1')->count();
            $total_users = User::count();

            $total_payments = Payment::whereStatus('success')->count();
            $total_payments_amount = Payment::whereStatus('success')->sum('amount');

            return view('admin.dashboard', compact('approved_ads', 'total_users', 'total_payments', 'total_payments_amount'));

        }

        return view('admin.dashboard');
    }


    public function logout()
    {
        if (Auth::check()) {
            Auth::logout();
        }

        return redirect(route('login'));
    }
}
