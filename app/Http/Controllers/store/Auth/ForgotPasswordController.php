<?php

namespace App\Http\Controllers\Store\Auth;

use App\Http\Controllers\Admin\Store;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */
    public function showLinkRequestForm()
    {
        return view('store.auth.passwords.email'); //管理者ログインページのテンプレート
    }

    use SendsPasswordResetEmails;
    
    public function broker()
    {
        return Password::broker('stores');
    }
}
