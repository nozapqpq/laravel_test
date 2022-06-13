<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>認証</title>
</head>

<?php
    $user = Auth::user();
    $login_status_msg = "ログインされていません";
    if (Auth::check()) {
        $login_status_msg = "ログインしてます。おかえりなさい".$user->name."さん";
    }
?>
<body>
    <div class="request">
        <h2>認証</h2>
        これらの認証サービスを手作業より素早く開始できるよう、認証レイヤ全体のスカフォールド(骨組み)を提供する無料パッケージが存在<br>
        Laravel Breeze, Laravel Jetstream, Laravel Fortify<br><br>

        ここではLaravel Breezeを使った例を説明<br><br>
        Laravel Breezeパッケージのインストール<br>
        <pre><code>
        $ composer require laravel/breeze
        $ php artisan breeze:install
        $ npm install && npm run dev
        $ php artisan migrate
        </code></pre>



        <br><br>

        できあがったもの<br>
        Laravel Breezeパッケージをインストールするだけで、何もしなくても一通りのことが行えるようになります。<br>
        <a href="/register">ユーザー登録</a><br>
        <a href="/login">ログイン</a><br>
        
        <br><br>

        ↓↓ログイン状態↓↓<br><br>
        {{ $login_status_msg }}<br>

        <br><br>




</body>
</html>