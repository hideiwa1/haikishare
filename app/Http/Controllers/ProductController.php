<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Sale;
use App\Category;
use App\Area;
use App\Store;
use App\User;
use Illuminate\Support\Facades\Auth;
use Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\ProductMail;

class ProductController extends Controller
{
    /*productページの表示*/
    public function index(){
        return view('product');
    }
    
    public function json(Request $request){
        /*product.vueからのAjax通信*/
        $span = $request -> itemsPerPage;
        $keyword = $request -> keyword;
        $category = $request -> category;
        $min = $request -> min;
        $max = $request -> max;
        $area = $request -> area;
        $limit = $request -> limit;
        
        /*検索項目のSQL文作成*/
        $sql = [];
        /*検索項目ごとに配列へ格納*/
        $keyword && $sql[] = ['name', 'LIKE', '%'.$keyword.'%'];
        $category && $sql[] = ['category_id', '=', $category];
        $min && $sql[] = ['price', '>=', $min];
        $max && $sql[] = ['price', '<=', $max];
        if(!$limit || $limit == 'false'){
            $sql[] = ['limit', '>', date('Y/m/d H:i:s')];
        }
        /*都道府県の指定なしの場合*/
        if(empty($area)){
            $products = Product::where($sql)
                ->where('delete_flg', false)
                -> orderBy('updated_at', 'desc') 
                -> paginate($span);
        /*都道府県の指定ありの場合*/
        }else{
            /*ストアの住所検索後、その他の検索を実施*/
            $products = Product::whereHas('Store', function($q) use ($area){
                $q -> where('address1', $area);
            })
                -> where($sql)
                ->where('delete_flg', false)
                -> orderBy('updated_at', 'desc') 
                -> paginate($span);
        }
        return $products;
    }
    
    /*search.vueからのAjax通信*/
    /*商品カテゴリーの取得*/
    public function categoryJson(){
        $categories = Category::get();
        return $categories;
    }
    
    /*search.vueからのAjax通信*/
    /*都道府県の取得*/
    public function areaJson(){
        $areas = Area::get();
        return $areas;
    }
    
    /*buylistページの表示*/
    public function buylist(){
        return view('buyList');
    }
    
    /*buylist.vueからのAjax通信*/
    /*購入済みの商品取得*/
    /*ユーザーIDの一致*/
    public function buylistJson(Request $request){
        $span = $request -> itemsPerPage;
        $user_id = Auth::id();
        $buylists = Sale::where('user_id', $user_id)
            ->where('delete_flg', false)
            ->orderBy('updated_at', 'desc') 
            ->with('product')
            -> paginate($span);
        return $buylists;
    }
    
    public function productlist(){
        return view('store/productList');
    }
    
    public function productlistJson(Request $request){
        $span = $request -> itemsPerPage;
        $store_id = Auth::guard('store') -> id();
        $productlists = Product::where('store_id', $store_id) 
            ->where('delete_flg', false)
            ->orderBy('updated_at', 'desc') 
            ->with('sale')
            -> paginate($span);
        return $productlists;
    }
    
    public function salelist(){
        return view('store/saleList');
    }

    public function salelistJson(Request $request){
        $span = $request -> itemsPerPage;
        $store_id = Auth::guard('store') -> id();
        $salelists = Product::where('store_id', $store_id)
            ->with('sale')
            ->where('delete_flg', false)
            ->orderBy('updated_at', 'desc') 
            -> paginate($span);
        return $salelists;
    }
    
    public function detail($id=''){
        $detail = Product::find($id);
        if($detail -> delete_flg == true || empty($detail)){
            return redirect() -> action('ProductController@productlist');
        }
        $user_id = Auth::id();
        $store_id = Auth::guard('store')-> id();
        return view('detail', compact('detail', 'user_id', 'store_id'));
    }
    
    public function cancelProduct($id){
        $sale = Sale::where('product_id', $id)
            ->where('delete_flg', false) -> first();
        $sale -> delete_flg = true;
        $sale -> save();
        return redirect() -> action('ProductController@detail', [$id])->with('message', 'キャンセルしました');;
    }
    
    public function cancelJson(Request $request){
        $id = $request -> id;
        $sale = Sale::find($id);
        $sale -> delete_flg = true;
        $sale -> save();
        return "";
    }
    
    public function registJson(Request $request){
        $id = $request -> id;
        Log::debug('id:'.$id);
        $product = Product::find($id);
        Log::debug('product:'.print_r($product, true));
        return $product;
    }

    public function regist($id = 'new'){
        if($id !== 'new'){
            $title = '登録案件編集';
            $data = Product::find($id);
            $store = Auth::guard('store')->id();
            $data = Product::find($id);
            if($data -> store_id !== $store){
                return redirect('storemypage');
            }
        }else{
            $title = '新規案件登録';
            $data = '';
        }
        return view('store/registProduct', compact('id'));
    }
    
    public function searchJan(Request $request){
        $jan = $request -> jan;
        $product = Product::where('jan', $jan)
            -> orderBy('updated_at', 'desc')
            ->first();
        return $product;
    }
    
    public function saveJson(Request $request){
        $id = $request -> id;
        if($id === "new"){
            $product = new Product;
        }else{
            $product = Product::find($id);
        }
        $product -> name = $request -> name;
        $product -> jan = $request -> jan;
        $product -> price = $request -> price;
        $product -> limit = Carbon::parse($request -> limit)->format('Y-m-d H:i:s');
        if($request -> file('pic')){
            //$this -> validate($request, $rules);
            /*herokuでは画像の保存ができないため、AWS s3を利用*/
            $path = Storage::disk('s3') -> putFile('/', $request -> file('pic'), 'public');
            $product -> pic = Storage::disk('s3') -> url($path);
        }else if($request -> old_pic){
            $product -> pic = $request -> old_pic;
        }
        $product -> store_id = Auth::guard('store') -> id();
        $product -> save();
        if($id === 'new'){
            /*案件情報登録後、idを取得*/
            $last_insert_id = $product ->id;
            $data = Product::find($last_insert_id);
            $id = $last_insert_id;
        }else{
            $data = Product::find($id);
        }
        return redirect() -> action('ProductController@detail', [$id])->with('message', '登録完了');
    }
    
    public function buyProduct($id = '', Request $request){
        $user_id = Auth::id();
        $sale = new Sale;
        $sale -> user_id = $user_id;
        $sale -> product_id = $id;
        if(empty($request -> visit)){
            $visit = now();
        }else{
            $visit = $request -> visit;
        }
        $sale -> visit = $visit;
        $sale -> save();
        
        /*メールの送信（ストアへ）*/
        $store = Store::find($sale -> product -> store_id);
        $title = '商品販売のお知らせ';
        $name = $store -> name.$store -> branch;
        $text = '登録した商品が購入されました。';
        $product = Product::find($id);
        $to = $store -> email;
        Mail::to($to)->send(new ProductMail($title, $name, $text, $product, $visit));
        
        /*メールの送信（ユーザーへ）*/
        $user = User::find($user_id);
        $title = '商品購入のお知らせ';
        $name = $user -> name;
        $text = '商品を購入しました。';
        $to = $user -> email;
        Mail::to($to)->send(new ProductMail($title, $name, $text, $product, $visit));
        
        return redirect() -> action('ProductController@detail', [$id])->with('message', '購入完了');
    }
    
    public function delete($id = ''){
        if($id !== ''){
            $product = Product::find($id);
            $product -> delete_flg = true;
            $product -> save();
            return redirect() -> action('ProductController@productlist') ->with('message', '削除しました');
        }else{
            return redirect() -> action('ProductController@productlist');
        }
    }
}
