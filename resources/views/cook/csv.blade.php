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
                　  <h3>手順</h3>
                    <ol>
                        <li><a href="{{ route('downloadCsv') }}">こちら</a>からcsvファイルをダウンロードしてください。</li>
                        <li>ダウンロードしたcsvファイルに必要なデータを入力してください。</li>
                        <li>改変後のcsvファイルを以下のフォームからアップロードしてください。</li>
                        <li>正しくデータが入力されていれば、データベースにレシピが登録されます。</li>
                    </ol>
                    <h3>登録フォーム</h3>
                    <form action="{{ route('registerByCsv') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="uploadform">
                        <button type="submit" class="btn btn-primary">アップロード</button>
                    </form>
                    <h3>注意</h3>
                    <ul>
                        <li>μやβなどの特殊な文字は、全角で入力してください</li>
                        <li></li>
                        <li></li>
                    </ul>
                </div>
            </div>
            <div class="sidebar">
                <h3>これはサイドバーです</h3>
            </div>
        </div>
    </main>

@include('partials.footer')