<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $fillale = [
        'comic','name','slug','desc','imgs','show','created_at','updated_at'
    ];
    protected $primaryKey = 'id';
    protected $table = 'chapter';   

    public function comic_chapter(){
        return $this->belongsTo('App\Models\Comic','comic','id');
    }
}
