<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\Auth;
use App\Sale;

class IndexController extends Controller
{
    public function index(){
        /*indexページの表示*/
        return view('index');
    }
    
    public function json(){
        /*index.vueからのAjax通信*/
        /*登録された商品　最新3件の取得*/
        $products = Product::where('products.delete_flg', false)
            /*saleテーブルより、購入された物のみを結合*/
            -> leftJoin('sales', function($q){
                $q -> on('products.id', '=', 'sales.product_id')
                    -> where('sales.delete_flg', false);
            })
            /*saleのデータがないものを抽出*/
            -> whereNull('sales.product_id')
            -> orderBy('products.updated_at', 'desc') 
            -> take(3) -> get(['products.*']);
        return $products;
    }
    
    public function auth(){
        /*menu.vueからのAjax通信*/
        $flg = '';
        /*ユーザー側のログイン認証があるか*/
        $user = Auth::id();
        if(!empty($user)) $flg = 'user';
        if(empty($user)){
            /*ストア側のログイン認証があるか*/
            $user = Auth::guard('store') -> id();
            if(isset($user)) $flg = 'store';
        }
        /*ユーザーなら'user',ストアなら'store',非ログインなら空で返す*/
        return $flg;
    }
}
