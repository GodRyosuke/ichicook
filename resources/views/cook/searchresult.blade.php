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
            <h1><a href="#">市大お料理サイト</a></h1>
            <form action="post">
                <input type="text" placeholder="春のレシピ" class="form-control"> 
                <button type="submit" class="btn btn-primary">検索</button>
            </form>
        </div>
    </div>
    
    <main>
        <div class="container main-con">
            <div class="main-sections">
                <div class="searchresult">
                    <div class="title">
                        <h1>「春」の検索結果一覧</h1>
                    </div>
                    <div class="cards">
                        <a href="#">
                            <div class="card">
                                <img src="{{ asset('img/test.jpg') }}" alt="">
                                <div class="title">テスト料理</div>
                            </div>
                        </a>
                        <a href="#">
                            <div class="card">
                                <img src="{{ asset('img/test.jpg') }}" alt="">
                                <div class="title">テスト料理</div>
                            </div>
                        </a>
                        <a href="#">
                            <div class="card">
                                <img src="{{ asset('img/test.jpg') }}" alt="">
                                <div class="title">テスト料理</div>
                            </div>
                        </a>
                    </div>
                    <div class="pagenation">
                        <ul>
                            <li><a href="#">前へ</a></li>
                            <li><a href="#">1</a></li>
                            <li><a href="#"><<</a></li>
                            <li><a href="#">5</a></li>
                            <li><a href="#">6</a></li>
                            <li><a href="#">7</a></li>
                            <li><a href="#">>></a></li>
                            <li><a href="#">100</a></li>
                            <li><a href="#">次へ</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="sidebar">
                <h3>これはサイドバーです</h3>
            </div>
        </div>
    </main>

    <footer>
        <div class="container">
            <h1>これはフッターである。</h1>
        </div>
    </footer>
    

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>
</html>