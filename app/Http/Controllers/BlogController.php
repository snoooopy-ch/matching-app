<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;
use App\BlogCategory;
use Auth;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['menu'] = 'blog';
        $data['blog_categories'] = BlogCategory::get();
        return view('admin.blog.list', $data);
    }

    public function blogList(Request $request)
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
            if(array_key_exists('blog_search', $query)) {
                $search = $query['blog_search'];
                array_push($where, ['title', 'like', '%'.$search.'%']);
            }

            if(array_key_exists('status', $query)) {
                $status = $query['status'];
                array_push($where, ['status', '=', $status]);
            }

            if(array_key_exists('blog_category_id', $query)) {
                $category_id = $query['blog_category_id'];
                array_push($where, ['blog_category_id', '=', $category_id]);
            }
        }

        $data = Blog::leftJoin('blog_categories', 'blog_categories.id', '=', 'blogs.blog_category_id')
        ->select('blogs.id', 'title', 'blog_categories.name', 'status', 'blogs.created_at', 'blog_categories.slug')
        ->where($where)
        ->offset(($page-1)*$length)
        ->limit($length)
        ->orderBy($sort_column, $sort_dir)
        ->get();

        $total = Blog::where($where)->count();
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
    // just placeholder method for dropzone action
    public function uploadThumb(Request $request)
    {
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['menu'] = 'blog';
        $data['blog_categories'] = BlogCategory::get();
        return view('admin.blog.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->hasFile('thumbnail')) {
            $fileName = md5(date('YmdHis') . $request->thumbnail->getFilename()) . '.' . $request->thumbnail->extension();
            $filePath = $request->thumbnail->storeAs('blog', $fileName, 'public');
        }
        Blog::create([
            'title' => $request->title,
            'blog_category_id' => $request->blog_category_id, 
            'content' => $request->content,
            'status' => $request->status,
            'user_id' => Auth::user()->id,
            'thumb_img' => '/'.'storage/'.$filePath
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['menu'] = 'blog';
        $data['blog'] = Blog::find($id);
        $data['blog_categories'] = BlogCategory::get();
        return view('admin.blog.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateBlog(Request $request, $id)
    {
        if ($request->hasFile('thumbnail')) {
            $fileName = md5(date('YmdHis') . $request->thumbnail->getFilename()) . '.' . $request->thumbnail->extension();
            $filePath = $request->thumbnail->storeAs('blog', $fileName, 'public');
            $request->merge(['thumb_img' => '/'.'storage/'.$filePath]);
        }
        Blog::where('id', $id)->update($request->except('thumbnail'));
        return response()->json([
            'status' => true
        ]);
    }

    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Blog::where('id', $id)->delete();
        return response()->json([
            'status' => true
        ]);
    }
}
