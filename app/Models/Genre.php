<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    //
    protected $primaryKey = 'gen_id';
    public $incrementing = false;
    public $timestamps = false;
    public function movies(){
        return $this->belongsToMany(Movie::class,'genre_movie','gen_id','mov_id');
    }
}
