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
            <form action="post" method="post">
                <input type="text" placeholder="春のレシピ" class="form-control"> 
                <button type="submit" class="btn btn-primary">検索</button>
            </form>
        </div>
    </div>
    <main>
        <div class="container main-con">
            <div class="main-sections">
                <div class="detail">
                    <div class="main-image">
                        <?php
                        $picture_path = $thisRecipe['picture_path']; ?>
                        <img src="{{ Storage::url($picture_path) }}" alt="">
                    </div>
                    <div class="rows">
                        <div class="recipe-title">
                            <h2><?php echo $thisRecipe['title']; ?></h2>
                            <?php $urlstr = 'cooksearch?catname='.$thisRecipe['category']; ?>
                            カテゴリ：<a href="<?php echo url($urlstr); ?>"><?php echo $thisRecipe['category']; ?></a>
                        </div>
                        <div class="excerpt">
                            <?php echo $thisRecipe['excerpt']; ?>
                        </div>
                        <div class="num-people">
                            <div class="title">
                                <h3>人数</h3>
                            </div>
                            <div class="desc">
                                <?php echo $thisRecipe['num_people'].'人'; ?>
                            </div>
                        </div>
                        <div class="nutrition-wrap">
                            <div class="title">
                                <h3>栄養成分</h3>
                            </div>
                            <div class="nutritions">
                                <ul class="nutrition">
                                    <?php
                                    $nutritions = $thisRecipe['nutritions'];
                                    foreach($nutritions as $ei => $num_ei):
                                    ?>
                                    <li><?php echo $ei; ?></li>
                                    <?php endforeach; ?>
                                </ul>
                                <ul class="num_nutrition">
                                    <?php
                                    $nutritions = $thisRecipe['nutritions'];
                                    foreach($nutritions as $ei => $num_ei):
                                    ?>
                                    <li><?php echo $num_ei; ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                        <div class="material-wrap">
                            <div class="title">
                                <h3>材料</h3>
                            </div>
                            <div class="materials">
                                <ul class="material">
                                <?php 
                                $materials = $thisRecipe['materials'];
                                foreach($materials as $mat => $mat_num):
                                ?>
                                <li><?php echo $mat; ?></li>
                                <?php endforeach; ?>
                                </ul>
                                <ul class="material_num">
                                <?php 
                                $materials = $thisRecipe['materials'];
                                foreach($materials as $mat => $mat_num):
                                ?>
                                <li><?php echo $mat_num; ?></li>
                                <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                        <div class="howtomake">
                            <div class="title">
                                <h3>作り方</h3>
                            </div>
                            <ol class="htmk-inner-container">
                                <?php
                                $htmks = $thisRecipe['howtomake'];
                                foreach($htmks as $htmk):
                                ?>
                                <li><?php echo $htmk ?></li>
                                <?php endforeach; ?>
                            </ol>
                        </div>
                        <div class="point">
                            <div class="title">
                                <h3>作るポイント</h3>
                            </div>
                            <div class="desc">
                                <?php echo $thisRecipe['point']; ?>
                            </div>
                        </div>
                        <div class="updated_at">
                            <?php
                            $updated_data = $thisRecipe['updated_at'];
                            ?>
                            最終更新日：
                            <?php echo $updated_data['year']; ?>年
                            <?php echo $updated_data['month']; ?>月
                            <?php echo $updated_data['date']; ?>日
                        </div>
                    </div>
                    <?php $urlstr = "/cookupdate?id=".$thisRecipe['id']; ?>
                    <a href="<?php echo url($urlstr); ?>">この記事を更新する</a>
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