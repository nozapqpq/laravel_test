<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>テスト</title>
</head>

<body>
    <div class="request">
        <h2>テスト</h2>
        テストの作成、実行<br>
        対象ファイル等<br>
        <table>
            <tr>
                <th>ファイル名等</th
                ><th>内容</th>
            </tr>
            <tr>
                <td>tests/Unit/ExampleTest.php</td>
                <td>テスト本体</td>
            </tr>
            <tr>
                <td>app/Http/Controllers/HomeController.php</td>
                <td>テスト対象の関数</td>
            </tr>
            <tr>
                <td>
                    app/Models/Phone.php<br>
                    database/factories/PhoneFactory.php<br>
                    database/seeders/FakerPhoneSeeder.php<br>
                    (mysqlのphonesテーブル)
                </td>
                <td>テスト用DB準備</td>
            </tr>

        </table>

        <pre style="font-size:16px;"><code>
        // tests/Featureディレクトリに配置したい場合
        $ php artisan make:test HogeTest
        // tests/Unitディレクトリ内に配置したい場合
        $ php artisan make:test HogeUnitTest --unit
        // テストの実行
        $ ./vendor/bin/phpunit または php artisan test


        // テスト用ダミーデータを生成
        php artisan make:model Phone --migration
        php artisan migrate
        php artisan make:factory PhoneFactory
            (database/factorries配下に配置される)
        php artisan make:seeder FakerPhoneSeeder
        php artisan db:seed --class FakerPhoneSeeder // テスト用データが生成される

        // テスト実行
        // 例：電話番号を000-000-0000の形にできているかをチェックするテスト
        php artisan test tests/Unit/ExampleTest.php
        </code></pre>

        <br><br>
        <a href={{ url('/page_abstruct') }}>ホームへ戻る</a>

    </div>
</body>
</html>