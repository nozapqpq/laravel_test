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
        <pre><code>
        Route::post('request_post', 'App\Http\Controllers\RequestSampleController@request_post');
        </code></pre>
        app\Http\ControllersにRequestSampleController.phpを用意し、その中にrequest_post関数を記述します。

        <pre><code>
        public function request_post(Request $request) {
            $attributes = $request->only(['eval','comment']);
            return view('request_result',compact('attributes'));
        }
        </code></pre>

        フォーム内容のeval,commentがrequest_result.blade.phpにpostされます。結果をご覧ください。<br><br>

        <h2>サンプルフォーム</h2>
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
    </div>




</body>
</html>