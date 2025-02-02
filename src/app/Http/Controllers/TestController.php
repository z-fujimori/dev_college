<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\IncludeAlchole;
use App\Models\User;

class TestController extends Controller
{
    //
    public function index(IncludeAlchole $include) {
        // includeを取得。一緒にレシピのstrangeも紐付ける。
        $datas = $include->with([
            'recipes' => function ($query) {
                $query->select('recipes.strange');
            }
        ])->get();

        // データ整形。max_strange、min_strangeという項目を追加する。
        $return_datas = $datas->map(function ($incl) {
            // `recipes` の中から最大値と最小値を計算
            $incl->max_strange = $incl->recipes->max('strange');
            $incl->min_strange = $incl->recipes->min('strange');
            return $incl;
        });

        // SQlで書くとこう
        // SELECT
        //     ir.include_id,
        //     MAX(r.strange) AS max_strange,
        //     MIN(r.strange) AS min_strange
        // FROM
        //     include_recipe AS ir
        // JOIN
        //     recipes AS r ON ir.recipe_id = r.id
        // GROUP BY
        //     ir.include_id;

        dd($datas);
        // dump($datas[0]->recipes);
        // dd(max($datas[0]->recipes->strange));
    }

    public function sort_test($user){
        $p = User::find($user)->posts()->orderBy('created_at','DESC')->get();
        // $posts = $user->with('posts')->get();
        dd($p);
    }
}

