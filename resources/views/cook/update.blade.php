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
    if (isset($thisRecipe)) {
        var_dump($thisRecipe);
    }
    ?>
    <?php
    if (isset($cat_data)) {
        var_dump($cat_data);
    }
    if (isset($title)) {
        var_dump($title);
    }
    ?>
    <?php
        if (isset($materials)) {
            var_dump($materials);
        }
        if (isset($howtomakes)) {
            var_dump($howtomakes);
        }
        if (isset($nutritions)) {
            var_dump($nutritions);
        }
        if (isset($inputdata)) {
            var_dump($inputdata);
        }
    ?>
    
    <main class="container">
    <?php
    if (isset($added_category)):
    ?>
    <div class=" alert alert-primary">カテゴリを追加しました</div>
    <?php
    endif;
    ?>
    <?php if(isset($added_cat_error)): ?>
        <div class="alert alert-danger">この名前のカテゴリはすでに登録されています</div>
    <?php endif; ?>
    <?php if (isset($added_recipe)): ?>
    <div class="alert alert-primary">レシピを追加しました</div>
    <?php endif; ?>
    <?php
    if (isset($add_recipe_error)):
    ?>
    <div class=" alert alert-danger">登録情報に誤りがあります</div>
    <?php
    var_dump($add_recipe_error);
    echo count($add_recipe_error);
    endif;
    ?>
        <div class="main-con">
            <div class="main-sections">
                <div class="cook-register">
                    <h2>レシピ登録画面</h2>
                    <form method="post" enctype="multipart/form-data" action="{{ route('cookpost') }}">
                    @csrf
                        <button class="btn btn-primary" type="submit">登録する</button>
                        <div class="title">
                            <h3>レシピタイトル</h3>
                            <input type="text" name="title" value="<?php echo $thisRecipe['title']; ?>">
                        </div>
                        <div class="image">
                            <h3>写真を登録</h3>
                            <input type="file" name="image" accept="image/png, image/jpeg">
                        </div>
                        <div class="excerpt">
                            <h3>抜粋文</h3>
                            <textarea name="excerpt" id="" cols="30" rows="10"><?php echo $thisRecipe['excerpt']; ?></textarea>
                        </div>
                        <div class="num_people">
                            <h3>人数</h3>
                            <select name="num_people" id="">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                                <option value="21">21</option>
                                <option value="22">22</option>
                                <option value="23">23</option>
                                <option value="24">24</option>
                                <option value="25">25</option>
                                <option value="26">26</option>
                                <option value="27">27</option>
                                <option value="28">28</option>
                                <option value="29">29</option>
                                <option value="30">30</option>
                            </select>
                        </div>
                        <div class="time">
                            <h3>所要時間</h3>
                            <input type="text" name="time" value="<?php echo $thisRecipe['cooktime']; ?>">
                        </div>
                        <div class="material">
                            <h3>材料</h3>
                            <ol>
                                <?php
                                $materials = $thisRecipe['materials'];
                                $i = 1;
                                foreach($materials as $mat => $mat_num):
                                ?>
                                <li><input type="text" name="material<?php echo $i; ?>" value="<?php echo $mat; ?>"><input type="text" name="num_material<?php echo $i; ?>" value="<?php echo $mat_num; ?>"></li>
                                <?php $i++; ?>
                                <?php endforeach; ?>
                                <?php
                                if ($i <= $max_material):
                                    for (; $i <= $max_material; $i++): 
                                ?>
                                <li><input type="text" name="material<?php echo $i; ?>"><input type="text" name="num_material<?php echo $i; ?>"></li>
                                    <?php endfor; ?>
                                <?php endif; ?>
                            </ol>
                        </div>
                        <div class="howtomake">
                            <h3>作り方</h3>
                            <ol>
                                <?php for($i = 1; $i <= $max_howtomake; $i++): ?>
                                <li><input type="text" name="howtomake<?php echo $i; ?>"></li>
                                <?php endfor; ?>
                            </ol>
                        </div>
                        <div class="point">
                            <h3>作る際のポイント</h3>
                            <textarea id="" cols="30" rows="10" name="point"></textarea>
                        </div>
                        <div class="nutrition">
                            <h3>栄養素</h3>
                            <ul>
                            <?php for ($i = 1; $i <= $max_nutrition; $i++): ?>
                                <li><input type="text" name="nutrition<?php echo $i; ?>"><input type="text" name="num_nutrition<?php echo $i; ?>"></li>
                            <?php endfor; ?>
                            </ul>
                        </div>
                        <div class="cat">
                            <h3>カテゴリ</h3>
                            <select name="category" id="">
                            <?php foreach($Category as $cat): ?>
                                <option value="<?php echo $cat->category; ?>"><?php echo $cat->category; ?></option>
                            <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="created_by">
                            <h3>このレシピを作った人の名前</h3>
                            <input type="text" name="created_by">
                        </div>

                        <button class="btn btn-primary" type="submit">登録する</button>
                    </form>
                    <h2>カテゴリを新規追加する</h2>
                    <form action="{{ route('cookpost') }}" name="registercat" method="post">
                    @csrf
                        <input type="text" name="cat_data">
                        <button method="post">追加</button>
                    </form>
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