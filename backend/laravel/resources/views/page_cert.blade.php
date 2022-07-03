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
        <pre style="font-size:16px;"><code>
        $ composer require laravel/breeze
        $ php artisan breeze:install
        $ npm install && npm run dev
        $ php artisan migrate
        </code></pre>

        できあがったもの<br>
        Laravel Breezeパッケージをインストールするだけで、何もしなくても一通りのことが行えるようになります。<br>
        <a href="/register">ユーザー登録</a><br>
        <a href="/login">ログイン</a><br>
        
        <br>

        説明用ファイル一覧<br>
        <table border="#000000">
            <tr>
                <th>ファイル名等</th
                ><th>内容</th>
            </tr>
            <tr>
                <td>resources/views/dashboard.blade.php</td>
                <td>ログインページ、認証パッケージのインストール時に生成される</td>
            </tr>
            <tr>
                <td>App/Http/Controllers/Auth/AuthenticatedSessionController.php</td>
                <td>ログアウト時の処理</td>
            </tr>
        </table>

        <br><br>

        ↓↓ログイン状態がAuth::check()で取得できることを確認↓↓<br><br>
        {{ $login_status_msg }}<br>

        <br><br>
        <a href={{ url('/page_abstruct') }}>ホームへ戻る</a>




</body>
</html>