<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>概要</title>
</head>

<body>
    <div class="abstruct">
        <h2>Laravelとは(ここは外部サイト)</h2>
            <p>MVCのWebアプリケーション開発用のPHPで書かれたWebアプリケーションフレームワークです</p>
            <a href="https://ja.wikipedia.org/wiki/Laravel">詳しくはこちら(wikipedia)</a><br>
            <a href="https://tech-camp.in/note/technology/103665/">PHPで作られたwebページの例</a><br>
            <a href="https://programmer-life.work/php/laravel-web-site">Laravelで作られたwebページの例</a><br>
            <a href="https://codezine.jp/article/detail/13747">Laravelを使う理由など</a><br><br>
        <h2>メリット、デメリット</h2>

        <table border="#000000">
            <tr>
                <td>メリット</td>
                <td>
                    自由度が高い、ディレクトリ構成を自由にできる<br>
                    人気が高くネットで情報を集めやすい<br>
                    学習コストが低い(PHP未経験でも特に意識せず一通りの機能を試せた)<br>
                </td>
            </tr>
            <tr>
                <td>デメリット</td>
                <td>
                    (他のフレームワークと比較して)処理速度が遅い<br>
                    自由度が高いために好きなように書けてしまう(複数人で開発する際はルールを決めるなど注意が必要)<br>
                </td>
            </tr>
        </table>
        <br>

        <h2>Laravelの機能について(ここからは自作のページ)</h2>
        最初にディレクトリの構成から、よく使った部分を大雑把に確認：MVC,DB,ルーティング<br>
        <a href="{{ url('page_artisan') }}">Artisanコンソール</a><br>
        <a href="{{ url('page_routing') }}">ルーティング</a><br>
        <a href="{{ url('page_request') }}">リクエスト処理</a><br>
        <a href="{{ url('page_query_builder') }}">クエリビルダー</a><br>
        <a href="{{ url('page_orm') }}">ORM(Eloquent)</a><br>
        <a href="{{ url('page_di') }}">依存注入</a><br>
        <a href="{{ url('page_cert') }}">認証</a><br>
        <a href="{{ url('page_test') }}">ユニットテスト</a><br>

        <h2>参考にしたサイト</h2>
        <a href="https://readouble.com/">ReaDouble</a><br>
        更に詳しくlaravelについて知りたい方はこのサイトが便利です。<br>
        
    </div>
</body>
</html>