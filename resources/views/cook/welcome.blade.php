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
            <form action="{{ route('ichicooksearch') }}" name="cooksearch" method='post'>
                @csrf
                <input type="text" placeholder="春のレシピ" class="form-control" name="search"> 
                <button type="submit" class="btn btn-primary">検索</button>
            </form>
        </div>
    </div>
    <div class="recommend">
        <div class="container">
            <div class="title">
                <h1>おすすめレシピ</h1>
            </div>
            <?php $urlstr = "/cookdetail?recipeID=".$recommendRecipe->id; ?>
            <a href="<?php echo url($urlstr); ?>">
                <div class="card">
                    <img src="{{ Storage::url($recommendRecipe->picture_path) }}" alt="">
                    <div class="title"><?php echo $recommendRecipe->title; ?></div>
                    <div class="desc"><?php echo $recommendRecipe->excerpt; ?></div>
                </div>
            </a>
        </div>
    </div>
    <main>
        <div class="container main-con">
            <div class="main-sections">
                <div class="news">
                    <div class="title">
                        <h1>新着レシピ</h1>
                    </div>
                    <div class="cards">
                    <?php
                    $count = 0;
                    foreach($recentCooks as $ck): 
                    ?>
                        <?php $urlstr = '/cookdetail?recipeID='.$ck->id; ?>
                        <a href="<?php echo url($urlstr); ?>">
                            <div class="card">
                                <img src="{{ Storage::url($ck->picture_path) }}" alt="">
                                <div class="title"><?php echo $ck->title; ?></div>
                            </div>
                        </a>
                    <?php
                    $count++;
                    if ($count == 3) {
                        break;
                    }
                    ?>
                    <?php endforeach; ?>
                    </div>
                    </div>
                    <div class="categories">
                        <div class="title">
                            <h1>カテゴリ一覧</h1>
                        </div>
                        <ul>
                        <?php
                        $count = 1;
                        foreach($Category as $cat): ?>
                        <?php $urlstr = 'cooksearch?catname='.$cat->category; ?>
                            <a href="<?php echo url($urlstr); ?>">
                                <li><?php echo $cat->category; ?></li>
                            </a>
                        <?php
                        if ($count == 8) {
                            //break;
                        }
                        $count++;
                        ?>
                        <?php endforeach; ?>
                        </ul>
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
            <h2><a href="{{ route('cookregister') }}">料理の新規追加</a></h2>
        </div>
    </footer>
    

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>
</html>