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

    // menu.subject M:M subjects.id 
    public function menu()
    {
        return $this->belongsToMany('App\menu','menu_has_subject','subject_id','menu_id');
    }

    public $timestamps = false;
}
