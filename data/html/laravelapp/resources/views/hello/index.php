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
    <h1>Index</h1>
    <p><?php echo $msg; ?></p>
    <p><?php echo date('Y/n/j'); ?></p>
    <p>test String</p>
    <a href="/hello/other">go to Other page.</a>
</body>
</html>
