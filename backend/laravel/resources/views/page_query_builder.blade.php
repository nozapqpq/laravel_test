<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>クエリビルダ</title>
</head>

<body>
    <div class="request">
        <h2>クエリビルダ</h2>
        下記サンプルフォームの送信ボタンを押すと、クエリビルダの見本用に作成した関数query_sampleが実行され、予め用意されたsqlテーブルの内容が表示されます。<br>
        routes\web.phpに以下を記述します。
        <pre><code>
        Route::post('query_sample', 'App\Http\Controllers\IroiroController@query_sample');
        </code></pre>
        app\Http\ControllersにIroiroController.phpを用意し、その中にquery_sample関数を記述します。<br>
        [TODO]DBに対するいろいろな操作を記述してみる

        <pre><code>
        public function query_sample(){
            $sample = DB::table('sample')->get();
            return view('query_sample',['sample'=>$sample]);
        }
        </code></pre>

        sqlテーブル"sample"の中身がquery_sample.blade.phpにpostされます。結果をご覧ください。<br><br>

        <h2>サンプルフォーム</h2>
        <form action="query_sample" method="post" accept-charset="utf-8">
          @csrf
          <input type="submit" value="送信" >
        </form>
    </div>




</body>
</html>