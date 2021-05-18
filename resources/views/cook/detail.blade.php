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
    if (isset($materials)) {
        var_dump($materials);
    }
    ?>
    <main>
        <div class="container main-con">
            <div class="main-sections">
                <div class="detail">
                    <div class="main-image">
                        <img src="{{ asset('img/test.jpg') }}" alt="">
                    </div>
                    <div class="rows">
                        <div class="row1">
                            <div class="material">
                                <div class="title">
                                    <h3>材料</h3>
                                </div>
                                <ul>
                                    <li>トマト</li>
                                    <li>トマト</li>
                                    <li>トマト</li>
                                    <li>トマト</li>
                                </ul>
                            </div>
                            <div class="point">
                                <div class="title">
                                    <h3>作るポイント</h3>
                                </div>
                                <div class="desc">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum et officiis exercitationem quibusdam, quod quos qui iure beatae facilis reprehenderit minus quae ipsa eaque placeat culpa sint provident aliquam voluptatem!
                                </div>
                            </div>
                        </div>
                        <div class="row2">
                            <div class="nutrition">
                                <div class="title"><h3>栄養</h3></div>
                                <ul>
                                    <li>タンパク質　200g</li>
                                    <li>タンパク質　200g</li>
                                    <li>タンパク質　200g</li>
                                    <li>タンパク質　200g</li>
                                    <li>タンパク質　200g</li>
                                </ul>
                            </div>
                            <div class="howtomake">
                                <div class="title">
                                    <h3>作り方</h3>
                                </div>
                                <ol>
                                    <li>キャベツをみじん切りにする</li>
                                    <li>キャベツをみじん切りにする</li>
                                    <li>キャベツをみじん切りにする</li>
                                    <li>キャベツをみじん切りにする</li>
                                    <li>キャベツをみじん切りにする</li>
                                </ol>
                            </div>
                        </div>
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