<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comic;

class IndexController extends Controller
{
    public function index(){
        $comic = Comic::orderBy('id','DESC')->get();
        return view('layouts.client.page.index',compact('comic'));
    }
}
