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
            <?php if (isset($is_login)): ?>
                <?php if ($is_login == true): ?>
            <div class="alert alert-primary">ログインしました</div>
                <?php else: ?>
            <div class="alert alert-danger">ログイン情報に誤りがあります</div>
                <?php endif; ?>
            <?php endif; ?>
            <?php if (isset($is_logout)): ?>
            <div class="alert alert-primary">ログアウトしました</div>
            <?php endif; ?>
        </div>
    </div>
    
    <main>
        <div class="container main-con">
        
            <div class="main-sections">
                <form action="{{ route('cooklogin') }}" name="cooksearch" method='post'>
                    @csrf
                    <input type="text" placeholder="ログインID" class="form-control" name="login"> 
                    <button type="submit" class="btn btn-primary">ログイン</button>
                </form>
                <form action="{{ route('cooklogin') }}" name="cooksearch" method='post'>
                    @csrf
                    <input type="text" placeholder="ログインID" class="form-control" name="add_id"> 
                    <button type="submit" class="btn btn-primary">新規ID追加</button>
                </form>
            </div>
            <div class="sidebar">
                <h3>これはサイドバーです</h3>
            </div>
        </div>
    </main>

    <footer>
        <div class="container">
            <h1>これはフッターである。</h1>
            <h2><a href="{{ route('cookregister') }}">料理の新規追加</a></h2>
            <h2><a href="#">ログイン</a></h2>
        </div>
    </footer>
    

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>
</html>