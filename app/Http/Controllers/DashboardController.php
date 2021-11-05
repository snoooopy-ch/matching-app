<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\App;
use App\User;
use App\Blog;
use App\BlogCategory;
use App\Scene;
use App\Category;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $data['menu'] = 'dashboard';
        $data['total_app_cnt'] = App::count();
        $data['total_user_cnt'] = User::where('role', 2)->count();
        $current_year = Carbon::now()->format('Y');
        $current_month = Carbon::now()->format('m');
        $data['new_app_cnt'] = DB::table('apps')
            ->whereMonth('created_at', $current_month)
            ->whereYear('created_at', $current_year)
            ->count();
        $data['new_app_progress'] = $data['total_app_cnt'] ? round($data['new_app_cnt'] / $data['total_app_cnt'] * 100) : 0;
        $data['new_user_cnt'] = DB::table('users')
            ->where('role', 2)
            ->whereMonth('created_at', $current_month)
            ->whereYear('created_at', $current_year)
            ->count();
        $data['new_user_progress'] = $data['total_app_cnt'] ? round($data['new_user_cnt'] / $data['total_user_cnt'] * 100) : 0;
        $data['blog_cnt'] = Blog::where('status', 1)->count();
        $data['blog_category_cnt'] = BlogCategory::count();
        $data['scene_cnt'] = Scene::count();
        $data['category_cnt'] = Category::count();
        return view('admin.dashboard', $data);
    }
}
