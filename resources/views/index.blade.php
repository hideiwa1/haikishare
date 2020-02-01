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
        <a href="#user" class="c-button c-button__link">商品を買いたい方はこちら</a>
            <a href="#store" class="c-button c-button__link">商品を売りたい方はこちら</a>
        </div>
        
        <div id="store" class="p-panel u-p_m u-mb_l">
            <h2 class="c-button c-button__link u-center">
                商品を買いたい方</h2>
            <div class="u-flex">
                <div class="p-panel__item3 u-mb_m">
                <div class="c-textbox">
                    <p class="u-center">STEP1</p>
                    ユーザー登録をお願いします。<br>
                    入力項目は「メールアドレス」「パスワード」の２項目のみ！
                </div>
            </div>
            <div class="p-panel__item3 u-mb_m">
                <div class="c-textbox">
                    <p class="u-center">STEP2</p>
                    案件を依頼したい人<br>
                    案件の概要、予算などを入力！<br>
                    案件に応募したい人<br>
                    案件一覧より、興味のあるものに「応募」するだけ！
                </div>
            </div>
            <div class="p-panel__item3 u-mb_m">
                <div class="c-textbox">
                    <p class="u-center">STEP3</p>
                    相手が決まったら、直接メッセージで打ち合わせ！
                </div>
            </div>
            </div>
        </div>
        
        <div id="store" class="p-panel u-p_m u-mb_l">
          <h2 class="c-button c-button__link u-center">商品を売りたい方</h2>
           <div class="u-flex">
            <div class="p-panel__item3 u-mb_m">
                <div class="c-textbox">
                    <p class="u-center">STEP1</p>
                    ユーザー登録をお願いします。<br>
                    入力項目は「メールアドレス」「パスワード」の２項目のみ！
                </div>
            </div>
            <div class="p-panel__item3 u-mb_m">
                <div class="c-textbox">
                    <p class="u-center">STEP2</p>
                    案件を依頼したい人<br>
                    案件の概要、予算などを入力！<br>
                    案件に応募したい人<br>
                    案件一覧より、興味のあるものに「応募」するだけ！
                </div>
            </div>
            <div class="p-panel__item3 u-mb_m">
                <div class="c-textbox">
                    <p class="u-center">STEP3</p>
                    相手が決まったら、直接メッセージで打ち合わせ！
                </div>
            </div>
            </div>
        </div>
    </article>

</main>

@endsection
