<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ルーティング</title>
</head>

<body>
    <div class="routing">
        <h2>ルーティング</h2>

        URIとクロージャを引数にとり、複雑なルーティング設定ファイル無しでルートと動作を定義できる基本的なLaravelルート<br>
        <pre style="font-size:16px;"><code>
        use Illuminate\Support\Facades\Route;

        Route::get('/greeting', function () {
            return 'Hello World';
        });
        </code></pre>
        説明用ファイル一覧<br>
        <table border="#000000">
            <tr>
                <th>ファイル名等</th
                ><th>内容</th>
            </tr>
            <tr>
                <td>routes/web.php</td>
                <td>アドレスバーに渡す文字列と実行するコントローラ名との対応を記述</td>
            </tr>
            <tr>
                <td>App/Http/Controllers/PageAbstructController.php</td>
                <td>"routing"を指定した際の処理の例示</td>
            </tr>
        </table>
        <pre style="font-size:16px;"><code>
        use Illuminate\Support\Facades\Route;

        Route::get('page_routing', 'App\Http\Controllers\PageAbstructController@routing');
        </code></pre>
        routes\web.phpに上記のように記述し、http://localhost:8080/page_routingにアクセスすることで<br><br>
        app\Http\Controllers\PageAbstructController.phpの処理に従い<br><br>
        このページ(resources\viewsディレクトリの中にあるファイル、page_routing.blade.php)が表示されます。<br><br>

        <a href={{ url('/page_abstruct') }}>ホームへ戻る</a>
    </div>
</body>
</html>