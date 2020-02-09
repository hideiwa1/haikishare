@extends('layouts.template')

@section('title', 'プロフィール')
@section('description', '')
@section('keyword', 'はいきしぇあ, コンビニ, もったいない, 廃棄'))
@include('layouts.head')

@section('contents')

<main class="main u-flex">
    {{ csrf_field() }}

</main>

@endsection
