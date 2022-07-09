# laravel_test

構成

* docker-compose.yml
* docker_files
* backend

## docker-compose初回

* docker-compose build
## Dockerfileの更新を反映

* docker-compose up -d --build

## docker-compose.ymlの更新を反映させる

* docker-compose up -d

## DB構築手順

* モデルとマイグレーション作成
    - `php artisan make:model models/aaa -m`
    - migrations/xxxx_create_aaas_table.phpにDBデータ作成
* seeder作成
    - `php artisan make:seeder AaasTableSeeder`
    - database/seeds/AaasTableSeeder.phpにseeder定義
    - database/seeds/DatabaseSeeder.phpにシーディング対象追加
        - `$this->call(AaasTableSeeder::class);`
* マイグレーションとシーディングを実行
    - `php artisan migrate --seed`
*[TODO]続き：モデル実装～

## 新規laravelプロジェクト生成

* dockerからターミナルを起動し、appコンテナから、laravelディレクトリの中身を空にした状態で行う
* composer create-project laravel/laravel
* php artisan --versionでv9.0以上で生成されていることを確認する

* 初回メモ
    - docker desktop for windowsを使用する前提です
    - まずdocker-compose build
    - laravelフォルダを一度削除、composer create-project laravel/laravelでlaravelをインストール、削除したファイル類をgit checkoutで元に戻す(.gitignoreを優先で戻す)
    - dockerから最初のページを開こうとした際、storage/logsおよびframeworkのファイルのパーミッションでエラーになることがあります
    - DBがうまくいかないときは.envを確認してください
        - DB_HOST=db, DB_DATABASEやUSERNAME等はdocker_filesにあるmysqlのDockerfileを参照ください

## kaisai.csvについて

* レース検索の☆6
* F8->☆画面イメージ(csv)で出力
