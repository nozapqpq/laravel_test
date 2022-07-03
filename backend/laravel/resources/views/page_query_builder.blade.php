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

        説明用ファイル一覧<br>
        <table border="#000000">
            <tr>
                <th>ファイル名等</th
                ><th>内容</th>
            </tr>
            <tr>
                <td>App/Http/Controllers/IroiroController.php</td>
                <td>サンプルフォームの送信ボタン押下時に実行される関数query_sample<br>
                    用意したsqlテーブルのうち、指定した条件と一致する内容が表示される</td>
            </tr>
            <tr>
                <td>mysqlのsampleテーブル</td>
                <td>サンプル用DB</td>
            </tr>
        </table>

        <br>
        routes\web.phpに以下を記述します。
        <pre style="font-size:16px;"><code>
        Route::post('query_sample', 'App\Http\Controllers\IroiroController@query_sample');
        </code></pre>
    
        <h2>サンプルフォーム</h2>
        sqlテーブル"sample"の中身がquery_sample.blade.phpにpostされます。<br><br>
        <form action="query_sample" method="post" accept-charset="utf-8">
          @csrf
          <input type="submit" value="送信" >
        </form>

        <br><br>
        <a href={{ url('/page_abstruct') }}>ホームへ戻る</a>
    </div>




</body>
</html>