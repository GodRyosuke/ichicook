@include('partials.header')
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

@include('partials.footer')