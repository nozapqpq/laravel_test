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

        <table border="#000000">
            <tr>
                <th>ファイル名等</th
                ><th>内容</th>
            </tr>
            <tr>
                <td>App/Http/Controllers/IroiroController.php</td>
                <td>コンストラクタインジェクションの例di_sample<br>
            </tr>
            <tr>
                <td>App/Components/Calculation.php</td>
                <td>コンストラクタインジェクションされる関数</td>
            </tr>
            <tr>
                <td>App/Providers/CalculationServiceProvider.php<br>
                    config/app.php</td>
                <td>コンストラクタインジェクションされる関数のサービスプロバイダ<br>
                    サービスプロバイダはapp.phpに登録が必要</td>
            </tr>
        </table>

        <br><br>

        routes\web.phpに以下を記述します。
        <pre style="font-size:16px;"><code>
        Route::post('orm_sample', 'App\Http\Controllers\IroiroController@orm_sample');
        </code></pre>


        <h2>サンプルフォーム</h2>
        コンストラクタインジェクションされたクラスの処理を実行<br>
        <form action="di_sample" method="post" accept-charset="utf-8">
          @csrf
          <input type="submit" value="送信" >
        </form>

        <br><br>
        <a href={{ url('/page_abstruct') }}>ホームへ戻る</a>
    </div>




</body>
</html>