<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DateTime;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seedDatas = [
                [
                    'name' => 'test',
                    'email' => 'test@test',
                    'password' => Hash::make('testtest')
                ],
                [
                    'name' => 'test2',
                    'email' => 'test2@test',
                    'password' => Hash::make('testtest')
                ],
                [
                    'name' => 'テストユーザー',
                    'email' => 'testuser@test',
                    'password' => Hash::make('testtest')
                ],
                [
                    'name' => 'てす',
                    'email' => 'tes@test',
                    'password' => Hash::make('testtest')
                ]
            ];
        
        foreach ($seedDatas as $data) {
            DB::table('users')->insert($data);
        }
    }
}
