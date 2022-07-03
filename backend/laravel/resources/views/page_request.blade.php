<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>リクエスト処理</title>
</head>

<body>
    <div class="request">
        <h2>リクエスト処理</h2>

        フォームの内容を送信し、別のページで受けます。<br>
        まずフォームのactionとLaravelのコントローラを結びつけます。routes\web.phpに以下を記述します。
        <pre style="font-size:16px;"><code>
        Route::post('request_post', 'App\Http\Controllers\RequestSampleController@request_post');
        </code></pre>

        説明用ファイル一覧<br>
        <table border="#000000">
            <tr>
                <th>ファイル名等</th
                ><th>内容</th>
            </tr>
            <tr>
                <td>App/Http/Controllers/RequestSampleController.php</td>
                <td>フォームで指定した"request_post"の処理</td>
            </tr>
        </table>

        <br><br>

        <h2>サンプルフォーム</h2>
        フォーム内容のeval,commentがrequest_result.blade.phpにpostされます。<br><br>
        <form action="request_post" method="post" accept-charset="utf-8">
          @csrf
          eval：
          <label>
            <input type="radio" name="eval" value="A" checked="checked">A
          </label>
          <label>
            <input type="radio" name="eval" value="B">B
          </label>
          <br>

          comment：
          <input type="text" name="comment" value="">
          <input type="submit" value="送信" >
        </form>

        <br><br>
        <a href={{ url('/page_abstruct') }}>ホームへ戻る</a>
    </div>




</body>
</html>