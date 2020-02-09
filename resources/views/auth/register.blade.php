@extends('layouts.template')

@section('title', '新規登録')
@section('description', '')
@section('keyword', 'はいきしぇあ, コンビニ, もったいない, 廃棄')
@include('layouts.head')

@section('contents')

<main class="main">
    <form class="p-form" action="/register" method="post">
        {{ csrf_field() }}
        <h1 class="c-title u-center u-mb_xl">新規登録</h1>
        <?php /*バリデーションの表示*/ ?>
        @foreach ($errors -> all() as $error)
        <p class="u-error">{{ $error }}</p>
        @endforeach
        <div class="p-form__content">
            <p>
                <span class="c-form__title">Email</span>
                <input type="text" name="email" placeholder="email" class="c-form__text"  value="{{ old('email') }}">
            </p>
            <p>
                <span class="c-form__title">Password</span>
                <input type="password" name="password" placeholder="password" class="c-form__text">
            </p>
            <p class="u-mb_xl">
                <span class="c-form__title">Password再入力</span>
                <input type="password" name="password_confirmation" placeholder="再入力" class="c-form__text">
            </p>
            <input type="submit" value="新規登録" class="c-button c-form__text c-button__link">
        </div>
    </form>
</main>

@endsection
