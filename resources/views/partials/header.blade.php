<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>市大料理まとめ</title>
</head>
<body>
    <div class="header">
        <div class="container">
            <h1><a href="{{ route('welcome') }}">市大お料理サイト</a></h1>
            <form action="{{ route('ichicooksearch') }}" name="cooksearch" method='post'>
                @csrf
                <input type="text" placeholder="春のレシピ" class="form-control" name="search"> 
                <button type="submit" class="btn btn-primary">検索</button>
            </form>
        </div>
    </div>