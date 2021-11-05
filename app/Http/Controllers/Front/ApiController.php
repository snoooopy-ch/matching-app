<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Scene;
use App\Blog;
use App\Category;
use App\App;
use App\Rate;
use App\User;
use App\BlogCategory;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    public function getScenes()
    {
        $scenes = Scene::orderBy('name')->get();
        return response()->json($scenes);
    }

    public function getBlogs()
    {
        $blogs = Blog::leftJoin('blog_categories', 'blog_categories.id', '=', 'blogs.blog_category_id')
            ->select('blogs.id', 'title', 'content', 'thumb_img', 'name as category', 'slug', 'blogs.created_at', 'blogs.updated_at')
            ->where('status', 1)
            ->orderBy('blogs.visit_count', 'desc')
            ->orderBy('blogs.updated_at', 'desc')
            ->get();
        return response()->json($blogs);
    }

    public function getBlogsByPagination(Request $request)
    {
        $current_page = $request->current_page;
        $per_page = $request->per_page;

        $blogs = Blog::leftJoin('blog_categories', 'blog_categories.id', '=', 'blogs.blog_category_id')
            ->select('blogs.id', 'title', 'content', 'thumb_img', 'name as category', 'slug', 'blogs.created_at', 'blogs.updated_at')
            ->where('status', 1)
            ->offset(($current_page - 1)*$per_page)
            ->limit($per_page)
            ->orderBy('blogs.visit_count', 'desc')
            ->orderBy('blogs.updated_at', 'desc')
            ->get();

        $total_count = Blog::leftJoin('blog_categories', 'blog_categories.id', '=', 'blogs.blog_category_id')
            ->select('blogs.id', 'title', 'content', 'thumb_img', 'name as category', 'slug', 'blogs.created_at', 'blogs.updated_at')
            ->where('status', 1)
            ->count();

        return response()->json([
            'total_count' => $total_count,
            "blogs" => $blogs
        ]);
    }

    public function getBlogsByCategory(Request $request)
    {
        $slug = $request->category_slug;
        $category = BlogCategory::where('slug', $slug)->first();
        $blogs = Blog::leftJoin('blog_categories', 'blog_categories.id', '=', 'blogs.blog_category_id')
            ->select('blogs.id', 'title', 'content', 'thumb_img', 'name as category', 'slug', 'blogs.created_at', 'blogs.updated_at')
            ->where('slug', $slug)
            ->where('status', 1)
            ->orderBy('blogs.created_at', 'desc')
            ->get();
        return response()->json([
            'blogs' => $blogs,
            'category' => $category
        ]);
    }

    public function getBlog($id)
    {
        $blog = Blog::leftJoin('blog_categories', 'blog_categories.id', '=', 'blogs.blog_category_id')
            ->select('blogs.id', 'title', 'name', 'slug', 'content', 'thumb_img', 'visit_count', 'blogs.created_at', 'blogs.updated_at')
            ->where('blogs.id', $id)
            ->first();
        return response()->json($blog);
    }

    public function getOtherBlogs(Request $request)
    {
        $cur_id = $request->id;
        $other_blogs = Blog::leftJoin('blog_categories', 'blog_categories.id', '=', 'blogs.blog_category_id')
            ->select('blogs.id', 'title', 'name', 'slug', 'content', 'thumb_img', 'blogs.created_at', 'blogs.updated_at')
            ->where('status', 1)
            ->where('blogs.id', '!=', $cur_id)
            ->orderBy('blogs.visit_count', 'desc')
            ->orderBy('blogs.created_at', 'desc')
            ->limit(3)
            ->get();
        return response()->json($other_blogs);
    }

    public function getCategories()
    {
        $categories = Category::orderBy('name')->get();
        return response()->json($categories);
    }

    public function getBlogCategories()
    {
        $blog_categories = BlogCategory::orderBy('name')->get();
        return response()->json($blog_categories);
    }

    public function submitReview(Request $request)
    {   
        Rate::create($request->all());
        $rates = Rate::select('users.name', 'rates.*')
            ->leftJoin('users', 'users.id', '=', 'rates.user_id')
            ->where('app_id', $request->app_id)
            ->orderBy('created_at', 'desc')
            ->get();
        return response()->json([
            'rates' => $rates
        ]);
    }

    public function getAppList(Request $request)
    {
        $scene_id = $request->scene_id;
        $category_id = $request->category_id;
        $current_page = $request->current_page;
        $per_page = $request->per_page;

        $where = [];
        // Only published app
        array_push($where, ['status', '=', 1]);

        if (!empty($scene_id)) {
            array_push($where, ['scene_id', '=', $scene_id]);
        }
        if (!empty($category_id)) {
            array_push($where, ['category_id', '=', $category_id]);
        }
        $popular_apps = DB::table('apps')
            ->select('apps.id', 'title', 'icon', 'google_score', 'google_ratings', DB::raw('ROUND(AVG(rating*likes), 2) as eval'))
            ->leftJoin('app_scenes', 'app_scenes.app_id', '=', 'apps.id')
            ->leftJoin('rates', 'rates.app_id', '=', 'apps.id')
            ->where($where)
            ->offset(($current_page - 1)*$per_page)
            ->limit($per_page)
            ->orderBy('eval', 'desc')
            ->groupBy('apps.id')
            ->get();
        
        $total_apps = DB::table('apps')
            ->leftJoin('app_scenes', 'app_scenes.app_id', '=', 'apps.id')
            ->where($where)
            ->groupBy('apps.id')
            ->get();

        return response()->json([
            'total_count' => count($total_apps),
            "popular_apps" => $popular_apps
        ]);
    }

    public function getAppDetail($id)
    {
        $app_info = App::find($id);
        $rates = DB::table('rates')
            ->select('users.name', 'rates.*')
            ->leftJoin('users', 'users.id', '=', 'rates.user_id')
            ->where('app_id', $id)
            ->orderBy('created_at', 'desc')
            ->get();
        return response()->json([
            'app_info' => $app_info,
            'rates' => $rates
        ]);
    }

    public function canLeaveComment(Request $request)
    {
        $rate_count = Rate::where([
            'user_id' => $request->user_id,
            'app_id' => $request->app_id
        ])->count();
        if ($rate_count > 0) {
            return response()->json([
                'can_leave' => false
            ]);
        } else {
            return response()->json([
                'can_leave' => true
            ]);
        }
    }

    public function recommend(Request $request)
    {
        $rate_id = $request->rate_id;
        $likes = $request->likes;
        Rate::where('id', $rate_id)->update([
            'likes' => $likes
        ]);
        return response()->noContent();
    }

    public function getNewComments(Request $request)
    {
        $scene_id = $request->scene_id;
        $category_id = $request->category_id;

        $where = [];
        if (!empty($scene_id)) {
            array_push($where, ['scene_id', '=', $scene_id]);
        }
        if (!empty($category_id)) {
            array_push($where, ['category_id', '=', $category_id]);
        }

        $new_comments = DB::table('rates')
            ->select('rates.app_id', 'apps.title', 'users.name', 'rates.rating', 'rates.comment')
            ->leftJoin('app_scenes', 'app_scenes.app_id', '=', 'rates.app_id')
            ->leftJoin('apps', 'apps.id', '=', 'rates.app_id')
            ->leftJoin('users', 'users.id', '=', 'rates.user_id')
            ->where($where)
            ->orderBy('rates.created_at', 'desc')
            ->groupBy('rates.id')
            ->limit(5)
            ->get();

        return response()->json([
            'new_comments' => $new_comments
        ]);
    }

    public function updateProfile(Request $request)
    {
        $v = Validator::make($request->only('name', 'email'), [
            'name' => 'required',
            'email' => 'required|email',
        ]);
        if ($v->fails())
        {
            return response()->json([
                'status' => 'error',
                'errors' => $v->errors()
            ], 200);
        }
        User::where('id', $request->id)->update($request->only('name', 'email'));
        return response()->json(['status' => 'success'], 200);
    }

    public function changePassword(Request $request)
    {
        $v = Validator::make($request->all(), [
            'old' => 'required',
            'new' => 'required|confirmed'
        ]);
        if ($v->fails())
        {
            return response()->json([
                'status' => 'error',
                'errors' => $v->errors()
            ], 200);
        }
        $user = User::find($request->id);
        if (Hash::check($request->old, $user->password)) {
            $user->fill([
                'password' => Hash::make($request->new)
            ])->save();
            return response()->json(['status' => 'success'], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'errors' => [
                    'old' => ['パスワードが間違ってます。']
                ]
            ], 200);
        }
    }

    public function getMyReviews(Request $request)
    {
        $user_id = $request->user_id;
        $my_reviews = Rate::select('rates.id', 'user_id', 'app_id', 'rating', 'comment', 'likes', 'rates.created_at', 'apps.title', 'apps.icon', 'apps.url', 'apps.type')
            ->leftJoin('apps', 'apps.id', '=', 'rates.app_id')
            ->where('user_id', $user_id)
            ->orderBy('rates.created_at', 'desc')
            ->get();
        return response()->json([
            'my_reviews' => $my_reviews
        ]);
    }

    public function getNewApps()
    { 
        $new_apps = App::select('id', 'title', 'icon')
            ->where('status', 1)
            ->limit(3)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'new_apps' => $new_apps
        ]);
    }

    public function updateBlogVisitCount(Request $request)
    {
        $blog_id = $request->blog_id;
        Blog::where('id', $blog_id)->update([
            'visit_count' => DB::raw('visit_count+1')
        ]);

        return response()->noContent();
    }
}
