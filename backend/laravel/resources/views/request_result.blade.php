<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>リクエスト処理：送信結果</title>
</head>

<body>
  <h2>送信されてきたもの</h2>
  eval：{{$attributes['eval']}}<br>
  comment：{{$attributes['comment']}}



</body>
</html>
