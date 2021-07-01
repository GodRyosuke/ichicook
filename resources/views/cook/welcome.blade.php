@include('partials.header')
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
@include ('partials.footer')

  