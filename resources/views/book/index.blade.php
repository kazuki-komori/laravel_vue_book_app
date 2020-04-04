<!doctype html>
<html lang=ja">
<head>
    <meta charset="UTF-8">
    <title>vue + laravel試作アプリ</title>
    <meta name="csrf-token" content="{{csrf_token()}}">
</head>
<body>
    <div id="app">
        <book-component></book-component>
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
