@extends('layouts.template')

@section('title', 'プロフィール編集ページ')
@section('description', '')
@section('keyword', 'match, 案件, エンジニア, マッチング, 気軽')
@include('layouts.head')

@section('contents')

<main class="main">
    {{ csrf_field() }}
    @foreach ($errors -> all() as $error)
    <p class="u-error">{{ $error }}</p>
    @endforeach
    <div id="profile"></div>

</main>

@endsection
