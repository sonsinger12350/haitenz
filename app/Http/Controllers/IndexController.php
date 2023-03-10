<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comic;
use App\Models\Category;
use App\Models\Author;
use App\Models\Chapter;

use DB;
use Cookie;
use Auth;

class IndexController extends Controller
{
    public function index() {
        $comic = Comic::where('show',1)->orderBy('updated_chapter','DESC')->get();
        $comic_hot_where = [
            ['show','=',1],
            ['hot','=',1],
        ];        
        $comic_hot = Comic::where($comic_hot_where)->orderBy('id','DESC')->take(6)->get();
        $cats = Category::orderBy('id','DESC')->get();
        return view('layouts.client.page.index',compact('comic', 'comic_hot', 'cats'));
    }
    public function cat($slug) {        
        $cats = Category::orderBy('id','DESC')->get();
        $cat = Category::where('slug','=',$slug)->first();
        $where = [
            ['show','=',1],
            ['cat','=',$cat['id']],
        ];
        $comic = Comic::where($where)->orderBy('id','DESC')->take(15)->get();
        return view('layouts.client.page.cat',compact('comic', 'cat', 'cats'));
    }

    public function comic($slug) {        
        $follow = Cookie::get('follow');
        if($follow){
            $follow = explode(',',$follow);
        }else{
            $follow = [];
        }
        $cats = Category::orderBy('id','DESC')->get()->keyBy('id');       
        $where = [
            ['show','=',1],
            ['slug','=',$slug],
        ];
        $comic = Comic::with(['Author'])->where($where)->orderBy('id','DESC')->first();  
        $comic_cat = explode(',',$comic['cat']);
        $list_cat = [];
        if ($comic_cat) {
            foreach ($comic_cat as $v) {
                $list_cat[] = [
                    'slug'  =>  $cats[$v]['slug'],
                    'name'  =>  $cats[$v]['name'],
                ];
            }            
        }
        $comic['list_cat'] = $list_cat;
        $chapters = Chapter::where([['show','=','1'],['comic','=',$comic['id']]])->orderBy('id','DESC')->get();
        
        $relate_where = [
            ['cat','=',$comic['cat']],
            ['show','=',1],
            ['id','!=',$comic['id']],
        ];
        $relate = Comic::where($relate_where)->orderBy('id','DESC')->take(15)->get();
        return view('layouts.client.page.comic',compact('comic', 'relate', 'cats', 'follow', 'chapters'));
    }

    public function author($slug) {        
        $cats = Category::orderBy('id','DESC')->get();
        $author = Author::where('slug','=',$slug)->first();
        $where = [
            ['show','=',1],
            ['author','=',$author['id']],
        ];
        $comics = Comic::where($where)->orderBy('id','DESC')->take(15)->get();  
        return view('layouts.client.page.comic_author',compact('comics', 'cats', 'author'));
    }
    public function follow(Request $request,$id) {
        $follow = Cookie::get('follow');
        $add = [];
        $action = 0;
        if (!empty($follow) ) {
            $add = explode(',',$follow);
        }
        if ($request->follow==1 ) {
            $add[] = $id;
            $action = 1;
            Comic::where('id',$id)->increment('follow',1);
        } else {
            unset($add[array_search($id,$add)]);
            Comic::where('id',$id)->decrement('follow',1);
        }
        $add_fav = implode(',',$add);
        $minutes = 60*60*24*30; 
        Cookie::queue(Cookie::make('follow', $add_fav, $minutes));
        return response()->json([
            'status'    => 200,
            'message'   => $action == 1 ? '???? theo d??i truy???n' : '???? ng???ng theo d??i truy???n',
            'data'      => $action,
        ]);
   }

    public function follow_list() {
        $cats = Category::orderBy('id','DESC')->get();
        $follow = Cookie::get('follow');
        $comics = Comic::whereIn('id',explode(',',$follow))->take(15)->get();
        return view('layouts.client.page.follow',compact('comics', 'cats'));
   }
    public function chapter($slug) {        
        $cats = Category::orderBy('id','DESC')->get();
        $chapter = Chapter::where('slug',$slug)->first();
        $comic = Comic::where('id',$chapter['comic'])->first();
        $chapter['imgs'] = explode(',',$chapter['imgs']);
        return view('layouts.client.page.chapter',compact('chapter', 'cats','comic'));
   }
    public function search_comic(Request $request) {        
        $comic = Comic::where('name','LIKE','%'.$request['keyword'].'%')->take(10)->get();
        $content = '';
        if(!$comic->isEmpty()) {
            foreach($comic as $v) {
                $content .= '<a href="'.route('truyen',['slug'=>$v['slug']]).'" class="search_item justify-between"> <div class="result_img"> <img src="'.asset('upload/comic/'.$v['thumb']).'" alt=""> </div><p class="mb-0 result_name">'.$v['name'].'</p></a>';
            }            
        } else {
            $content = '<p class="mb-0 text-center">Kh??ng t??m th???y truy???n</p>';
        }
        return response()->json([
            'status'    => 200,
            'message'   => 'C???p nh???t th??nh c??ng',
            'data'      => $content 
        ]);
   }
      
}
