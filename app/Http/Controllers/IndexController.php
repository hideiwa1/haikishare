<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index(){
        return view('index');
    }
    
    public function json(){
        $products = Product::orderBy('updated_at', 'desc') -> take(3) -> get();
        return $products;
    }
    
    public function auth(){
        $flg = '';
        $user = Auth::id();
        if(!empty($user)) $flg = 'user';
        if(empty($user)){
            $user = Auth::guard('store') -> id();
            if(isset($user)) $flg = 'store';
        }
        return $flg;
    }
}
