<?php

namespace App\Http\Controllers;

use App\Models\Cook;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
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
        return view('cook.register', compact('Category', 'max_material', 'max_howtomake', 'max_nutrition'));
    }

    public function welcomeview(Request $request)
    {
        $Cook = Cook::all();
        $recentCooks = DB::table('cook')->orderByRaw('created_at DESC')->get();
        $Category = Category::all();
        return view('cook.welcome', compact('recentCooks', 'Category'));
    }

    public function detailview(Request $request)
    {
        $recipeID = $request->recipeID;
        $recipedata = DB::table('cook')->where('id', $recipeID)->first();
        $thisRecipe = array();
        $thisRecipe['title'] = $recipedata->title;

        $materials = array();
        $material_data = $recipedata->materials;
        // 材料のデータフォーマットにしたがって、データを取り出す
        {
            $startidx = 0;
            $goalidx = 0;
            $material = NULL;
            $num_material = NULL;
            Log::debug("--------------------------");
            for ($i = 0; $i < strlen($material_data); $i++) {
                if ($i < strlen($material_data) - 3) {
                    $data1 = $material_data[$i + 1];
                    $data2 = $material_data[$i + 2];
                    $data3 = $material_data[$i + 3];
                    
                    if (($data1 == 'd') && ($data2 == 'd') && ($data3 == 'd')) {
                        $goalidx = $i;
                        $material = substr($material_data, $startidx, $goalidx - $startidx + 1);
                        Log::debug("material:".$material);
                        $startidx = $goalidx + 4;
                    }
                    if (($data1 == 't') && ($data2 == 't') && ($data3 == 't')) {
                        $goalidx = $i;
                        $num_material = substr($material_data, $startidx, $goalidx - $startidx + 1);
                        $startidx = $goalidx + 4;
                        if ($material && $num_material) {
                            $materials[$material] = $num_material;
                            Log::debug("num_material: ".$num_material);
                            $material = NULL;
                            $num_materials = NULL;
                        }
                    }
                }
            }
        }
        return view('cook.detail', compact('thisRecipe', 'materials'));
    }
}
