<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Book extends Model
{
    protected $table = 'books';

    protected $primaryKey= "id";

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public function getLastId()
    {
         $arg = DB::table('books')->max('id');         
         return $arg;
    }

    // books.formats M:1 formats.id Format для Books
    public function format()
    {
        return $this->hasOne('App\Format','id','format');
    }

    // books.language M:1 languages.id Language для Books
    public function language()
    {
        return $this->hasOne('App\Language','id','language');
    }

    // books.source M:1 source.id Source для Books
    public function source()
    {
        return $this->hasOne('App\Source','id','source');
    }

    // books.publisher M:1 publishers.id Publisher для Books
    public function publisher()
    {
        return $this->hasOne('App\Publisher','id','publisher');
    }

    // books.creator M:M creator.id Creators для Books
    public function creators()
    {
        return $this->belongsToMany('App\Creator','book_has_creator','book_id','creator_id');
    }

    // books.contributor M:M contributor.id Contributors для Books
    public function contributors()
    {
        return $this->belongsToMany('App\Contributor','book_has_contributor','book_id','contributor_id');
    }

    // books.subjects M:M subjects.id Subjects для Books
    public function subjects()
    {
        return $this->belongsToMany('App\Subject','book_has_subject','book_id','subject_id');
    }


}
