@extends('layouts.template')

@section('title', '販売済み一覧')
@section('description', '')
@section('keyword', 'はいきしぇあ, コンビニ, もったいない, 廃棄')
@include('layouts.head')

@section('contents')

<main class="main u-flex">
    {{ csrf_field() }}
    <div id="saleList">

    </div>

</main>

@endsection
