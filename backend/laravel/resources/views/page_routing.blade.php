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
        <pre><code>
        use Illuminate\Support\Facades\Route;

        Route::get('page_routing', 'App\Http\Controllers\PageAbstructController@routing');
        </code></pre>
        routes\web.phpに上記のように記述し、http://localhost:8080/page_routingにアクセスすることで<br><br>
        app\Http\Controllers\PageAbstructController.phpの処理に従い<br><br>
        このページ(resources\viewsディレクトリの中にあるファイル、page_routing.blade.php)が表示されます。<br><br><br>
        PageAbstructController.phpには次のように記述してあります。

        <pre><code>
        public function routing() {
            return view('page_routing');
        }
        </code></pre>
    </div>

</body>
</html>