<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Artisanコンソール</title>
</head>

<body>
    <div class="artisan">
        <h2>Artisanコンソール</h2>
        ArtisanはLaravelが用意しているコマンドラインインタフェースで、アプリケーションの構築に役立つコマンドを多数提供しています。<br>
        コントローラやモデル、マイグレーションファイルなどをテンプレートをもとに作成できます。

        <br><br>

        <table border="#000000">
            <tr>
                <th>コマンド</th>
                <th>内容</th>
            </tr>
            <tr>
                <td>php artisan list</td>
                <td>artisanコマンドのリストを確認</td>
            </tr>
            <tr>
                <td>php artisan make:model xxx</td>
                <td>モデルの作成</td>
            </tr>
            <tr>
                <td>php artisan make:migration create_xxxs_table --create=xxxs</td>
                <td>マイグレーションの作成</td>
            </tr>
            <tr>
                <td>php artisan migrate</td>
                <td>マイグレーションの実行</td>
            </tr>
            <tr>
                <td>php artisan make:seeder XxxTableSeeder</td>
                <td>Seederの作成</td>
            </tr>
            <tr>
                <td>php artisan db:seed</td>
                <td>モデルの作成</td>
            </tr>
            <tr>
                <td>php artisan make:controller XxxController</td>
                <td>コントローラの作成</td>
            </tr>
            <tr>
                <td>php artisan config:cache</td>
                <td>キャッシュのクリア(.envファイルや設定データを編集した際に実施)</td>
            </tr>
            <tr>
                <td>php artisan view:clear</td>
                <td>viewキャッシュクリア(Viewの変更が反映されない場合に行う)</td>
            </tr>
        </table>

        <br><br>
        <a href={{ url('/page_abstruct') }}>ホームへ戻る</a>
    </div>




</body>
</html>