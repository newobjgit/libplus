<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contributor extends Model
{
    protected $table = 'contributors';

    // books.contributor M:M contributor.id Contributors для Books
    public function books()
    {
        return $this->belongsToMany('App\Book','book_has_contributor','contributor_id','book_id');
    }

    public $timestamps = false;
}
