@extends('layouts.template')

@section('title', '商品一覧')
@section('description', '')
@section('keyword', 'match, 案件, エンジニア, マッチング, 気軽')
@include('layouts.head')

@section('contents')

    {{ csrf_field() }}
    
    <div id="product">
        
    </div>

@endsection
