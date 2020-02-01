@extends('layouts.template')

@section('title', '購入済み一覧')
@section('description', '')
@section('keyword', 'match, 案件, エンジニア, マッチング, 気軽')
@include('layouts.head')

@section('contents')

<main class="main u-flex">
    {{ csrf_field() }}
    <div id="buylist">

    </div>

</main>

@endsection
