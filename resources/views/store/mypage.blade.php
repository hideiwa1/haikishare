@extends('layouts.template')

@section('title', 'マイページ')
@section('description', '')
@section('keyword', 'match, 案件, エンジニア, マッチング, 気軽')
@include('layouts.head')

@section('contents')

<main class="main u-flex">
    {{ csrf_field() }}
    
    <div id="storeMypage"></div>

</main>
<side>
    <h2>マイページメニュー</h2>
    <p><a href="/store/profileEdit">プロフィール編集</a></p>
    <p><a href="/store/registProduct">商品出品</a></p>
    <p><a href="/store/salelist">販売履歴</a></p>
    <p><a href="/store/productlist">出品一覧</a></p>
</side>

@endsection
