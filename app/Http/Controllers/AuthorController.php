<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
use App\Helpers\Helper;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authors = Author::orderBy('id','DESC')->get();
        return view('layouts.admin.page.author.index',compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts.admin.page.author.create');
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
                'name'  =>  'required|unique:author|max:255',
                'slug'  =>  'nullable|max:255',              
            ],
            [
                'name.unique'       =>  'Tác giả đã tồn tại',
                'name.required'     =>  'Chưa nhập tên tác giả',
            ]
        );
        if($request->has('show')){
            $data['show'] = $request->get('show');
        }else{
            $data['show'] = 0;
        }
        $data['slug'] = Helper::slug($data['name']);
        $author = new Author;
        $author->name = $data['name'];
        $author->slug = $data['slug'];
        $author->show = $data['show'] ?? 0;
        $author->save();        
        return redirect('admin/tac-gia')->with('status','Thêm danh mục thành công');
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
        $author = Author::find($id);
        return view('layouts.admin.page.author.edit',compact('author'));
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
                'name'  =>  'required|max:255',
                'slug'  =>  'nullable|max:255',              
            ],
            [
                'name.required'     =>  'Chưa nhập tên tác giả',
            ]
        );
        if($request->has('show')){
            $data['show'] = $request->get('show');
        }else{
            $data['show'] = 0;
        }
        $data['slug'] = Helper::slug($data['name']);
        $author = Author::find($id);
        $author->name = $data['name'];
        $author->slug = $data['slug'];
        $author->show = $data['show'] ?? 0;
        $author->save();        
        return redirect('admin/tac-gia')->with('status','Cập nhật tác giả thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Author::find($id)->delete();
        return redirect('admin/tac-gia')->with('status','Xóa dữ liệu thành công');
    }

    public function update_author(Request $request, $id)
    {
        $author = Author::find($id);

        if(!$author) {
            return response()->json([
                'status' => 404,
                'message' => 'Không tìm thấy danh mục'
            ]);
        }

        Author::where('id',$id)->update(['show'=>$request->show]);

        return response()->json([
            'status' => 200,
            'message' => 'Cập nhật thành công'
        ]);
    }
}
