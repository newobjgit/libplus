<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Menu extends Model
{
	use NodeTrait;

    protected $table = 'menu';

    public $timestamps = false;

    public function getLftName()
	{
	    return 'lidx';
	}

	public function getRgtName()
	{
	    return 'ridx';
	}

	public function getParentIdName()
	{
	    return 'parent_id';
	}

	// books.creator M:M creator.id Creators для Books
    public function subjects()
    {
        return $this->belongsToMany('App\Subject','menu_has_subject','menu_id','subject_id');
    }
	
}
