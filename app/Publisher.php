<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    protected $table = 'publishers';

    // books.publisher M:1 publishers.id Publsiher для Books
    public function books()
    {
        return $this->belongsToMany('App\Book','publisher','id');
    }
}
