<!DOCTYPE html>
<html lang="ja">
    <head>
    </head>
    <body>
        <h1>
            {{$title}}
        </h1>
        <p>
            {{$name}}
        </p>
        <p>
            {{$text}}
        </p>
        <p>
            商品名：{{$product -> name}}
        </p>
        <p id="button">
            <a href="{{$url}}/detail/{{$product -> id}}">リンクのテスト</a>
        </p>
        {{$visit}}
        @if(!empty($visit))
        <p>
            来店予定日：{{date('Y年m月d日', strtotime($visit))}}
        </p>
        @endif
        <p>
            From ハイキシェア事務局
        </p>
        
    </body>
</html>

