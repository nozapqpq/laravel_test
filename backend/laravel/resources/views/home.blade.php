<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CSVからDBインポートサンプル</title>
</head>

<body>

  <div class="upload">
    <p>DBに追加したい開催情報のCSVデータを選択してください。</p>
    <form action="kaisai" method="post" enctype="multipart/form-data">
      @csrf // [TODO] DBへの追加のとき用のチェックボックスをつくる。ONのとき、最初にdeleteせずに追加する
      <input type="file" name="csvdata" />
      <button>送信</button>
    </form>
  </div>

  <div class="netkeiba_input">
    <p>データを取得したいレースの情報を入力してください。</p>
    <form action="nk" method="post" enctype="multipart/form-data">
      @csrf
      <select class="form-control" id="category-id" name="year">
        @for ($i = 2013; $i <= 2021; $i++)
          <option value="{{ $i }}">{{ $i }}</option>
        @endfor
      </select>
      年
      <select class="form-control" id="category-id" name="month">
        @for ($i = 1; $i <= 12; $i++)
          <option value="{{ $i }}">{{ $i }}</option>
        @endfor
      </select>
      月
      <select class="form-control" id="category-id" name="day">
        @for ($i = 1; $i <= 31; $i++) // [TODO] ここは月と年に適した上限値になるようにしたい。configフォルダを使う？？
          <option value="{{ $i }}">{{ $i }}</option>
        @endfor
      </select>
      日
      <select class="form-control" id="category-id" name="race_number">
        @for ($i = 1; $i <= 12; $i++)
          <option value="{{ $i }}">{{ $i }}</option>
        @endfor
      </select>
      R
      <button>送信</button>
    </form>
  </div>


</body>
</html>