UnitTestを行うための簡易的なツール
----------
WordPressでUnitTestを行うためのものとしてはWP_UnitTestCaseがありますが、一般的なUnitTestのツールキットと同様に、テスト用データはテストのsetUp()などで生成してやる必要があります。

色々なバリエーションの投稿データやアイキャッチ画像の設定などをプログラムで用意するのはちょっと面倒なため、既存あるいはテスト用のWordPressのデータをそのまま利用してUnitTestできるようにしました。

基本的にはオリジナル（ http://develop.svn.wordpress.org/trunk/tests/phpunit/ ）のファイルをベースにして、データを初期化・削除するロジックなどを除去した上で、必要最小限のロジックだけを残しています。

# 利用方法
- wp-test-config.php にテスト対象サイトを設定
- test/test-*.php として、UnitTest を書いていく
- phpunit を実行(環境変数の存在チェックをしていない行儀の悪いプラグインがある場合は、こんな感じで呼び出せばOKです)

```php
HTTP_HOST='example.jp' phpunit
```

※詳細は、exampleディレクトリのファイルを参照ください。

## wp-test-config.phpの設定内容
### WP_TESTS_DOMAIN
テスト対象のサイトのドメインを指定します。

### $wp_dir
wordpressのインストールされているディレクトリを指定します。

### $lib_dir
hykw-wp-easyUnitTestをgit cloneしたディレクトリを指定します。
