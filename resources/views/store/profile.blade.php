@extends('layouts.template')

@section('title', 'プロフィールページ')
@section('description', '')
@section('keyword', 'はいきしぇあ, コンビニ, もったいない, 廃棄')
@include('layouts.head')

@section('contents')

<main class="main">
    {{ csrf_field() }}
    
    <div class="p-form">
       <img src="{{$store -> pic}}" alt="" class="c-img__profile u-block u-m_auto u-mb_l">
        <h1 class="c-title u-center">{{$store -> name}} {{$store -> branch}}</h1>
        <table>
            <tr>
                <td class="c-th">住所</td>
                <td class="u-word">
                    {{$store -> area -> name}} {{$store -> address2}}
                </td>
            </tr>
            <tr>
                <td class="c-th">お店からのコメント</td>
                <td class="u-word">
                    {{$store -> comment}}
                </td>
            </tr>
        </table>
    </div>
    
    <div id=productList></div>

</main>

@endsection
