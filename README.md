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

## 新規laravelプロジェクト生成

* dockerからターミナルを起動し、appコンテナから、laravelディレクトリの中身を空にした状態で行う
* composer create-project laravel/laravel
* php artisan --versionでv9.0以上で生成されていることを確認する

## kaisai.csvについて

* レース検索の☆6
* F8->☆画面イメージ(csv)で出力
