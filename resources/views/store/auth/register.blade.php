@extends('layouts.template')

@section('title', '新規登録')
@section('description', '')
@section('keyword', 'はいきしぇあ, コンビニ, もったいない, 廃棄'))
@include('layouts.head')

@section('contents')
<main class="main">
    <form class="p-form" action="/store/register" method="post">
        {{ csrf_field() }}
        <h1 class="c-title u-center u-mb_xl">新規登録</h1>
        <?php /*バリデーションの表示*/ ?>
        @foreach ($errors -> all() as $error)
        <p class="u-error">{{ $error }}</p>
        @endforeach
        <div class="p-form__content">
            <p>
                <span class="c-form__title">コンビニ名</span>
                <input type="text" name="name" placeholder="コンビニ名" class="c-form c-form__text"  value="{{ old('name') }}">
            </p>
            <p>
                <span class="c-form__title">支店名</span>
                <input type="text" name="branch" placeholder="支店名" class="c-form c-form__text"  value="{{ old('branch') }}">
            </p>
            <p>
                <span class="c-form__title">都道府県</span>
                <select name="address1" class="c-form c-form__select">
                  <option value="">選択してください▼</option>
                   @foreach($areas as $val)
                    <option value="{{$val -> id}}" 
                    @if($val -> id == old('address1'))
                    "selected"
                    @endif
                    >{{$val -> name}}</option>
                    @endforeach
                </select>
            </p>
            <p>
                <span class="c-form__title">住所（市区町村以降）</span>
                <input type="text" name="address2" placeholder="住所" class="c-form c-form__text"  value="{{ old('address2') }}">
            </p>
            <p>
                <span class="c-form__title">Email</span>
                <input type="text" name="email" placeholder="email" class="c-form c-form__text"  value="{{ old('email') }}">
            </p>
            <p>
                <span class="c-form__title">Password</span>
                <input type="password" name="password" placeholder="password" class="c-form c-form__text">
            </p>
            <p class="u-mb_xl">
                <span class="c-form__title">Password再入力</span>
                <input type="password" name="password_confirmation" placeholder="再入力" class="c-form c-form__text">
            </p>
            <input type="submit" value="新規登録" class="c-button c-form__text c-button__link">
        </div>
    </form>
</main>
@endsection
