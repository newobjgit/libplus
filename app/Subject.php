<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table = 'subjects';

    // books.subjects M:M subjects.id Subjects для Books
    public function books()
    {
        return $this->belongsToMany('App\Book','book_has_subject','subject_id','book_id');
    }
}
