<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comic extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $fillale = [
        'id','name','slug','thumb','desc','cat','author','hot','show','status','count_view','created_at','updated_at'
    ];
    protected $table = 'comic';

    public function category(){
        return $this->belongsTo('App\Models\Category','cat','id');
    }
    public function chapter(){
        return $this->hasMany('App\Models\Chapter');
    }
    public function author(){
        return $this->belongsTo('App\Models\Author','author','id');
    }
}
