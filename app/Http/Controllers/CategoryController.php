<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Helpers\Helper;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cats = Category::orderBy('id','DESC')->get();
        return view('layouts.admin.page.category.index')->with(compact('cats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts.admin.page.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        $data = $request->validate(
            [
                'name'  =>  'required|unique:cat|max:255',
                'slug'  =>  'nullable|max:255',
                'desc'  =>  'nullable|max:500',                
            ],
            [
                'name.unique'       =>  'Tên danh mục đã tồn tại',
                'name.required'     =>  'Chưa nhập tên danh mục',
            ]
        );
        if($request->has('show')){
            $data['show'] = $request->get('show');
        }else{
            $data['show'] = 0;
        }
        $data['slug'] = Helper::slug($data['name']);
        $cat = new Category;
        $cat->name = $data['name'];
        $cat->slug = $data['slug'];
        $cat->desc = $data['desc'];
        $cat->show = $data['show'] ?? 0;
        $cat->save();        
        return redirect('admim/danh-muc')->with('status','Thêm danh mục thành công');
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
        $cat = Category::find($id);
        return view('layouts.admin.page.category.edit',compact('cat'));
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
        
        $data = $request->validate(
            [
                'name'  =>  'required|unique:cat|max:255',
                'slug'  =>  'nullable|max:255',
                'desc'  =>  'nullable|max:500',                
            ],
            [
                'name.unique'       =>  'Tên danh mục đã tồn tại',
                'name.required'     =>  'Chưa nhập tên danh mục',                
            ]
        );
        if($request->has('show')){
            $data['show'] = $request->get('show');
        }else{
            $data['show'] = 0;
        }
        $data['slug'] = Helper::slug($data['name']);
        $cat = Category::find($id);
        $cat->name = $data['name'];
        $cat->slug = $data['slug'];
        $cat->desc = $data['desc'];
        $cat->show = $data['show'] ?? 0;
        $cat->save();        
        return redirect('admin/danh-muc')->with('status','Cập nhật danh mục thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::find($id)->delete();
        return redirect('admin/danh-muc')->with('status','Xóa dữ liệu thành công');
    }

    public function update_show(Request $request, $id)
    {
        $id_category = Category::find($id);

        if(!$id_category) {
            return response()->json([
                'status' => 404,
                'message' => 'Không tìm thấy danh mục'
            ]);
        }

        $category = Category::where('id',$id)->update(['show'=>$request->show]);

        return response()->json([
            'status' => 200,
            'message' => 'Cập nhật thành công'
        ]);
    }
}
