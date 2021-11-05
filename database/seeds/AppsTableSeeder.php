<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AppsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('apps')->insert([
            'title' => '暇つぶし・ひまチャット・無料通話・友達作り・トークアプリ・悩み相談・匿名掲示板【ランダムチャット】',
            'icon' => 'https://play-lh.googleusercontent.com/i-tbB3CdCbdFRmkOdRwgjWq2lYbF04NsdFipop5UpIDBr_n2TojJNNHoC9qB3Mm8XzUQ=s180-rw',
            'google_play_url' => 'https://play.google.com/store/apps/details?id=com.randomchat&hl=ja&gl=us',
            'google_play_id' => 'com.randomchat',
            'apple_store_url' => 'https://apps.apple.com/us/app/%E3%83%A9%E3%83%B3%E3%83%80%E3%83%A0%E3%83%81%E3%83%A3%E3%83%83%E3%83%88-%E6%9A%87%E3%81%A4%E3%81%B6%E3%81%97%E9%80%9A%E8%A9%B1%E3%82%A2%E3%83%97%E3%83%AA/id1350216700?ign-mpt=uo%3D4',
            'apple_store_id' => '1350216700',
            'google_score' => '4.2',
            'apple_score' => '4.3',
            'genre' => 'Social Networking',
            'google_ratings' => '3109',
            'apple_ratings' => '13',
            'price' => '0',
            'is_free' => 1,
            'currency' => 'USD',
            'developer' => 'eureka Inc.',
            'developer_website' => 'https://randomchat-53f4d.web.app/',
            'google_install_cnt' => '100,000+',
            'google_release_date' => '',
            'google_update_date' => '1615467600',
            'apple_release_date' => '',
            'apple_update_date' => '',
            'content_rating' => '17+',
            'android_version' => '4.42',
            'android_size' => '16M',
            'ios_version' => '4.43',
            'ios_size' => '57.7M',
            'required_android_version' => '4.1',
            'required_ios_version' => '10.0',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
