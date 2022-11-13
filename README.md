# anthill

## A. 概要

イベントなどの参加申し込みを受け付けるフォームです。
レンタルサーバでの利用を想定しています。
複数のイベントに対応し、イベント毎に入力項目を設定することができます。
受け付けた内容は SQLite のデータベースに保存し、管理者機能で一覧表示します。
記入項目にメールアドレスを含む場合、そのメールアドレス宛にイベント毎に設定したメッセージと確認のための受付内容を自動で送信することができます。

PHP 7.4 で動作確認しています。 8.0 と 8.1 でも問題なく動作すると思われますが、未テストです。

記入項目の設定のために PHP の基本的な知識が必要です。
Python など他の言語の経験者で「PHP はなんとなくわかる」くらいの人でもだいじょうぶです。

WordPress を利用されている場合は
[Contact Form 7](https://wordpress.org/plugins/contact-form-7/)
などのプラグインの方がいいです。
このツールはそのような便利なものが利用できない場合や、
Google Forms ではうまくいかない場合にご利用ください。

## B. 利用方法

### B.1. 配置

`form.php` だけを Webサーバ上で公開します。それ以外はすべて非公開の場所に置いてください。

エックスサーバーの場合

```text
+---anthill
|   |
|   |   main.php
|   |   database.sqlite3.seed
|   |   event00.php
|   |
|   +---services
|   +---views
|
+---public_html
    +---form.php
```

さくらのレンタルサーバの場合は `public_html` が `www` になります。

`form.php` のファイル名は変更しても差し支えありません。また、サブディレクトリに置いてもいいです。ただし URL が変わりますので、そのあたりがよくわからない場合はこのままお使いください。

上記の配置と異なる場合は必要に応じて `form.php` の `require_once('../anthill/main.php');` を書き換えてください。

次に、イベントID を決めてください。半角英数字が利用できます。以下、イベントID を `evant01` として手順を記載します。

`event00.php` をコピーして `event01.php` を作成してください。

`database.sqlite3.seed` をコピーして `database.sqlite3` を作成してください。

以下のようになります。

```text
+---anthill
|   |
|   |    main.php
|   |    database.sqlite3.seed
|   |    database.sqlite3
|   |    event00.php
|   |    event01.php
|   |
|   +---services
|   +---views
|
+---public_html
    +---form.php
```

`event01` の受付フォームの URL は `https://ドメイン名/form.php?event=event01` です。

管理者メニューの URL は `https://ドメイン名/form.php?action=admin` です。

### B.2. 管理者のアカウントの設定

Webブラウザを `https://ドメイン名/form.php?action=admin` で開くとログインページが表示されます。管理者のアカウントがまだ設定されていない場合、このログインページ記入した「メールアドレス」と「パスワード」が最初の管理者のアカウントになります。また、このアカウントには他の管理者の追加・変更できる `sys` 権限が付与されます。操作ミス等で意図しない管理者のアカウントができてしまった場合は `database.sqlite3` を作成し直してください。

登録した管理者のメールアドレスは変更できません。

自分自身のパスワードは変更できます。

`sys` 権限を持つアカウントは他のアカウントについて、追加、権限の変更、パスワード再発行ができます。

パスワード再発行を実行すると、ランダムなパスワードを生成して設定し、本人のメールアドレス宛に通知します。

管理者の権限には `sys` と、各イベントを管理する権限の 2種類があります。各イベントを管理する権限の名称は、イベントIDです　。

権限は半角のカンマ `,` で区切って記入してください。

例) `sys,event01,event02`

### B.3. 記入項目の設定

`event01.php` を編集して、入力項目をカスタマイズしてください。
文法エラーがあるとフォームが表示されません。多数のエラーがあると対処がたいへんですので、フォームの表示結果を確認しながら1項目ずつ設定されることをお勧めします。

`'type'` には以下のものを設定できます。

- `message` : フォームに表示する文章
- `text` : 1行のテキスト
- `email` : メールアドレス
- `textarea` : 複数行のテキスト
- `radio` : 選択項目 -- `'options'` に選択項目を設定してください。
- `checkbox` : チェックボックス

それから、未テストですが、　HTML の `input` 要素の `type` 属性の設定値のうち
`date`, `datetime-local`, `month`, `number`, `tel`, `time`, `url`, `week`
は Webブラウが対応していればそれなりに動くと思われます。
`file` には対応していません。

入力値の暗号化には対応していませんので `password` は使用しないでください。また、パスワードなどの認証情報を受け付ける項目は作成しないでください。

`'name'` はデータベースの項目名です。半角英数字で一意の名称を設定してください。

`'label'` はフォームに表示する項目名です。

`'required'` : 必須/任意 -- `true` または `false` を設定してください。

### B.4. 受付内容の参照

管理者メニューの「申し込み一覧」に、権限を付与されたイベントIDのリンクが表示されます。
そのリンクをクリックすると受け付けた申し込みの一覧が表示されます。一覧は申し込みの順です。
この一覧をマウスで選択してコピーし、 Excel などに貼り付けることができます。

## B.5. その他

このツールはオープンソースです。商用での利用や流用・改変についての制限はありません。詳細は [ライセンス](LICENSE) をご参照ください。

設置やカスタマイズを希望される場合はご連絡ください。

## C. 開発

PHP は 7.4 以降を使用してください。

```bash
$ php --version
PHP 8.1.10 (cli) ... ... ...

$ git clone git@github.com:MichinobuMaeda/anthill.git
$ cd anthill
$ cp anthill/database.sqlite3.seed anthill/database.sqlite3
$ cp anthill/event00.php anthill/event01.php
$ php -S localhost:8080 -t public_html
```

フォームの表示 <http://localhost:8080/form.php?event=event01>

管理者メニュー <http://localhost:8080/form.php?action=admin>

メールの送信ができない環境の場合は `mb_send_mail(...)` の箇所をコメントアウトするか、
[fake sendmail for windows](https://www.glob.com.au/sendmail/)
のようなツールを利用するか、ログ出力等のテスト用の処理に変更してください。

