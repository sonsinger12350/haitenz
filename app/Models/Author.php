<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'author';
    public $fillale = [
        'id','name','slug','show'
    ];
    public function comic(){
        return $this->hasMany('App\Models\Comic');
    }
}
