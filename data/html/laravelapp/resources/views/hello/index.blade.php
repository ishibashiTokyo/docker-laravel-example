<html>
<head>
    <title>Hello/Index</title>
    <style>
        body {
            font-size:16pt;
            color: #999;
        }
        h1 {
            font-size: 100pt;
            text-align: right;
            color: #eee;
            margin: -40px 0px -50px 0px;
        }
    </style>
</head>
<body>
    <h1>Index - by Blade</h1>
    <p>フォームサンプル</p>
    <p>msg: {{$msg}}</p>
    @if ($msg != '')
        <p>$msgは空ではない</p>
    @else
        <p>＄msgは空</p>
    @endif
    <form action="/hello" method="POST">
    <!-- {{csrf_field()}} -->
    @csrf
    <input type="text" name="msg">
    <input type="submit">
    </form>
    <a href="/hello/other">go to Other page.</a>
</body>
</html>
