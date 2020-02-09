@extends('layouts.template')

@section('title', '商品詳細ページ')
@section('description', '')
@section('keyword', 'はいきしぇあ, コンビニ, もったいない, 廃棄')
@include('layouts.head')

@section('contents')

<main class="main">
    {{ csrf_field() }}

    <div class="p-form u-ellipsis__default">
        <h1 class="c-title u-center u-mb_m u-word">{{$detail -> name}}</h1>
        <div class="twitter u-right u-vertical">
            <a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button" data-text="" data-show-count="false" data-lang="ja">Tweet</a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
        </div>
        <img src="{{$detail -> pic}}" alt="" class="c-img">
        
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
        <table>
            <tr>
                <td class="c-th">来店予定日</td>
                <td class="u-word">{{$detail -> sale -> visit -> timezone("JST") ->format('Y年m月d日')}}</td>
            </tr>
        </table>
        <div id="attention">
            <button-attend @click="handleShow">キャンセルする</button-attend>
            <div v-if="isShow" @click.self="closeModal" class="p-modal p-modal-back" v-cloak>
                
                <form method="post" action="/cancel/{{$detail -> id}}" class="p-modal--center u-center u-p_xl">
                    <p class="c-title">本当にキャンセルしますか？</p>
                    {{ csrf_field() }}
                    <input type="submit" value="はい" class="c-button c-button__link u-w_50 u-m_auto">
                </form>
                
            </div>
        </div>
        @else
        <p>売り切れました</p>
        @endif
        @elseif(!empty($store_id) && $detail -> store_id == $store_id)
        <table>
            <tr>
                <td class="c-th">来店予定日</td>
                <td class="u-word">{{$detail -> sale -> visit -> timezone("JST") ->format('Y年m月d日')}}</td>
            </tr>
        </table>
        <p>売り切れました</p>
        @else
        <p>売り切れました</p>
        @endif
        @else
        @if(!empty($user_id))
        <div id="buyButton"></div>
        @elseif(!empty($store_id) && $detail -> store_id == $store_id)
        <button class="c-button c-button__link u-w_50 u-m_auto u-mb_l"><a href="/store/registProduct/{{$detail->id}}">編集する</a></button>
        <div id="attention">
            <button-attend @click="handleShow">削除する</button-attend>
            <div v-if="isShow" @click.self="closeModal" class="p-modal p-modal-back" v-cloak>
                <form action="/store/deleteProduct/{{$detail->id}}" method="post" class="p-modal--center u-center u-p_xl">
                    <p class="c-title">本当に削除しますか？</p>
                    {{ csrf_field() }}
                    <input type="submit" value="はい" class="c-button c-button__link u-w_50 u-m_auto">
                </form>
            </div>
        </div>
        @else
        <button class="c-button c-button__link u-w_50 u-m_auto u-mb_l"><a href="/login">購入にはログインが必要です</a></button>
        @endif
        @endif
    </div>

</main>

@endsection
