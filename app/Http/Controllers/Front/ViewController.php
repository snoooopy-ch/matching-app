<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Scene;
use App\Category;
use App\App;
use App\BlogCategory;
use App\Blog;

class ViewController extends Controller
{
    public function index()
    {
        return view('front.spa');
    }

    public function home()
    {
        $data['title'] = '探したいマッチングアプリがみつかる';
        return view('front.home', $data);
    }

    public function login()
    {
        $data['title'] = 'ログイン';
        return view('front.login', $data);
    }

    public function register()
    {
        $data['title'] = '新規会員登録';
        return view('front.register', $data);
    }

    public function ranking(Request $request)
    {
        $data['scene_id'] = '';
        $data['scene_name'] = '';
        $data['category_id'] = '';
        $data['category_name'] = '';

        $id = $request->id;
        if (Str::startsWith($id, 'scene')) {
            $id = str_replace('scene', '', $id);

            $scene = Scene::where('id', $id)->first();
            $data['scene_id'] = $id;
            $data['scene_name'] = $scene->name;
        } else if (Str::startsWith($id, 'category')) {
            $id = str_replace('category', '', $id);

            $category = Category::where('id', $id)->first();
            $data['category_id'] = $id;
            $data['category_name'] = $category->name;
        }

        if ($data['scene_id'] && !$data['category_id']) {
            $data['title'] = $data['scene_name'] . 'アプリランキング';
        } else if($data['scene_id'] && $data['category_id']) {
            $data['title'] = $data['scene_name'] . ' ' . $data['category_name'] . 'ランキング';
        } else if(!$data['scene_id'] && $data['category_id']) {
            $data['title'] = $data['category_name'] . 'ランキング';
        } else {
            $data['title'] = '人気アプリランキング';
        }

        return view('front.ranking', $data);
    }

    public function terms()
    {
        $data['title'] = '利用規約';
        return view('front.terms', $data);
    }

    public function privacy()
    {
        $data['title'] = 'プライバシーポリシー';
        return view('front.privacy', $data);
    }

    public function appDetail($id)
    {
        $app = App::where('id', $id)->first();
        $data['title'] = $app->title;
        $data['app_id'] = $id;
        return view('front.app', $data);
    }

    public function blogs()
    {
        $data['title'] = 'ブログ';
        return view('front.blogs', $data);
    }

    public function blogCategory($category)
    {
        $blog_category = BlogCategory::where('slug', $category)->first();
        $data['title'] = $blog_category->name;
        $data['category_slug'] = $category;
        return view('front.category', $data);
    }

    public function blog($category, $id)
    {
        $blog = Blog::where('id', $id)->first();
        $data['title'] = $blog->title;
        $data['category'] = $category;
        $data['blog_id'] = $id;
        return view('front.blog', $data);
    }
}
