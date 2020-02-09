@extends('layouts.template')

@section('title', 'ログイン')
@section('description', '')
@section('keyword', 'はいきしぇあ, コンビニ, もったいない, 廃棄')
@include('layouts.head')

@section('contents')

<main class="main">

    <form action="login" method="post" class="p-form">
        {{ csrf_field() }}
        <h1 class="c-title u-center u-mb_xl">ログイン</h1>
        <?php /*バリデーションの表示*/ ?>
        @foreach ($errors -> all() as $error)
        <p class="u-error">{{ $error }}</p>
        @endforeach

        <div class="p-form__content">
            <p>
                <span class="c-form__title">Email</span>
                <input type="text" name="email" placeholder="email" class="c-form__text" value="{{ old('email') }}">
            </p>
            <p class="u-mb_xl">
                <span class="c-form__title">Password</span>
                <input type="password" name="password" placeholder="password" class="c-form__text">
                <span class="c-form__title"><a href="password/reset">>>パスワードを忘れた方はこちらへ</a></span>
            </p>
            <input type="submit" name="submit" value="ログイン" class="c-button c-form__text c-button__link u-mb_l">
            <button class="c-button c-form__text c-button__small"><a href="register">新規登録はこちら</a></button>
        </div>
    </form>
</main>

@endsection
