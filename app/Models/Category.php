<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public $timestamps = false;
    public $fillale = [
        'id','name','slug','desc','show'
    ];
    protected $primaryKey = 'id';
    protected $table = 'cat';
    public function comic(){
        return $this->hasMany('App\Models\Comic');
    }
}
