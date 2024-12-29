<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class RecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seedDatas = [
            [
                'name' => 'ハイボール(濃いめ)',
                'strange' => 10,
                'process' => 'ぱっ/ぴっ/ぷっ',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
            [
                'name' => 'ハイボール(普通)',
                'strange' => 8,
                'process' => 'ぱっ/ぴっ/ぷっ',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
            [
                'name' => 'ハイボール(薄め)',
                'strange' => 6,
                'process' => 'ぱっ/ぴっ/ぷっ',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
            [
                'name' => '梅酒(ロック)',
                'strange' => 10,
                'process' => 'ぱっ/ぴっ/ぷっ',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
            [
                'name' => '梅酒(ソーダ)',
                'strange' => 5,
                'process' => 'ぱっ/ぴっ/ぷっ',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
            [
                'name' => 'ボイラー・メーカー',
                'strange' => 20,
                'process' => 'ぱっ/ぴっ/ぷっ',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
        ];
    
    foreach ($seedDatas as $data) {
        DB::table('recipes')->insert($data);
    }
    }
}
