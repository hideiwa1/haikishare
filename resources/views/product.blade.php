@extends('layouts.template')

@section('title', '商品一覧')
@section('description', '')
@section('keyword', 'はいきしぇあ, コンビニ, もったいない, 廃棄')
@include('layouts.head')

@section('contents')

    {{ csrf_field() }}
    
    <div id="product">
        
    </div>

@endsection
