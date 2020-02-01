<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Store;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
    public function edit(){
        $data = Store::find(Auth::id());
        return view('store/profileEdit', compact('data'));
    }

    public function saveProfile(Request $request){
        $user = Store::find(Auth::guard('store') -> id());
        /*重複チェックより自信を除外*/
        $rules = [
            'email' => 'required|email|unique:users,email,'.$user->id,
            'name' => 'max:191',];
        /*バリデーション*/
        $this -> validate($request, $rules);

        $user -> name = $request -> name;
        $user -> branch = $request -> branch;
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
        if($request -> current_password){
            if(!(Hash::check($request -> current_password, Auth::guard('store') -> password))){
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

    public function storeProfileJson(Request $request){
        $id = Auth::guard('store') -> id();
        $user = Store::find($id);
        return $user;
    }
    
    public function profile($id){
        $store = Store::find($id);
        if($store -> delete_flg == true || empty($store)){
            return redirect() -> back() -> with('message','ユーザー情報がありません');
        }
        return view('store/profile', compact('store'));
    }
}
