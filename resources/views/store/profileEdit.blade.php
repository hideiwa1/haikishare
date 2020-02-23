@extends('layouts.template')

@section('title', 'プロフィール編集ページ')
@section('description', '')
@section('keyword', 'はいきしぇあ, コンビニ, もったいない, 廃棄')
@include('layouts.head')

@section('contents')

<main class="main">
    {{ csrf_field() }}
    @foreach ($errors -> all() as $error)
    <p class="u-error">{{ $error }}</p>
    @endforeach
    
    <div id="storeProfile"></div>

</main>

@endsection
