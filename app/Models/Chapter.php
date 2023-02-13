<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;
    public $timestamps = true;
    public $fillale = [
        'comic','name','slug','desc','imgs','show'
    ];
    protected $primaryKey = 'id';
    protected $table = 'chapter';   

    public function comic_chapter(){
        return $this->belongsTo('App\Models\Comic','comic','id');
    }
}
