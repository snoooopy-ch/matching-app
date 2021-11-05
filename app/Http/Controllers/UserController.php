<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['menu'] = 'user';
        return view('admin.user', $data);
    }

    public function userList(Request $request)
    {
        $page = $request->input('pagination')['page'];
        $length = $request->input('pagination')['perpage'];

        if (!empty($request->input('sort'))) {
            $sort_column = $request->input('sort')['field'];
            $sort_dir = $request->input('sort')['sort'];
        } else {
            $sort_column = 'created_at';
            $sort_dir = 'desc';
        }

        $where = [];
        if (!empty($request->input('query'))) {
            $query = $request->input('query');
            if(array_key_exists('user_search', $query)) {
                $search = $query['user_search'];
                array_push($where, ['email', 'like', '%'.$search.'%']);
            }
        }
        array_push($where, ['role', '=', 2]);

        $data = User::where($where)
        ->select('id', 'name', 'email', 'created_at')
        ->offset(($page-1)*$length)
        ->limit($length)
        ->orderBy($sort_column, $sort_dir)
        ->get();

        $total = User::where($where)->count();
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
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
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
        if(empty($request->password)) {
            User::where('id', $id)->update([
                'name' => $request->name,
                'email' => $request->email
            ]);
        } else {
            User::where('id', $id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
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
        User::where('id', $id)->delete();
        return response()->json([
            'status' => true
        ]);
    }
}
