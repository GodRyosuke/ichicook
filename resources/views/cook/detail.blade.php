@include('partials.header')
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
                        <div class="created_by">
                            <div class="title">
                                <h3>このレシピを作った人</h3>
                            </div>
                            <div class="desc">
                                <?php echo $thisRecipe['created_by']; ?>
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

@include('partials.footer')