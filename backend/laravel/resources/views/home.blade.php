<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CSVからDBインポートサンプル</title>
</head>

<body>

  <div class="upload">
    <form action="yuma_analysis/extract" method="post">
      @csrf
      <input name="date" type="date" />
      <select name="place">
        <option value="sapporo">札幌</option>
        <option value="hakodate">函館</option>
        <option value="fukushima">福島</option>
        <option value="niigata">新潟</option>
        <option value="nakayama">中山</option>
        <option value="tokyo">東京</option>
        <option value="chukyo">中京</option>
        <option value="kyoto">京都</option>
        <option value="hanshin">阪神</option>
        <option value="kokura">小倉</option>
      </select>
      <input name="race" type="text" maxlength=3 size=3 />R<br>
      <button>期待値計算</button>
    </form>
    <br>
    ゆまちゃん競馬からの画像取り込み(laravel/downloadフォルダを作成する必要あり。chmod 777として)<br><br>

    画像解析(Google APIを使う)<br>
    .envにGOOGLE_CLOUD_PROJECTとGOOGLE_APPLICATION_CREDENTIALSを追加<br>
    composer require google/cloud-vision<br>
    apt-get install python3<br>
    apt install python3-pip<br>
    pip3 install --upgrade pip<br>
    pip3 install Pillow<br><br>

    netkeibaからのオッズデータ取得<br>
    pip3 install pandas<br>
    pip3 install selenium<br>
    apt install libgconf-2-4<br>
    apt install libnss3<br>
    (apt upgrade?)<br>
    apt install gnupg gnupg1 gnupg2<br>
    sudo wget -q -O - https://dl-ssl.google.com/linux/linux_signing_key.pub | sudo apt-key add -<br>
    apt update<br>
    apt install google-chrome-stable<br>
    google-chrome --version<br>
    export CHROME_VERSION=103.0.5060.134<br>
    wget https://chromedriver.storage.googleapis.com/$CHROME_VERSION/chromedriver_linux64.zip<br>
    (unzipして/usr/local/binにchromedriverを置く)<br><br>

    [TODO]<br>
    地方競馬対応<br>
    自動的に買う<br>
    <p>DBに追加したい開催情報のCSVデータを選択してください。</p>
    <form action="kaisai" method="post" enctype="multipart/form-data">
      @csrf // [TODO] DBへの追加のとき用のチェックボックスをつくる。ONのとき、最初にdeleteせずに追加する<br>
      <input type="file" name="csvdata" />
      <button>送信</button>
    </form>
  </div>

</body>
</html>