<?php

namespace App\Http\Controllers\Store\Auth;

use App\Http\Controllers\Store\Auth;
use App\Http\Controllers\Controller;
use App\Store;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Area;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/store/mypage';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /**public function __construct()
    {
        $this->middleware('guest');
    }
    */

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    
    // ログイン画面
    public function showRegisterForm()
    {
        $areas = Area::get();
        return view('store.auth.register', compact('areas')); //管理者ログインページのテンプレート
    }

    protected function guard()
    {
        return \Auth::guard('store'); //管理者認証のguardを指定
    }
    
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'branch' => ['required', 'string', 'max:255'],
            'address1' => ['required', 'integer'],
            'address2' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:stores'],
            'password' => ['required', 'string', 'min:4', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return Store::create([
            'name' => $data['name'],
            'branch' => $data['branch'],
            'address1' => $data['address1'],
            'address2' => $data['address2'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
