@extends('layouts.template')

@section('title', '商品登録・編集')
@section('description', '')
@section('keyword', 'はいきしぇあ, コンビニ, もったいない, 廃棄')
@include('layouts.head')

@section('contents')

<main class="main">
    {{ csrf_field() }}
    <div id="registProduct">
        {{$title}}
    </div>
</main>

@endsection
