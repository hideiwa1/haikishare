<!DOCTYPE html>
<html lang="ja">

    <head>
        @yield('head')
    </head>

    <body id="body" class="body">

        <header id="header" class="header__back">
           <div class="header">
            <h1>
                <a href="/">
                @if(app('env') == 'local')
                <img src="{{ asset('/img/logo.png') }}" class="hero__banner c-img">
                @else
                <img src="{{ secure_asset('/img/logo.png') }}" class="hero__banner c-img">
                @endif
                </a>
            </h1>
            @if(session('message'))
            <div class="js-flash p-flash u-flex-flash">
                <span>{{session('message')}}</span></div>
            @endif
               @if(session('status'))
               <div class="js-flash p-flash u-flex-flash">
                   <span>{{session('status')}}</span></div>
               @endif
            <nav>
                <div id="menu"></div>
            </nav>
            </div>
        </header>

        @yield('contents')

        <footer class="footer__back">
            <div class="footer">
            <p>Copyright <a href="/">ハイキシェア</a> All Right Reserved</p>
            <script src="https://polyfill.io/v3/polyfill.min.js?features=Object.values"></script>
            @if(app('env') == 'local')
            <script src="{{ asset('/js/app.js') }}"></script>
            @else
            <script src="{{ secure_asset('/js/app.js') }}"></script>
            @endif
            <script>
                
            </script>
            </div>
        </footer>

    </body>

</html>
