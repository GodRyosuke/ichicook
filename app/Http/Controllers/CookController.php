<?php

namespace App\Http\Controllers;

use App\Models\Cook;
use App\Models\Category;
use App\Models\CookAuth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use \Symfony\Component\HttpFoundation\StreamedResponse;
use Log;

class CookController extends Controller
{
    public $max_material_num = 8; // 材料の登録個数
    public $max_howtomake_num = 8; // 作り方の最大登録数
    public $max_nutrition_num = 8; // 栄養素の最大登録数

    public function register(Request $request)
    {
        $Category = Category::select('category')->get(); // Category databaseのcategoryカラムのみを抽出
        
        $max_material = $this->max_material_num; // 材料の登録個数
        $max_howtomake = $this->max_howtomake_num; // 作り方の最大登録数
        $max_nutrition = $this->max_nutrition_num; // 栄養素の最大登録数
        //
        // カテゴリ登録処理
        //
        $cat_data = $request->cat_data;
        if (isset($cat_data)) { // Categoryを登録するとき
            // 同じ名前のカテゴリが既に登録されているかチェック
            $exists = DB::table('categories')->where('category', $cat_data)->exists();
            $added_cat_error = true;
            if ($exists) {
                return view('cook.register', compact('added_cat_error', 'Category', 'max_material', 'max_howtomake', 'max_nutrition'));
            }
            Category::create([
                'category' => $cat_data,
            ]);
            $added_category = true;
            return view('cook.register', compact('added_category', 'Category', 'max_material', 'max_howtomake', 'max_nutrition'));
        }
        

        //
        // レシピ登録処理
        //
        $add_recipe_error = array();
        $title = $request->title;
        if (!isset($title)) {
            $add_recipe_error['title'] = true;
        }
        // レシピ画像登録処理
        $image = $request->file('image');
        $picture_path = NULL;
        $picture_name = NULL;
        if ($image) { // 画像の名前、ファイルパスの登録処理
            $picture_path = $image->store('uploads', 'public');
            if ($picture_path) {
                $picture_name = $image->getClientOriginalName();
            }
        }
        if (!$picture_name || !$picture_path) {
            $add_recipe_error['image'] = true;
        }
        $excerpt = $request->excerpt;
        if (!isset($excerpt)) {
            $add_recipe_error['excerpt'] = true;
        }
        $num_people = $request->num_people;
        $time = $request->time;
        if (!isset($time)) {
            $add_recipe_error['time'] = true;
        }

        // 材料データの抽出
        $materials = "";
        $material_error = true;
        for ($i = 1; $i <= $max_material; $i++) {
            $materialname = "material".$i;
            $num_material_name = "num_material".$i;
            $material_data = $request->input($materialname);
            $num_material_data = $request->input($num_material_name);
            // 材料が登録送信されていれば、取り出す
            if (isset($material_data) && isset($num_material_data)) {
                $temp_material = $material_data."ddd".$num_material_data."ttt";
                $materials = $materials.$temp_material;
                $material_error = false;
            } 
        }
        if ($material_error) {
            $add_recipe_error['material'] = true;
        }
         // 作り方の抽出
        $howtomakes = "";
        $howtomake_error = true;
        for ($i = 1; $i <= $max_howtomake; $i++) {
            $htmk_name = "howtomake".$i;
            $htmk_data = $request->input($htmk_name);
            if (isset($htmk_data)) {
                $howtomakes = $howtomakes.$htmk_data."ttt";
                $howtomake_error = false;
            }
        }
        if ($howtomake_error) {
            $add_recipe_error['howtomake'] = true;
        }
        // 栄養素の抽出
        $nutritions = "";
        $nutrition_error = true;
        for ($i = 1; $i <= $max_nutrition; $i++) {
            $nutrition_name = "nutrition".$i;
            $num_nutrition_name = "num_nutrition".$i;
            $nutrition_data = $request->input($nutrition_name);
            $num_nutrition_data = $request->input($num_nutrition_name);
            if (isset($nutrition_data) && isset($num_nutrition_data)) {
                $nutritions = $nutritions.$nutrition_data."ddd".$num_nutrition_data."ttt";
                $nutrition_error = false;
            }
        }
        if ($nutrition_error) {
            $add_recipe_error['nutrition'] = true;
        }
        
        $point = $request->point;
        if (!isset($point)) {
            $add_recipe_error['point'] = true;
        }
        // 名前と一致するカテゴリのidを取り出す
        $category = $request->category;
        if (!isset($category)) {
            $add_recipe_error['category'] = true;
        }
        $cat_id = NULL;
        $this_category = DB::table('categories')->whereRaw('category=?', [$category])->first();
        if (isset($this_category)) {
            $cat_id = $this_category->id;
        }

        $created_by = $request->created_by;
        if (!isset($created_by)) {
            $add_recipe_error['created_by'] = true;
        }

        //
        // データベースに登録する
        //
        if (count($add_recipe_error) == 0) {
            // データベースに登録する処理
            Cook::create([
                'title' => $title,
                'picture_name' => $picture_name,
                'picture_path' => $picture_path,
                'excerpt' => $excerpt,
                'num_people' => $num_people,
                'created_by' => $created_by,
                'cook_time' => $time,
                'materials' => $materials,
                'howtomake' => $howtomakes,
                'nutritions' => $nutritions,
                'point' => $point,
                'cat_ids' => $cat_id
            ]);
            $added_recipe = true;

            return view('cook.register', compact('Category', 'max_material', 'max_howtomake', 'max_nutrition', 'added_recipe'));
        } else {
            return view('cook.register', compact('Category', 'max_material', 'max_howtomake', 'max_nutrition', 'add_recipe_error'));
        }
        
        
        return view('cook.register', compact('Category', 'max_material', 'max_howtomake', 'max_nutrition'));
    }

    public function registerview(Request $request) 
    {
        $max_material = $this->max_material_num; // 材料の登録個数
        $max_howtomake = $this->max_howtomake_num; // 作り方の最大登録数
        $max_nutrition = $this->max_nutrition_num; // 栄養素の最大登録数

        $Category = Category::select('category')->get(); // Category databaseのcategoryカラムのみを抽出

        if ($request->session()->has('is_login')) {
            return view('cook.register', compact('Category', 'max_material', 'max_howtomake', 'max_nutrition'));
        }
        return redirect('/');
    }

    public function welcomeview(Request $request)
    {
        $Cook = Cook::all();
        $recentCooks = DB::table('cook')->orderByRaw('created_at DESC')->get();
        $Category = Category::all();
        // 今は適当にid４のレシピを表示
        $recommendRecipe = DB::table('cook')->where('id', 4)->first();
        return view('cook.welcome', compact('recommendRecipe', 'recentCooks', 'Category'));
    }

    // データベースのフォーマットにしたがってデータを取り出す処理
    // @param formattype 1: 材料、栄養
    // @param formattype 2: 作り方
    private function readcooktextdata($inputdata, &$outputdata, $formattype = 1)
    {
        if ($formattype == 1) { // 材料や栄養の場合
            $startidx = 0;
            $goalidx = 0;
            $material = NULL;
            $num_material = NULL;
            for ($i = 0; $i < strlen($inputdata); $i++) {
                if ($i < strlen($inputdata) - 3) {
                    $data1 = $inputdata[$i + 1];
                    $data2 = $inputdata[$i + 2];
                    $data3 = $inputdata[$i + 3];
                    if (($data1 == 'd') && ($data2 == 'd') && ($data3 == 'd')) {
                        $goalidx = $i;
                        $material = substr($inputdata, $startidx, $goalidx - $startidx + 1);
                        $startidx = $goalidx + 4;
                    }
                    if (($data1 == 't') && ($data2 == 't') && ($data3 == 't')) {
                        $goalidx = $i;
                        $num_material = substr($inputdata, $startidx, $goalidx - $startidx + 1);
                        $startidx = $goalidx + 4;
                        if ($material && $num_material) {
                            $outputdata[$material] = $num_material;
                            $material = NULL;
                            $num_materials = NULL;
                        }
                    }
                }
            }

        } elseif($formattype == 2) { // 作り方の場合
            $startidx = 0;
            $goalidx = 0;
            $num_material = NULL;
            for ($i = 0; $i < strlen($inputdata); $i++) {
                if ($i < strlen($inputdata) - 3) {
                    $data1 = $inputdata[$i + 1];
                    $data2 = $inputdata[$i + 2];
                    $data3 = $inputdata[$i + 3];
                    if (($data1 == 't') && ($data2 == 't') && ($data3 == 't')) {
                        $goalidx = $i;
                        $num_material = substr($inputdata, $startidx, $goalidx - $startidx + 1);
                        $startidx = $goalidx + 4;
                        if ($num_material) {
                            array_push($outputdata, $num_material);
                            $num_material = NULL;
                        }
                    }
                }
            }
        }
    }

    // データベースのフォーマットを配列に格納して使いやすく変換
    private function getRecipedataFromDBformat($recipedata, &$output)
    {
        // タイトル
        $output['title'] = $recipedata->title;
        // id
        $output['id'] = $recipedata->id;
        // 材料
        $materials = array();
        $material_data = $recipedata->materials;
        // 材料のデータフォーマットにしたがって、データを取り出す
        $this->readcooktextdata($material_data, $materials);
        $output['materials'] = $materials;
        // 栄養
        $nutritions = array();
        $nutritions_data = $recipedata->nutritions;
        $this->readcooktextdata($nutritions_data, $nutritions);
        $output['nutritions'] = $nutritions;
        // カテゴリ
        $cat_id = $recipedata->cat_ids;
        $thiscat = DB::table('categories')->where('id', $cat_id)->first();
        $output['category'] = $thiscat->category;
        // 調理時間
        $output['cooktime'] = $recipedata->cook_time;
        // 人数
        $output['num_people'] = $recipedata->num_people;
        // 製作者
        $output['created_by'] = $recipedata->created_by;
        // 写真ファイルパス
        $output['picture_path'] = $recipedata->picture_path;
        // 作り方
        $htmk_data = array();
        $this->readcooktextdata($recipedata->howtomake, $htmk_data, 2);
        $output['howtomake'] = $htmk_data;
        // 作るポイント
        $output['point'] = $recipedata->point;
        // 抜粋分
        $output['excerpt'] = $recipedata->excerpt;
        // 更新日
        $updated_date = array();
        $updated_at = $recipedata->updated_at;
        $year = substr($updated_at, 0, 4);
        $month = substr($updated_at, 5, 2);
        $month = ($month[0] == '0') ? $month[1] : $month; // 05月ー＞5月
        $date = substr($updated_at, 8, 2);
        $date = ($date[0] == '0') ? $date[1] : $date;
        $updated_date['year'] = $year;
        $updated_date['month'] = $month;
        $updated_date['date'] = $date;
        $output['updated_at'] = $updated_date;
    }
    
    public function detailview(Request $request)
    {
        $recipeID = $request->recipeID;
        $recipedata = DB::table('cook')->where('id', $recipeID)->first();
        $thisRecipe = array();
        // $thisRecipeにデータを入れる
        $this->getRecipedataFromDBformat($recipedata, $thisRecipe);

        return view('cook.detail', compact('thisRecipe'));
    }

    private function splitBySpace($inputstr, &$outputstr)
    {
        $keywords = array();
        $firstidx = 0;
        $goalidx = 0;
        // 半角スペースごとにキーワードを区切る
        for ($i = 0; $i < strlen($inputstr); $i++) {
            if ($inputstr[$i] == ' ' || $i == (strlen($inputstr) - 1)) {
                if ($i == (strlen($inputstr) - 1)) {
                    $i++;
                }
                $goalidx = $i;
                $keyword = substr($inputstr, $firstidx, $goalidx - $firstidx);
                array_push($keywords, $keyword);
                $firstidx = $goalidx + 1;
            }
        }
        // 全角スペースごとにキーワードを区切る
        $temparray = array();
        foreach($keywords as $keyword) {
            $splitted = explode('　', $keyword);
            if (count($splitted) == 1) { // 分割されなければそのまま追加
                array_push($temparray, $keyword);
            } else {
                $temparray = $temparray + $splitted;
            }
        } 
        $keywords = $temparray;
        $outputstr = $keywords;
    }

    public function cooksearch(Request $request)
    {
        // カテゴリ検索の場合
        if (isset($request->catname)) {
            $catname = $request->catname;
            $category = DB::table('categories')->where('category', $catname)->first();
            $cat_id = $category->id;
            // そのカテゴリが含まれるレシピを検索
            $catResults = DB::table('cook')->where('cat_ids', $cat_id)->get();
            return view('cook.searchresult', compact('catResults', 'catname'));
        }

        //
        // 用語検索の場合
        //
        $keywords = array();
        $this->splitBySpace($request->search, $keywords);
        $searchResult = array();

        $query = "";
        $firstflg = true;
        foreach ($keywords as $keyword) {
            $tempquery = "(title like '%".$keyword."%' or materials like '%".$keyword."%' or nutritions like '%".$keyword."%' or howtomake like '%".$keyword."%' or excerpt like '%".$keyword."%')";
            if ($firstflg) {
                $query = $tempquery;
                $firstflg = false;
                continue;
            }
            $query = $query."and ".$tempquery;
        }
        $tempresult = DB::table('cook')->whereRaw($query)->get();
        array_push($searchResult, $tempresult);

        return view('cook.searchresult', compact('keywords', 'searchResult'));
    }

    public function showcookupdate(Request $request)
    {
        $max_material = $this->max_material_num; // 材料の登録個数
        $max_howtomake = $this->max_howtomake_num; // 作り方の最大登録数
        $max_nutrition = $this->max_nutrition_num; // 栄養素の最大登録数

        $Category = Category::select('category')->get(); // Category databaseのcategoryカラムのみを抽出

        $recipeid = $request->id;
        $recipedata = DB::table('cook')->where('id', $recipeid)->first();
        $thisRecipe = array();
        $this->getRecipedataFromDBformat($recipedata, $thisRecipe);

        if ($request->session()->has('is_login')) {
            return view('cook.update', compact('Category', 'max_material', 'max_howtomake', 'max_nutrition', 'thisRecipe'));
        }
        return redirect('/');
    }

    public function updaterecipe(Request $request)
    {
        $max_material = $this->max_material_num; // 材料の登録個数
        $max_howtomake = $this->max_howtomake_num; // 作り方の最大登録数
        $max_nutrition = $this->max_nutrition_num; // 栄養素の最大登録数

        $Category = Category::select('category')->get(); // Category databaseのcategoryカラムのみを抽出

        // $thisRecipeData = DB::table('cook')->where('id', $request->id)->first();
        $thisRecipeData = Cook::where('id', $request->id)->first();
        //
        // レシピ更新処理
        //
        $update_recipe_error = array();
        $title = $request->title;
        if (!isset($title)) {
            $update_recipe_error['title'] = true;
        }
        // レシピ画像登録処理
        $image = $request->file('image');
        $picture_path = $thisRecipeData->picture_path;
        $picture_name = $thisRecipeData->picture_name;
        if ($image) { // 画像の名前、ファイルパスの登録処理
            $picture_path = $image->store('uploads', 'public');
            if ($picture_path) {
                $picture_name = $image->getClientOriginalName();
            }
        }
        $excerpt = $request->excerpt;
        if (!isset($excerpt)) {
            $update_recipe_error['excerpt'] = true;
        }
        $num_people = $request->num_people;
        $time = $request->time;
        if (!isset($time)) {
            $update_recipe_error['time'] = true;
        }

        // 材料データの抽出
        $materials = "";
        $material_error = true;
        for ($i = 1; $i <= $max_material; $i++) {
            $materialname = "material".$i;
            $num_material_name = "num_material".$i;
            $material_data = $request->input($materialname);
            $num_material_data = $request->input($num_material_name);
            // 材料が登録送信されていれば、取り出す
            if (isset($material_data) && isset($num_material_data)) {
                $temp_material = $material_data."ddd".$num_material_data."ttt";
                $materials = $materials.$temp_material;
                $material_error = false;
            } 
        }
        if ($material_error) {
            $update_recipe_error['material'] = true;
        }
         // 作り方の抽出
        $howtomakes = "";
        $howtomake_error = true;
        for ($i = 1; $i <= $max_howtomake; $i++) {
            $htmk_name = "howtomake".$i;
            $htmk_data = $request->input($htmk_name);
            if (isset($htmk_data)) {
                $howtomakes = $howtomakes.$htmk_data."ttt";
                $howtomake_error = false;
            }
        }
        if ($howtomake_error) {
            $update_recipe_error['howtomake'] = true;
        }
        // 栄養素の抽出
        $nutritions = "";
        $nutrition_error = true;
        for ($i = 1; $i <= $max_nutrition; $i++) {
            $nutrition_name = "nutrition".$i;
            $num_nutrition_name = "num_nutrition".$i;
            $nutrition_data = $request->input($nutrition_name);
            $num_nutrition_data = $request->input($num_nutrition_name);
            if (isset($nutrition_data) && isset($num_nutrition_data)) {
                $nutritions = $nutritions.$nutrition_data."ddd".$num_nutrition_data."ttt";
                $nutrition_error = false;
            }
        }
        if ($nutrition_error) {
            $update_recipe_error['nutrition'] = true;
        }
        
        $point = $request->point;
        if (!isset($point)) {
            $update_recipe_error['point'] = true;
        }
        // 名前と一致するカテゴリのidを取り出す
        $category = $request->category;
        if (!isset($category)) {
            $update_recipe_error['category'] = true;
        }
        $cat_id = NULL;
        $this_category = DB::table('categories')->whereRaw('category=?', [$category])->first();
        if (isset($this_category)) {
            $cat_id = $this_category->id;
        }

        $created_by = $request->created_by;
        if (!isset($created_by)) {
            $update_recipe_error['created_by'] = true;
        }


      if (count($update_recipe_error) == 0) {
            // レシピ更新処理
            $thisRecipeData->title = $title;
            $thisRecipeData->picture_name = $picture_name;
            $thisRecipeData->picture_path = $picture_path;
            $thisRecipeData->excerpt = $excerpt;
            $thisRecipeData->num_people = $num_people;
            $thisRecipeData->created_by = $created_by;
            $thisRecipeData->cook_time = $time;
            $thisRecipeData->materials = $materials;
            $thisRecipeData->howtomake = $howtomakes;
            $thisRecipeData->nutritions = $nutritions;
            $thisRecipeData->point = $point;
            $thisRecipeData->cat_ids = $cat_id;

            $thisRecipeData->save();
            $updated_recipe = true;

            
            $recipeid = $request->id;
            $recipedata = DB::table('cook')->where('id', $recipeid)->first();
            $thisRecipe = array();
            $this->getRecipedataFromDBformat($recipedata, $thisRecipe);

            return view('cook.update', compact('Category', 'max_material', 'max_howtomake', 'max_nutrition', 'updated_recipe', 'thisRecipe'));
        } else {
            $thisRecipe = array();
            $this->getRecipedataFromDBformat($thisRecipeData, $thisRecipe);
            return view('cook.update', compact('Category', 'max_material', 'max_howtomake', 'max_nutrition', 'update_recipe_error', 'thisRecipe'));
        }
        
    }

    public function cooklogin(Request $request)
    {
        // ログインid追加
        if (isset($request->add_id)) {
            CookAuth::create([
                'user_id' => $request->add_id,
            ]);
            return view ('cook.login');
        }

        // ログイン処理
        if (isset($request->login)) {
            $authdata = DB::table('cookauth')->where('user_id', $request->login)->first();
            $is_login = false;
            if (isset($authdata)) {
                $request->session()->put('is_login', true);
                $is_login = true;
            } 
            return view ('cook.login', compact('is_login'));
        }
    }

    public function showcooklogin(Request $request)
    {
        // ログアウト処理
        if (isset($request->is_logout)) {
            if ($request->session()->has('is_login')) {
                $request->session()->forget('is_login');
            }
            $is_logout = true;
            return view('cook.login', compact('is_logout'));
        }

        return view('cook.login');
    }
    
    public function registerByCsv(Request $request)
    {

        
        return redirect('/');
    }

    public function downloadCsv(Request $request)
    {
        $cooks = Cook::all();
        $response = new StreamedResponse(function () use ($cooks) {
            $fp = fopen('php://output', 'w');
            $header = ['id', 'レシピ名', '材料', '栄養素', 'カテゴリ', '調理時間', '人数', 'レシピを考えた人', '作り方', '作るポイント', 'レシピの抜粋文'];
            stream_filter_prepend($fp, 'convert.iconv.utf-8/cp932');
            fputcsv($fp, $header);
            foreach($cooks as $cook) {
                $catname = DB::table('categories')->where('id', $cook->cat_ids)->first();
                $data = [$cook->id, $cook->title, $cook->materials, $cook->nutritions, $catname->category, $cook->cook_time,
                    $cook->num_people, $cook->created_by, $cook->howtomake, $cook->point, $cook->excerpt];
                fputcsv($fp, $data);
            }

            fclose($fp);
        },
        Response::HTTP_OK,
        [
            'Content-Type'  => 'text/csv',
            'Content-Disposition'   => 'attachment; filename="cook.csv"',
        ]);

        return $response;
    }
}
