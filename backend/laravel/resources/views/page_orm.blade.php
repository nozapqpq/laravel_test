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

        説明用ファイル一覧<br>
        <table border="#000000">
            <tr>
                <th>ファイル名等</th
                ><th>内容</th>
            </tr>
            <tr>
                <td>App/Http/Controllers/IroiroController.php</td>
                <td>サンプルフォームの送信ボタン押下時に実行される関数orm_sample<br>
                    テーブルへのレコード挿入を行い、テーブル内容を表示
            </tr>
            <tr>
                <td>App/Http/Models/models/orm.php</td>
                <td>DBのモデル</td>
            </tr>
            <tr>
                <td>database/seeders/OrmTableSeeder.php</td>
                <td>DBのseeder</td>
            </tr>
            <tr>
                <td>database/migration/2022_06_08_140130_create_orms_table.php</td>
                <td>DBのmigration</td>
            </tr>
            <tr>
                <td>mysqlのormsテーブル</td>
                <td>サンプル用DB</td>
            </tr>
        </table>

        <br>
        routes\web.phpに以下を記述します。
        <pre style="font-size:16px;"><code>
        Route::post('orm_sample', 'App\Http\Controllers\IroiroController@orm_sample');
        </code></pre>


        

        <h2>サンプルフォーム</h2>
        orm_sample()でsqlテーブル"orms"と結びつけられたオブジェクトの処理を行い、<br>
        処理結果のテーブルの中身をorm_sample.blade.phpにpostします。<br><br>
        <form action="orm_sample" method="post" accept-charset="utf-8">
          @csrf
          <input type="submit" value="送信" >
        </form>

        <br><br>
        <a href={{ url('/page_abstruct') }}>ホームへ戻る</a>
    </div>




</body>
</html>