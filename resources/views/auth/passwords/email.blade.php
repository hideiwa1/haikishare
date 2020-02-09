@extends('layouts.template')

@section('title', 'パスワード再発行')
@section('description', '')
@section('keyword', 'はいきしぇあ, コンビニ, もったいない, 廃棄')
@include('layouts.head')

@section('contents')

<main class="main">

    <form method="post" action="{{ route('password.email') }}" class="p-form">
        {{ csrf_field() }}
        <h1 class="c-title u-center u-mb_xl">パスワード再発行</h1>
        <div class="p-form__content">
            <p>
                ご登録のメールアドレスを入力してください。
            </p>
            <p class="u-mb_xl">
                <label class="c-form__title" >Email
                    <input type="text" name="email" placeholder="email" class="c-form__text" value="{{ old('email') }}">
                </label>
            </p>
            <input type="submit" name="submit" value="送信" class="c-button c-form__text c-button__link">
        </div>
    </form>
</main>

@endsection