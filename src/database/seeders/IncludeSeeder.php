<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class IncludeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seedDatas = [
            [
                'name' => 'ウィスキー',
                'strange' => 40,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
            [
                'name' => '梅酒',
                'strange' => 15,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
            [
                'name' => 'ビール',
                'strange' => 5,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
            [
                'name' => 'ワイン',
                'strange' => 15,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ]
        ];
    
        foreach ($seedDatas as $data) {
            DB::table('includes')->insert($data);
        }
    }
}
