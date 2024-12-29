<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
// use DateTime;

class IncludeRecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seedDatas = [
            [
                'include_id' => 1,
                'recipe_id' => 1
            ],
            [
                'include_id' => 1,
                'recipe_id' => 2
            ],
            [
                'include_id' => 1,
                'recipe_id' => 3
            ],
            [
                'include_id' => 2,
                'recipe_id' => 4
            ],
            [
                'include_id' => 2,
                'recipe_id' => 5
            ],
            [
                'include_id' => 1,
                'recipe_id' => 6
            ],
            [
                'include_id' => 3,
                'recipe_id' => 6
            ],
        ];
    
    foreach ($seedDatas as $data) {
        DB::table('include_recipe')->insert($data);
    }
    }
}
