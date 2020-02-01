@extends('layouts.template')

@section('title', 'プロフィール')
@section('description', '')
@section('keyword', 'match, 案件, エンジニア, マッチング, 気軽')
@include('layouts.head')

@section('contents')

<main class="main u-flex">
    {{ csrf_field() }}

</main>

@endsection
