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
        <p>{{$product}}
            商品名：{{$product -> name}}
        </p>
        <p id="button">
            <a href="https://www.google.co.jp.{{$product -> id}}">リンクのテスト</a>
        </p>
        <p>
            来店予定日：{{$visit -> timezone("JST") -> format('m月d日')}}
        </p>
        <p>
            From ハイキシェア事務局
        </p>
        
    </body>
</html>

