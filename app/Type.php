<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $table = 'types';

    // books.type M:1 type.id Type для Books
    public function books()
    {
        return $this->belongsToMany('App\Book','type','id');
    }
}
