@extends('layouts.template')

@section('title', 'プロフィール')
@section('description', '')
@section('keyword', 'はいきしぇあ, コンビニ, もったいない, 廃棄')
@include('layouts.head')

@section('contents')

<main class="main">
    {{ csrf_field() }}
    
    <div class="p-form">
        <img src="{{$user -> pic}}" alt="" class="c-img__profile u-block u-m_auto u-mb_l">
        <h1 class="c-title u-center">
            @if(!empty($user -> name))
            {{$user -> name}}
            @else
            名無し
            @endif
        </h1>
        <table>
            <tr>
                <td class="c-th">住所</td>
                <td>
                    @if(!empty($user -> address1 ->area -> name))
                    {{$user -> address1 ->area -> name}}
                    @else
                    住所未登録です
                    @endif
                </td>
            </tr>
            <tr>
                <td class="c-th">コメント</td>
                <td>
                    {{$user -> comment}}
                </td>
            </tr>
        </table>
    </div>

</main>

@endsection
