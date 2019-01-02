<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Creator extends Model
{
    protected $table = 'creators';

    // books.creator M:M creator.id Creators для Books
    public function books()
    {
        return $this->belongsToMany('App\Book','book_has_creator','creator_id','book_id');
    }

    public $timestamps = false;

}
