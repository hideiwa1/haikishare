@extends('layouts.template')

@section('title', '商品詳細ページ')
@section('description', '')
@section('keyword', 'match, 案件, エンジニア, マッチング, 気軽')
@include('layouts.head')

@section('contents')

<main class="main">
    {{ csrf_field() }}

    <div class="p-form u-ellipsis">
        <h1 class="c-title u-center u-mb_m u-word">{{$detail -> name}}</h1>
        <div class="twitter u-right u-vertical">
            <a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button" data-text="" data-show-count="false" data-lang="ja">Tweet</a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
        </div>
        <img src="{{$detail -> pic}}" alt="">
        
        <table>
            <tr>
                <td class="c-th">販売者</td>
                <td>
                    <a href="/store/profile/{{$detail -> store_id}}">
                        {{$detail -> store -> name}}  {{$detail -> store -> branch}}
                    </a>
                </td>
            </tr>
            <tr>
                <td class="c-th">住所</td>
                <td>
                    {{$detail -> store -> area -> name}} {{$detail -> store -> address2}}
                </td>
            </tr>
            @if(!empty($detail -> category_id))
            <tr>
                <td class="c-th">カテゴリー</td>
                <td>{{$detail -> category -> name }}</td>
            </tr>
            @endif
            <tr>
                <td class="c-th">価格</td>
                <td>{{$detail -> price}}円</td>
            </tr>
            <tr>
                <td class="c-th">期限</td>
                <td>{{$detail -> limit -> timezone("JST") ->format('Y年m月d日 h:m')}}</td>
            </tr>
            <tr>
                <td class="c-th">説明文</td>
                <td class="u-word">{{$detail -> comment}}</td>
            </tr>
        </table>
        

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
    </div>

</main>

@endsection
