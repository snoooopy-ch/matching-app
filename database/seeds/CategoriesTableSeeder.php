<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            '婚活系マッチングアプリ',
            'その他マッチングアプリ',
            'ビジネス系マッチングア',
            '恋愛系マッチングアプリ',
            '出会い系マッチングアプ',
            'ゲイ・レズ専用アプリ',
            'チャット・トークアプリ',
            '海外マッチングアプリ'
        ];
        foreach($categories as $category) {
            DB::table('categories')->insert([
                'name' => $category,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }
    }
}
