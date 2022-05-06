<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>概要</title>
</head>

<body>
    <div class="abstruct">
        <h2>Laravelとは</h2>
        <p>MVCのWebアプリケーション開発用のPHPで書かれたWebアプリケーションフレームワークです</p>

        <h2>Laravelの機能について</h2>
        <a href="{{ url('page_routing') }}">ルーティング</a><br>
        <a href="{{ url('page_request') }}">リクエスト処理</a><br>
        <a href="{{ url('page_query_builder') }}">クエリビルダー</a><br>
        <a href="{{ url('page_orm') }}">ORM</a><br>
        <a href="{{ url('page_di') }}">依存注入</a><br>
        <a href="{{ url('page_cert') }}">認証</a><br>
        <a href="{{ url('page_test') }}">ユニットテスト</a><br>
        <a href="{{ url('page_artisan') }}">Artisanコンソール</a><br>
        
    </div>
</body>
</html>