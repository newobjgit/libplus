<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    protected $table = 'sources';

    // books.source M:1 source.id Source для Books
    public function books()
    {
        return $this->belongsToMany('App\Book','source','id');
    }

    public $timestamps = false;
}
