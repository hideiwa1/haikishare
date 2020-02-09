@extends('layouts.template')

@section('title', '購入済み一覧')
@section('description', '')
@section('keyword', 'はいきしぇあ, コンビニ, もったいない, 廃棄')
@include('layouts.head')

@section('contents')
<div class="main u-flex">
    <main class="p-maincontent u-pr_l">
        {{ csrf_field() }}

        <div id="buylist"></div>
    </main>

    <side class="p-sidecontent">
        <h2 class="c-title u-mb_l">マイページメニュー</h2>
        <p><a href="/profileEdit">プロフィール編集</a></p>
        <p><a href="/buylist">購入履歴</a></p>
    </side>
</div>

@endsection
