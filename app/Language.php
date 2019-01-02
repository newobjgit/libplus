<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $table = 'languages';

    // books.language M:1 languages.id Language для Books
    public function books()
    {
        return $this->belongsToMany('App\Book','language','id');
    }

    public $timestamps = false;
}
