<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comic;
use App\Models\Category;
use App\Models\Author;
use App\Helpers\Helper;
use Illuminate\Support\Facades\DB;

class ComicController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comic = Comic::with('Category')->orderBy('id','DESC')->get();
        return view('layouts.admin.page.comic.index')->with(compact('comic'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {        
        $cats = Category::orderBy('id','DESC')->get();
        $authors = Author::orderBy('id','DESC')->get();
        return view('layouts.admin.page.comic.create')->with(compact('cats','authors'));
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
                'name'      =>  'required|unique:comic|max:255',
                'cat'       =>  'required|max:20',
                'author'     =>  'required|max:255',
                'desc'      =>  'nullable',
                'thumb'     =>  'required|image|mimes:jpg,png,jpeg,gif,svg,webp|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000',
                'slug'      =>  'nullable|max:255',
                'show'      =>  'nullable|max:1',
                'status'    =>  'nullable|max:1',
            ],
            [
                'name.unique'       =>  'Tên truyện đã tồn tại',
                'name.required'     =>  'Chưa nhập tên truyện',
                'cat.required'      =>  'Chưa chọn danh mục',
                'author.required'    =>  'Chưa nhập tác giả',
                'thumb.required'    =>  'Chưa chọn hình ảnh',
                'thumb.mimes'       =>  'Hình ảnh không đúng định dạng',
            ]
        );
        if($request->has('show')){
            $data['show'] = $request->get('show');
        }else{
            $data['show'] = 0;
        }
        $data['slug'] = Helper::slug($data['name']);

        $comic = new Comic;
        $comic->name = $data['name'];
        $comic->cat = implode(',',$data['cat']);
        $comic->author = $data['author'];
        $comic->slug = $data['slug'];
        $comic->desc = $data['desc'];
        $comic->show = $data['show'];
        $comic->status = $data['status'];
        $comic->created_at  =  time();
        $comic->updated_at  =  time();  
        $get_image = $data['thumb'];
        $path = 'upload/comic';
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.',$get_name_image));
        $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
        $get_image->move($path,$new_image);        
        $comic->thumb = $new_image;        
        $comic->save(['timestamps' => false]);       

        return redirect('admin/truyen')->with('status','Thêm truyện thành công');
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
        $comic = Comic::find($id);
        $cats = Category::orderBy('id','DESC')->get();
        return view('layouts.admin.page.comic.edit',compact('comic','cats'));
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
                'name'      =>  'required|max:255',
                'cat'       =>  'required|max:20',
                'author'     =>  'required|max:255',
                'desc'      =>  'nullable',
                'thumb'     =>  'nullable|image|mimes:jpg,png,jpeg,gif,svg,webp|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000',
                'slug'      =>  'nullable|max:255',
                'show'      =>  'nullable|max:1',
                'status'    =>  'nullable|max:1',
            ],
            [
                'name.required'     =>  'Chưa nhập tên truyện',
                'cat.required'      =>  'Chưa chọn danh mục',
                'author.required'    =>  'Chưa nhập tác giả',
            ]
        );
        if($request->has('show')){
            $data['show'] = $request->get('show');
        }else{
            $data['show'] = 0;
        }
        $data['slug'] = Helper::slug($data['name']);

        $comic = Comic::find($id);
        $comic->name = $data['name'];
        $comic->cat = implode(',',$data['cat']);
        $comic->author = $data['author'];
        $comic->slug = $data['slug'];
        $comic->desc = $data['desc'];
        $comic->show = $data['show'];
        $comic->status = $data['status'];
        $comic->updated_at = time();
        if(!empty($data['thumb'])){
            $get_image = $data['thumb'];
            $path = 'upload/comic/';
            $old['thumb'] = $path.$comic->thumb;
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path,$new_image);
            $comic->thumb = $new_image;
            if(!empty($old['thumb']) && file_exists($old['thumb'])){
                unlink($old['thumb']);
            }
        }
        $comic->save();       

        return redirect('admin/truyen')->with('status','Cập nhật truyện thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comic = Comic::find($id);
        $path = 'upload/comic/';
        if(!empty($comic['thumb']) && file_exists($path.$comic['thumb'])){
            unlink($path.$comic['thumb']);
        }
        Comic::find($id)->delete();
        DB::statement("ALTER TABLE `comic` AUTO_INCREMENT = 1");
        return redirect('admin/truyen')->with('status','Xóa dữ liệu thành công');        
    }

    public function update_comic(Request $request,$id)
    {       
        $comic = Comic::find($id);
        if(!$comic){
            return response()->json([
                'status' => 404,
                'message' => 'Không tìm thấy truyện'
            ]);
        }
        Comic::where('id',$id)->update([$request->column=>$request->val]);
        
        return response()->json([
            'status' => 200,
            'message' => 'Cập nhật thành công'
        ]);
    }
}
