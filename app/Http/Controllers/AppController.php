<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\App;
use App\Category;
use App\Scene;
use App\AppScene;

class AppController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['menu'] = 'app';
        $data['scenes'] = Scene::get();
        $data['categories'] = Category::get();
        return view('admin.app.list', $data);
    }

    public function appList(Request $request)
    {
        $page = $request->input('pagination')['page'];
        $length = $request->input('pagination')['perpage'];

        if (!empty($request->input('sort'))) {
            $sort_column = $request->input('sort')['field'];
            $sort_dir = $request->input('sort')['sort'];
        } else {
            $sort_column = 'updated_at';
            $sort_dir = 'desc';
        }

        $where = [];
        if (!empty($request->input('query'))) {
            $query = $request->input('query');
            if(array_key_exists('app_search', $query)) {
                $search = $query['app_search'];
                array_push($where, ['title', 'like', '%'.$search.'%']);
            }

            if(array_key_exists('status', $query)) {
                $status = $query['status'];
                array_push($where, ['status', '=', $status]);
            }
        }

        $data = App::where($where)
        ->select('id', 'title', 'icon', 'google_play_url', 'apple_store_url', 'genre', 'price', 'status', 'category_id', 'created_at', 'updated_at')
        ->offset(($page-1)*$length)
        ->limit($length)
        ->orderBy($sort_column, $sort_dir)
        ->get();

        $total = App::where($where)->count();
        $pages = $total / $length + 1;
        return response()->json([
            "meta" => [
                "page" => $page,
                "pages" => $pages,
                "perpage" => $length,
                "total" => $total,
                "sort" => $sort_dir,
                "field" => $sort_column
            ],
            "data" => $data
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['menu'] = 'app';
        $data['scenes'] = Scene::get();
        $data['categories'] = Category::get();
        return view('admin.app.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $check_appid_dup = App::where('google_play_id', $request->google_play_id)
            ->orWhere('apple_store_id', $request->apple_store_id)
            ->get()->count();
        if ($check_appid_dup > 0) {
            return response()->json([
                'status' => false,
                'msg'=> __('app_id_duplicate')
            ]);
        }
        $insert_id = App::create($request->except('scene_ids'))->id;
        $scene_id_array = $request->scene_ids;
        if ($scene_id_array && count($scene_id_array) > 0) {
            for($i = 0; $i < count($scene_id_array); $i++) {
                AppScene::create([
                    'app_id' => $insert_id,
                    'scene_id' => $scene_id_array[$i]
                ]);
            }
        }
        return response()->json([
            'status' => true
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['menu'] = 'app';
        return view('admin.app.detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['menu'] = 'app';
        $data['app'] = App::where('id', $id)->first();
        $data['scenes'] = Scene::get();
        $data['categories'] = Category::get();
        $app = App::find($id);
        $scene_ids = [];
        foreach($app->scenes as $scene) {
            array_push($scene_ids, $scene->pivot->scene_id);
        }
        $data['scene_ids'] = implode(',', $scene_ids);
        return view('admin.app.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        App::where('id', $id)->update($request->except('scene_ids'));
        AppScene::where('app_id', $id)->delete();
        $scene_id_array = $request->scene_ids;
        if ($scene_id_array && count($scene_id_array) > 0) {
            for($i = 0; $i < count($scene_id_array); $i++) {
                AppScene::create([
                    'app_id' => $id,
                    'scene_id' => $scene_id_array[$i]
                ]);
            }
        }
        return response()->json([
            'status' => true
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        App::where('id', $id)->delete();
        AppScene::where('app_id', $id)->delete();
        return response()->json([
            'status' => true
        ]);
    }

    public function getScenes(Request $request)
    {
        $id = $request->app_id;
        $app = App::find($id);
        $scenes = [];
        foreach($app->scenes as $scene) {
            array_push($scenes, $scene->pivot->scene_id);
        }
        return response()->json([
            'status' => true,
            'scene_ids' => $scenes
        ]);
    }

    public function setScenes(Request $request)
    {
        $id = $request->app_id;
        $scene_id_array = $request->scene_ids;
        AppScene::where('app_id', $id)->delete();
        for($i = 0; $i < count($scene_id_array); $i++) {
            AppScene::create([
                'app_id' => $id,
                'scene_id' => $scene_id_array[$i]
            ]);
        }
        return response()->json([
            'status' => true
        ]);
    }

    public function setCategory(Request $request)
    {
        $id = $request->app_id;
        App::where('id', $id)->update([
            'category_id' => $request->category_id
        ]);
        return response()->json([
            'status' => true
        ]);
    }

    public function changeStatus(Request $request)
    {
        $id = $request->app_id;
        App::where('id', $id)->update([
            'status' => $request->status
        ]);
        return response()->json([
            'status' => true
        ]);
    }
}
