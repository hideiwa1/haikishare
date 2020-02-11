@extends('layouts.template')

@section('title', 'プロフィールページ')
@section('description', '')
@section('keyword', 'はいきしぇあ, コンビニ, もったいない, 廃棄')
@include('layouts.head')

@section('contents')

<main class="main">
    {{ csrf_field() }}
    
    <div class="p-form">
       <img src="{{$store -> pic}}" alt="" class="c-img__profile u-block u-m_auto">
        <h1 class="c-title">{{$store -> name}} {{$store -> branch}}</h1>
        <p></p>
    </div>
    
    <div id=productList></div>

</main>

@endsection
