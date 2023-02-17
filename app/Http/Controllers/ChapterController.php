<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chapter;
use App\Models\Comic;
use App\Helpers\Helper;

class ChapterController extends Controller
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
        if(empty($_GET['id'])){
            return redirect('admin/truyen');
        }
        $chapter = Chapter::with('comic_chapter')->where('comic',$_GET['id'])->get();
        return view('layouts.admin.page.chapter.index',compact('chapter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $comic = @$_GET['id'] ? Comic::find($_GET['id']) : [];
        return view('layouts.admin.page.chapter.create',compact('comic'));
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
                'comic'         =>  'nullable|max:20',
                'name'          =>  'required|max:255',
                'imgs'          =>  'required',
                'desc'          =>  'nullable',
                'slug'          =>  'nullable|max:255',                
                'show'          =>  'nullable|max:1',
            ],
            [
                'name.unique'       =>  'Tên chapter đã tồn tại',
                'name.required'     =>  'Chưa nhập tên chapter',
                'imgs.required'     =>  'Chưa chọn hình ảnh',
            ]
        );
        if($request->has('show')){
            $data['show'] = $request->get('show');
        }else{
            $data['show'] = 0;
        }
        $data['slug'] = Helper::slug($data['name']);
        $chapter = new Chapter;
        $chapter->comic = $data['comic'];
        $chapter->name = $data['name'];
        $chapter->slug = $data['slug'];
        $chapter->desc = $data['desc'];
        $chapter->show = $data['show'];
        $comic->created_at  =  time();
        $comic->updated_at  =  time();
        $imgs = $data['imgs'];        
        $path = 'upload/chapter/';
        $imgs_save = [];
        foreach($imgs as $k => $v){
            $get_name_image = $v->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$v->getClientOriginalExtension();
            $v->move($path,$new_image);
            $imgs_save[] = $new_image;
        }        
        $chapter->imgs = implode(',',$imgs_save);
        $chapter->save();
        return redirect('admin/chapter')->with('status','Thêm chapter thành công');
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
        $chapter = Chapter::with('comic_chapter')->find($id);
        return view('layouts.admin.page.chapter.edit',compact('chapter'));
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
                'comic'         =>  'nullable|max:20',
                'name'          =>  'required|max:255',
                'imgs'          =>  'nullable',
                'desc'          =>  'nullable',
                'slug'          =>  'nullable|max:255',                
                'show'          =>  'nullable|max:1',
            ],
            [
                'name.unique'       =>  'Tên chapter đã tồn tại',
                'name.required'     =>  'Chưa nhập tên chapter',
            ]
        );
        if($request->has('show')){
            $data['show'] = $request->get('show');
        }else{
            $data['show'] = 0;
        }
        $data['slug'] = Helper::slug($data['name']);
        $chapter = Chapter::find($id);
        $chapter->comic = $data['comic'];
        $chapter->name = $data['name'];
        $chapter->slug = $data['slug'];
        $chapter->desc = $data['desc'];
        $chapter->show = $data['show'];
        $comic->updated_at  =  time();  
        if(!empty($data['imgs'])){
            $imgs = $data['imgs'];
            $path = 'upload/chapter/';
            $old_imgs =  $chapter->imgs;
            $imgs_save = [];
            foreach($imgs as $k => $v){
                $get_name_image = $v->getClientOriginalName();
                $name_image = current(explode('.',$get_name_image));
                $new_image = $name_image.rand(0,99).'.'.$v->getClientOriginalExtension();
                $v->move($path,$new_image);
                $imgs_save[] = $new_image;
            }        
            $chapter->imgs = implode(',',$imgs_save);
            if(!empty($old_imgs)){
                foreach(explode(',',$old_imgs) as $img){
                    if(file_exists($path.$img)){
                        unlink($path.$img);
                    }
                }
            }
        }
        $chapter->save();
        return redirect('admin/chapter')->with('status','Thêm chapter thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $chapter = Chapter::find($id);
        $path = 'upload/chapter/';
        if(!empty($chapter['imgs'])){
            foreach(explode(',',$chapter['imgs']) as $img){
                if(file_exists($path.$img)){
                    unlink($path.$img);
                }
            }
        }
        Chapter::find($id)->delete();
        return redirect('admin/chapter')->with('status','Xóa dữ liệu thành công');
    }    
}
