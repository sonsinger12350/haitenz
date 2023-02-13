<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comic extends Model
{
    use HasFactory;
    public $timestamps = true;
    public $fillale = [
        'id','name','slug','thumb','desc','cat','show'
    ];
    protected $table = 'comic';

    public function category(){
        return $this->belongsTo('App\Models\Category','cat','id');
    }
    public function chapter(){
        return $this->hasMany('App\Models\Chapter');
    }
}
