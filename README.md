# Docker-Laravel-Example

勉強用に作成したレポジトリ

| ミドルウェア | サービス名 | ポート     | 使用イメージ          |
| ------------ | ---------- | ---------- | --------------------- |
| Nginx        | web        | 80         | nginx:1.19.0-alpine   |
| PHP          | app        | 9000, 9001 | php:7.3.19-fpm-alpine |
| MariaDB      | db         | 3306       | mariadb:latest        |
| phpMyAdmin   | phpmyadmin | 8080       | phpmyadmin/phpmyadmin |

概要

- シンプルな LEMP 構成
- alpine Linux でサイズを小さく
- Docker イメージがないような CMS を構築したり、PHP の開発環境として使用する。
- SSL 未対応
- phpMyAdmin http://localhost:8080/
- composer を初期導入

## TODO

## composer を使った Laravel のインストール

php-fpm のコンテナ上から以下のコマンドを実行

```shell
$ cd /var/www/html
$ composer create-project laravel/laravel プロジェクト名 --prefer-dist
```

## コントローラーの作成

プロジェクトフォルダに移動して artisan（アーティザン）コマンドを実行  
命名規則：`{NAME}Controller`  
下記の例ではlaravelapp/app/Http/Controllers/HelloController.phpが作成される

```shell
$ cd /var/www/html/laravelapp
$ php artisan make:controller HelloController
Controller created successfully.
```

## Docker ファイル構成

```
docker-lemp
├── .env # データベースの初期設定
├── .gitignore
├── README.md # 今読んでるこれ
├── app
│   ├── Dockerfile # php-fpmの設定ファイル
│   └── docker-xdebug.ini # xdebugの設定ファイル
├── conf
│   └── nginx
│       └── default.conf # Nginxの初期設定
├── data
│   ├── html # ドキュメントルート
│   │   └── index.php # サンプルプログラム
│   └── mysql # DBの物理ファイルが格納（.gitignore）
├── db
│   └── initial.sql # 初期実行されるSQL文
└── docker-compose.yml
```

## Laravel ファイル構成

```shell
% tree -L 1 -a  .
.
├── .editorconfig
├── .env              動作環境に関する設定情報
├── .env.example      動作環境に関する設定情報
├── .gitattributes    git利用に関する情報
├── .gitignore        git利用に関する情報
├── .styleci.yml
├── README.md
├── app               [!]アプリケーションのプログラム置き場
├── artisan           artisanコマンド `php artisan serve`
├── bootstrap         アプリケーション実行時に最初に行われる処理をまとめる場所
├── composer.json     composerファイル
├── composer.lock     composerファイル
├── config            アプリケーションの設定（定数）ファイル置き場
├── database          データベース関係のプログラム
├── package.json      npmファイル
├── phpunit.xml       PHPUnitファイル
├── public            公開ディレクトリ
├── resources         [!]テンプレートファイル置き場
├── routes            [!]ルーティング情報
├── server.php        PHPのビルドインサーバーを利用したときに使用するファイル
├── storage           アプリケーションの出力するファイル置き場　ログファイルなど
├── tests             ユニットテスト用ファイル置き場
├── vendor            フレームワークのコア
└── webpack.mix.js    webpackファイル
```

## app ファイル構成

```shell
% tree -L 1 -a .
.
├── Console       コンソールプログラム置き場
├── Exceptions    例外処理の置き場
├── Http          [!]基本的なアプリケーションプログラム置き場
├── Providers     プロバイダプログラムの置き場
└── User.php      ユーザ認証用プログラム
```

## routes ファイル構成

```shell
% tree -L 1 -a .
.
├── api.php       API用ルーティング
│                 プログラム内から利用するAPI機能を特定のアドレスに割り当てるときに使用
├── channels.php  ブロードキャスト用ルーティング
├── console.php   コンソール用ルーティング
└── web.php       [!]Webページ用ルーティング
                  Webページとしてこうかいするものはすべてここに記述する
```

## メモ

ルーティング
- マルチアクションコントローラの場合  
  アクションとアドレスの関係は以下のようになるようにルーティングする  
  `http://アプリケーションのアドレス/コントローラ/アクション`
- シングルアクションコントローラの場合  
  1つのコントローラに1つのアクションしか用意しない場合は`__invoke`というマジックメソッドを使用する  
  コントローラにメソッドは追加できるが、アクションとして呼び出すことはできなくなる。  
  ルーティングにはアクションを示す`@~`の指定は必要なし

テンプレートエンジン

- Blade（ブレード）という独自テンプレートエンジンを採用
- テンプレートファイルの置き場はlaravelapp/resources/views/
- テンプレートのファイル構成はコントローラの構成に添ったように構築するとわかりやすい。  
  コントローラ名のフォルダを作成し、アクションごとのテンプレートファイルを設置する
- テンプレートファイルがindex.phpとindex.blade.phpがあった場合は後者が優先される
- `view()`関数は resources/views/{引数}.blade.php を表示する
- プレースホルダーの使用は`view()`関数の第二引数に連想配列で格納する
- CSRF対策のコード`{{csrf_token()}}`は5.6-で`@csrf`でも対応可能になった
- POST投稿を行うときにCSRF対策を行わないと419エラーが発生する
- 
