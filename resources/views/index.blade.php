@extends('layouts.template')

@section('title', 'index')
@section('description', '「モッタイナイ」を減らそう！ハイキシェアは期限間近や期限切れのモッタイナイを有効活用するサービスです。')
@section('keyword', 'ハイキシェア, 期限, コンビニ, 廃棄, モッタイナイ')
@include('layouts.head')



@section('contents')

<main class="main">
    <article>
        <h1 class="c-title">新着商品</h1>
        <div id="index">
       </div>
        <p class="u-right"><a href="project">>>さらに見る</a></p>
    </article>

    <article>
        <h1 class="c-title">利用方法</h1>
        <div class="p-panel u-flex-around u-mb_m u-p_m">
            <div class="u-flex">
                <div class="p-panel__item3 u-mb_m">
                    <div class="c-textbox">
                        <p class="u-center">コンセプト</p>
                        「はいきしぇあ」は、賞味期限が近い、少し過ぎてしまったなどの理由で、まだ食べられるのに捨てられる食品などを有効活用しようというサービスです！
                    </div>
                </div>
                <div class="p-panel__item3 u-mb_m">
                    <div class="c-textbox">
                        <p class="u-center">買いたい方</p>
                        １、価格や商品名などで買いたい商品を検索。<br>
                        ２、商品ページより「購入する」をクリック！<br>
                        ３、販売店の店頭にてお支払い。
                    </div>
                </div>
                <div class="p-panel__item3 u-mb_m">
                    <div class="c-textbox">
                        <p class="u-center">売りたい方</p>
                        １、商品名、写真、期限などを入力して商品を登録<br>
                        ２、商品が購入されるとメールが届きます。<br>
                        ３、来店されたら、商品を販売！
                    </div>
                </div>
            </div>
        <a href="/login" class="c-button c-button__link">商品を買いたい方はこちら</a>
            <a href="/store/login" class="c-button c-button__link">商品を売りたい方はこちら</a>
        </div>
    </article>

</main>

@endsection
