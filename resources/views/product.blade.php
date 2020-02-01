@extends('layouts.template')

@section('title', '商品一覧')
@section('description', '')
@section('keyword', 'match, 案件, エンジニア, マッチング, 気軽')
@include('layouts.head')

@section('contents')

<main class="main u-flex">
    {{ csrf_field() }}
    <div id="search">
        
    </div>
    <div id="product">
        
    </div>
</main>

@endsection
