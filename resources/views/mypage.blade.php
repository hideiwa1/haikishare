@extends('layouts.template')

@section('title', 'マイページ')
@section('description', '')
@section('keyword', 'match, 案件, エンジニア, マッチング, 気軽')
@include('layouts.head')

@section('contents')

<main class="main u-flex">
    {{ csrf_field() }}
    
    <div id="mypage"></div>
</main>

<side>
    <h2>マイページメニュー</h2>
    <p><a href="/profileEdit">プロフィール編集</a></p>
    <p><a href="/buylist">購入履歴</a></p>
</side>
@endsection
