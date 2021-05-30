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
            <form action="post">
                <input type="text" placeholder="春のレシピ" class="form-control"> 
                <button type="submit" class="btn btn-primary">検索</button>
            </form>
        </div>
    </div>
    <?php
    if (isset($keywords)) {
        var_dump($keywords);
    }
    if (isset($query)) {
        var_dump($query);
    }
    ?>
    <main>
        <div class="container main-con">
            <div class="main-sections">
                <div class="searchresult">
                    <div class="title">
                    <?php if (isset($catname)): // カテゴリの検索なら ?>
                        <h1>「<?php echo $catname; ?>」のカテゴリを含むレシピ一覧</h1>
                    <?php else: // 検索バーの検索なら?>
                        <h1>検索結果</h1>
                    <?php endif; ?>
                    </div>
                    <?php // カテゴリの検索なら
                    if (isset($catname) && (count($catResults) == 0)): ?>
                    このカテゴリのレシピはまだありません
                    <?php endif; ?>
                    <div class="cards">
                    <?php
                    if (isset($catname)):
                        foreach($catResults as $result):
                    ?>
                    <?php $urlstr = "cookdetail?recipeID=".$result->id; ?>
                        <a href="<?php echo url($urlstr); ?>">
                            <div class="card">
                                <img src="{{ Storage::url($result->picture_path) }}" alt="">
                                <div class="title"><?php echo $result->title; ?></div>
                            </div>
                        </a>
                    <?php
                            endforeach; 
                        endif; 
                    ?>

                    <?php // 検索バーでの検索
                    if (isset($searchResult)): 
                        foreach($searchResult as $results):
                            foreach($results as $result):
                    ?>
                    <?php
                    $urlstr = "cookdetail?recipeID=".$result->id;
                    ?>
                    <a href="<?php echo url($urlstr); ?>?">
                        <div class="card">
                            <img src="{{ Storage::url($result->picture_path) }}" alt="">
                            <div class="title"><?php echo $result->title; ?></div>
                        </div>
                    </a>
                    <?php
                            endforeach;
                        endforeach;
                    endif;
                    ?>

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
            <h1>フッター</h1>
        </div>
    </footer>
    

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>
</html>