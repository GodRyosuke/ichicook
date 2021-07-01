@include('partials.header')
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
    <?php if(isset($added_cat_error)): ?>
        <div class="alert alert-danger">この名前のカテゴリはすでに登録されています</div>
    <?php endif; ?>
    <?php if (isset($updated_recipe)): ?>
    <div class="alert alert-primary">レシピを更新しました</div>
    <?php endif; ?>
    <?php
    if (isset($update_recipe_error)):
    ?>
    <div class=" alert alert-danger">更新情報に誤りがあります</div>
    <?php
    var_dump($update_recipe_error);
    echo count($update_recipe_error);
    endif;
    ?>
        <div class="main-con">
            <div class="main-sections">
                <div class="cook-register">
                    <h2>レシピ更新画面</h2>
                    <form method="post" enctype="multipart/form-data" action="{{ route('updaterecipe') }}">
                    @csrf
                        <button class="btn btn-primary" type="submit">更新する</button>
                        <div class="title">
                            <h3>レシピタイトル</h3>
                            <input type="text" name="title" value="<?php echo $thisRecipe['title']; ?>">
                        </div>
                        <div class="image">
                            <h3>現在の写真</h3>
                            <img src="{{ Storage::url($thisRecipe['picture_path']) }}" alt="">
                            <h3>写真を更新</h3>
                            <input type="file" name="image" accept="image/png, image/jpeg">
                        </div>
                        <div class="excerpt">
                            <h3>抜粋文</h3>
                            <textarea name="excerpt" id="" cols="30" rows="10"><?php echo $thisRecipe['excerpt']; ?></textarea>
                        </div>
                        <div class="num_people">
                            <h3>人数</h3>
                            <select name="num_people" id="">
                            <?php for ($i = 0; $i <= 30; $i++): ?>
                                <option value="<?php echo $i; ?>" <?php
                                if ($i == $thisRecipe['num_people']){
                                    echo 'selected';
                                } ?>><?php echo $i; ?></option>
                            <?php endfor; ?>
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
                                <?php
                                $howtomakes = $thisRecipe['howtomake'];
                                $array_size = count($howtomakes);
                                ?>
                                <?php for($i = 1; $i <= $max_howtomake; $i++): ?>
                                    <?php if ($i - 1 < $array_size): ?>
                                <li><input type="text" name="howtomake<?php echo $i; ?>" value="<?php echo $howtomakes[$i - 1]; ?>"></li>
                                   <?php else: ?>
                                <li><input type="text" name="howtomake<?php echo $i; ?>"></li>
                                    <?php endif; ?>
                                <?php endfor; ?>
                            </ol>
                        </div>
                        <div class="point">
                            <h3>作る際のポイント</h3>
                            <textarea id="" cols="30" rows="10" name="point"><?php echo $thisRecipe['point']; ?></textarea>
                        </div>
                        <div class="nutrition">
                            <h3>栄養素</h3>
                            <ul>
                            <?php
                            $nutritions = $thisRecipe['nutritions'];
                            $i = 1;
                            foreach($nutritions as $nutrition => $num_nutrition):
                            ?>
                            <li><input type="text" name="nutrition<?php echo $i; ?>" value="<?php echo $nutrition; ?>"><input type="text" name="num_nutrition<?php echo $i; ?>" value="<?php echo $num_nutrition; ?>"></li>
                            <?php 
                            $i++;
                            endforeach; ?>
                            <?php for (; $i <= $max_nutrition; $i++): ?>
                            <li><input type="text" name="nutrition<?php echo $i; ?>"><input type="text" name="num_nutrition<?php echo $i; ?>"></li>
                            <?php endfor; ?>
                            </ul>
                        </div>
                        <div class="cat">
                            <h3>カテゴリ</h3>
                            <select name="category" id="">
                            <?php foreach($Category as $cat): ?>
                                <option value="<?php echo $cat->category; ?>"<?php
                                if ($cat->category == $thisRecipe['category']) {
                                    echo "selected";
                                } ?>><?php echo $cat->category; ?></option>
                            <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="created_by">
                            <h3>このレシピを作った人の名前</h3>
                            <input type="text" name="created_by" value="<?php echo $thisRecipe['created_by']; ?>">
                        </div>
                        <div style="display: none">
                            <input type="text" name="id" value="<?php echo $thisRecipe['id']; ?>">
                        </div>

                        <button class="btn btn-primary" type="submit">更新する</button>
                    </form>
                </div>
            </div>
            <div class="sidebar">
                <h3>これはサイドバーです</h3>
            </div>
        </div>
    </main>

@include('partials.footer')