<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>サービスコンテナ</title>
</head>

<body>
    <div class="request">
        <h2>サービスコンテナによる依存注入(Dependency Injection, DI)</h2>
        依存性の注入：あるクラスが依存している別のオブジェクトを外部から渡すことで、クラス間の依存度を下げる設計パターン<br>

        クラスhoge内でaaaメソッドを使用するためにAAAクラスが必要とすると、hogeはAAAクラスに依存していることになる<br>
        DIを使用するとAAAクラスに依存せずにhoge内でaaaメソッドが使える<br>

        実装パターンとして次の2種類がある：<br>
        ・コンストラクタインジェクション<br>
            hogeクラスのコンストラクタの引数にタイプヒンティングでAAAクラスを注入することで、hogeクラス内でAAAのインスタンスが使えるようになる<br>
        ・メソッドインジェクション<br>
            aaaメソッドの引数にタイプヒンティングでAAAクラスを注入することで、メソッド内でAAAのインスタンスを使えるようにする<br>
        laravelでのサービスコンテナによるコンストラクタインジェクションの例を下記サンプルフォームにて示す<br>

        <br><br>


        下記サンプルフォームの送信ボタンを押すと、ORMの見本用に作成した関数orm_sampleが実行され、予め用意されたsqlテーブルの内容が表示されます。<br>
        routes\web.phpに以下を記述します。
        <pre><code>
        Route::post('orm_sample', 'App\Http\Controllers\IroiroController@orm_sample');
        </code></pre>
        app\Http\ControllersにIroiroController.phpを用意し、その中にorm_sample関数を記述します。<br>


        <h2>サンプルフォーム</h2>
        <form action="di_sample" method="post" accept-charset="utf-8">
          @csrf
          <input type="submit" value="送信" >
        </form>
    </div>




</body>
</html>