<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>自動購入</title>
</head>

<body onload="setTimeout(function(){document.time.submit()},40000);">

  <div class="upload">
    <form name="time" action="yuma_analysis/time_trigger" method="post">
      @csrf
      <button>自動購入(ボタン押下不要)</button>
    </form><br>
  </div>

</body>
</html>