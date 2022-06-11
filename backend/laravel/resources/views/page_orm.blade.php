<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ORM</title>
</head>

<body>
    <div class="request">
        <h2>ORM</h2>
        Laravelには、データベースとの対話を楽しくするオブジェクトリレーショナルマッパー(ORM)であるEloquentが含まれています。<br>
        Eloquentを使用する場合、各データベーステーブルには対応する「モデル」があり、そのテーブルとの対話に使用します。<br>
        Eloquentモデルでは、データベーステーブルからレコードを取得するだけでなく、テーブルへのレコード挿入、更新、削除も可能です。<br><br>

        モデル、DB作成<br>
        php artisan make:model models/orm -m<br>
        php artisan make:seeder OrmTableSeeder<br><br>


        ここまで。<br>
        下記サンプルフォームの送信ボタンを押すと、ORMの見本用に作成した関数orm_sampleが実行され、予め用意されたsqlテーブルの内容が表示されます。<br>
        routes\web.phpに以下を記述します。
        <pre><code>
        Route::post('orm_sample', 'App\Http\Controllers\IroiroController@orm_sample');
        </code></pre>
        app\Http\ControllersにIroiroController.phpを用意し、その中にorm_sample関数を記述します。<br>

        (実際にコードを確認。テーブルへのレコード挿入、更新、削除を行う。)<br><br>


        sqlテーブル"orms"の中身がorm_sample.blade.phpにpostされます。結果をご覧ください。<br><br>

        <h2>サンプルフォーム</h2>
        <form action="orm_sample" method="post" accept-charset="utf-8">
          @csrf
          <input type="submit" value="送信" >
        </form>
    </div>




</body>
</html>