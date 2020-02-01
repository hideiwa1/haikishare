@extends('layouts.template')

@section('title', '商品詳細ページ')
@section('description', '')
@section('keyword', 'match, 案件, エンジニア, マッチング, 気軽')
@include('layouts.head')

@section('contents')

<main class="main">
    {{ csrf_field() }}
    
    <div>
        {{$detail -> name}}
        {{$detail -> sale}}
    </div>
    
    @if(!empty($detail -> sale))
        @if(!empty($user_id))
            @if($detail -> sale -> user_id == $user_id)
                <div>
                    来店予定日：{{$detail -> sale -> visit -> timezone("JST") ->format('Y年m月d日')}}
                </div>
    <div id="attention">
        <button-attend @click="handleShow">キャンセルする</button-attend>
        <div v-if="isShow" @click.self="closeModal">
            本当にキャンセルしますか？
            <form method="post" action="/cancel/{{$detail -> id}}">
                {{ csrf_field() }}
                <input type="submit" value="はい">
            </form>
        </div>
    </div>
            @else
                <p>売り切れました</p>
            @endif
    @elseif(!empty($store_id) && $detail -> store_id == $store_id)
            <div>
                来店予定日：{{$detail -> sale -> visit -> timezone("JST") ->format('Y年m月d日')}}
            </div>
            <p>売り切れました</p>
        @else
            <p>売り切れました</p>
        @endif
    @else
        @if(!empty($user_id))
            <div id="buyButton"></div>
        @elseif(!empty($store_id) && $detail -> store_id == $store_id)
            <button><a href="/store/registProduct/{{$detail->id}}">編集する</a></button>
            <div id="attention">
                <button-attend @click="handleShow">削除する</button-attend>
                <div v-if="isShow" @click.self="closeModal">
                    本当に削除しますか？
                    <form action="/store/deleteProduct/{{$detail->id}}" method="post">
                        {{ csrf_field() }}
                        <input type="submit" value="はい">
                    </form>
                </div>
            </div>
        @else
            <button><a href="/login">購入にはログインが必要です</a></button>
        @endif
    @endif

</main>

@endsection
