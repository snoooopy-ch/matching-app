<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Scene;

class SceneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['menu'] = 'scene';
        $data['scenes'] = Scene::selectRaw('scenes.*, COUNT(app_scenes.app_id) as num_of_apps')
            ->leftJoin('app_scenes', function($join) {
                $join->on('scenes.id', '=', 'app_scenes.scene_id');
            })
            ->groupBy('scenes.id')
            ->get();
        return view('admin.scene', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Scene::create([
            'name' => $request->name
        ]);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        Scene::where('id', $id)->update([
            'name' => $request->name
        ]);
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
        Scene::where('id', $id)->delete();
        return response()->json([
            'status' => true
        ]);
    }
}
