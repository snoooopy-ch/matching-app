<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ScenesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $scenes = ['パパ活', 'ママ活・姉活', 'ご近所', '10代～20代向け', '30代向け', '40代向け', '50代向け', '60代向け', '外国人'];
        $thumbnails = ['パパ活.jpg', 'ママ活.jpg', 'ご近所.png', '10代_20代向け.png', '30代向け.jpg', '40代向け.jpg', '50代向け.jpeg', '60代向け.jpg', '外国人.jpg'];
        foreach($scenes as $key => $scene) {
            DB::table('scenes')->insert([
                'name' => $scene,
                'thumb_img' => '/storage/scene/'.$thumbnails[$key],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }
    }
}
