@extends('layouts.template')

@section('title', 'index')
@section('description', '「モッタイナイ」を減らそう！ハイキシェアは期限間近や期限切れのモッタイナイを有効活用するサービスです。')
@section('keyword', 'ハイキシェア, 期限, コンビニ, 廃棄, モッタイナイ')
@include('layouts.head')



@section('contents')

<main class="main">
    <article>
        <h1 class="c-title u-mb_m u-center">新着商品</h1>
        <div id="index">
       </div>
        <p class="u-right"><a href="product">>>さらに見る</a></p>
    </article>

    <article>
        <h1 class="c-title u-center u-mb_m">はいきしぇあとは？</h1>
        <div class="c-textbox u-mb_l">
            <p>
               コンビニから出る、廃棄予定なのにまだ食べられる・まだ使える商品を気軽に売り買いできるサービスです。
            </p>
               <p>
                コンビニでは日々大量の弁当や食品が廃棄されています。<br>
                その量は１日あたり300トン以上、弁当で換算すると100万個以上にもなります。１店舗あたり2〜3万円の廃棄額になると言われています。
            </p>
            <p class="c-subtitle u-center">まだ食べられるのに捨てるなんて　<span class="u-inline u-active u-bold">モッタイナイ！</span></p>
            <p>
                「はいきしぇあ」では、このような”モッタイナイ”を有効活用するためのサービスです。<br>
                簡単な３ステップで商品の購入・販売を行うことができます！
            </p>
        </div>
        
        <h2 class="c-title u-center u-mb_m">利用方法</h2>
        <div class="u-mb_l u-flex-between">
            <div class="p-panel__item2 u-mb_m">
                <div class="c-textbox u-mb_m">
                        <p class="u-center">買いたい方</p>
                        <p>
                        １、価格や商品名などで買いたい商品を検索。<br>
                        ２、商品ページより「購入する」をクリック！<br>
                        ３、販売店の店頭にてお支払い。
                    </p>
                    <a href="/login" class="c-button c-button__link u-center">商品を買いたい方はこちら</a>
                    </div>
                
            </div>
            <div class="p-panel__item2 u-mb_m">
                <div class="c-textbox u-mb_m">
                        <p class="u-center">売りたい方</p>
                        <p>
                        １、商品名、写真、期限などを入力して商品を登録<br>
                        ２、商品が購入されるとメールが届きます。<br>
                        ３、来店されたら、商品を販売！
                        </p>
                
                    <a href="/store/login" class="c-button c-button__link u-center">商品を売りたい方はこちら</a>
                    </div>
                </div>
            
            
        </div>
    </article>

</main>

@endsection
