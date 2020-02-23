@extends('layouts.template')

@section('title', '新規登録')
@section('description', '')
@section('keyword', 'はいきしぇあ, コンビニ, もったいない, 廃棄')
@include('layouts.head')

@section('contents')
<main class="main">
    <form class="p-form" action="/store/register" method="post">
        {{ csrf_field() }}
        <h1 class="c-title u-center u-mb_xl">販売者　新規登録</h1>
        <?php /*バリデーションの表示*/ ?>
        <div class="p-form__content">
            <p>
                <span class="c-form__title">コンビニ名</span>
                <input type="text" name="name" placeholder="コンビニ名" class="c-form c-form__text"  value="{{ old('name') }}">
                <span class="u-error">{{ $errors -> first('name')}}</span>
            </p>
            <p>
                <span class="c-form__title">支店名</span>
                <input type="text" name="branch" placeholder="支店名" class="c-form c-form__text"  value="{{ old('branch') }}">
                <span class="u-error">{{ $errors -> first('branch')}}</span>
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
                <span class="u-error">{{ $errors -> first('address1')}}</span>
            </p>
            <p>
                <span class="c-form__title">住所（市区町村以降）</span>
                <input type="text" name="address2" placeholder="住所" class="c-form c-form__text"  value="{{ old('address2') }}">
                <span class="u-error">{{ $errors -> first('address2')}}</span>
            </p>
            <p>
                <span class="c-form__title">Email</span>
                <input type="text" name="email" placeholder="email" class="c-form c-form__text"  value="{{ old('email') }}">
                <span class="u-error">{{ $errors -> first('email')}}</span>
            </p>
            <p>
                <span class="c-form__title">Password</span>
                <input type="password" name="password" placeholder="password" class="c-form c-form__text">
                <span class="u-error">{{ $errors -> first('password')}}</span>
            </p>
            <p class="u-mb_xl">
                <span class="c-form__title">Password再入力</span>
                <input type="password" name="password_confirmation" placeholder="再入力" class="c-form c-form__text">
                <span class="u-error">{{ $errors -> first('password_confirmation')}}</span>
            </p>
            <input type="submit" value="新規登録" class="c-button c-form__text c-button__submit">
        </div>
    </form>
</main>
@endsection
