<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Sale;
use Hash;

class UserController extends Controller
{
    /*profileEditページの表示*/
    public function edit(){
        $data = User::find(Auth::id());
        return view('profileEdit', compact('data'));
    }
    
    /*プロフィールの保存*/
    public function saveProfile(Request $request){
        $user = User::find(Auth::id());
        /*重複チェックより自信を除外*/
        $rules = [
            'email' => 'required|email|unique:users,email,'.$user->id,
            'name' => 'required|max:191',
            'address1' => 'required',
        ];
        /*バリデーション*/
        $this -> validate($request, $rules);
        
        $user -> name = $request -> name;
        $user -> address1 = $request -> address1;
        $user -> address2 = $request -> address2;
        $user -> comment = $request -> comment;
        $user -> email = $request -> email;
        if($request -> file('pic')){
            //$this -> validate($request, $rules);
            /*herokuでは画像の保存ができないため、AWS s3を利用*/
            $path = Storage::disk('s3') -> putFile('/', $request -> file('pic'), 'public');
            $user -> pic = Storage::disk('s3') -> url($path);
        }
        /*バリデーションチェック*/
        if($request -> current_password || $request -> new_password){
            if(!(Hash::check($request -> current_password, Auth::user() -> password))){
                return redirect() -> back() -> with('message','パスワードが間違えています');
            }
            if(strcmp($request -> current_password, $request -> new_password) == 0){
                return redirect() -> back() -> with('message','パスワードが変更されていません。現在のパスワードと違うパスワードを入力してください');
            }
            $validated_data = $request -> validate([
                'new_password' => 'string|min:4|confirmed',
            ]);
            $user -> password = bcrypt($request -> new_password);
        }
        $user -> save();
        return back()->with('message', '登録完了');
    }
    
    /*userProfileからのAjax通信*/
    public function userProfileJson(Request $request){
        $id = Auth::id();
        $user = User::find($id);
        return $user;
    }
    
    /*マイページの表示*/
    public function mypage(){
        return view('mypage');
    }
    
    /*profileページの表示*/
    public function profile($id){
        $user = User::find($id);
        $store = Auth::guard('store') -> id();
        $sale = Sale::where('sales.user_id', $id)
            -> where('sales.delete_flg', false)
            -> leftJoin('products', function($q) use ($store){
                $q -> on('sales.product_id', '=', 'products.id')
                    -> where('products.store_id', $store);
            })
            -> exists();
        if(!$sale){
            return redirect('store/mypage');
        }
        if($user -> delete_flg == true || empty($user)){
            return redirect() -> back() -> with('message','ユーザー情報がありません');
        }
        return view('profile', compact('user'));
    }
}
