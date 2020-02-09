@extends('layouts.template')

@section('title', '登録商品一覧')
@section('description', '')
@section('keyword', 'はいきしぇあ, コンビニ, もったいない, 廃棄'))
@include('layouts.head')

@section('contents')
<div class="main u-flex">
    <main class="p-maincontent u-pr_l">
        {{ csrf_field() }}

        <div id="productList"></div>
    </main>

    <side class="p-sidecontent">
        <h2 class="c-title u-mb_l">マイページメニュー</h2>
        <p><a href="/store/profileEdit">プロフィール編集</a></p>
        <p><a href="/store/registProduct">商品出品</a></p>
        <p><a href="/store/salelist">販売履歴</a></p>
        <p><a href="/store/productlist">出品一覧</a></p>
    </side>
</div>

@endsection
