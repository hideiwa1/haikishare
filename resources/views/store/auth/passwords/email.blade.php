@extends('layouts.template')

@section('title', 'パスワード再発行')
@section('description', '')
@section('keyword', 'はいきしぇあ, コンビニ, もったいない, 廃棄')
@include('layouts.head')

@section('contents')

<main class="main">

    <form method="post" action="{{ route('store.password.email') }}" class="p-form">
        {{ csrf_field() }}
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        <h1 class="c-title u-center u-mb_xl">パスワード再発行</h1>
        <div class="p-form__content">
            <p class="u-error">
                @foreach($errors -> all() as $error)
                {{ $error }}
                @endforeach
            </p>
            <p>
                ご登録のメールアドレスを入力してください。
            </p>
            <p class="u-mb_xl">
                <span class="c-form__title" value="{{ old('email') }}">Email</span>
                <input type="text" name="email" placeholder="email" class="c-form__text">
            </p>
            <input type="submit" name="submit" value="送信" class="c-button c-form__text c-button__submit">
        </div>
    </form>
</main>

@endsection