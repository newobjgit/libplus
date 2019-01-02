<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;
use App\Book;
use App\Subject;

class MenuController extends Controller
{
	public function index()
	{
    	$menus = Menu::get()->toTree();
        

    	return view('menu.index', ['menus' => $menus]);
    }

    public function filterCategory($id)
    {   

        $menu = Menu::find($id);

        $subjects = $menu->subjects()->get();

        
        return view('menu.category', ['subjects' => $subjects]); 		
    }

    public function filterBook($id)
    {   
        $subject = Subject::find($id);
        $books = $subject->books()->get();     
        
        return view('docs.docs', ['books' => $books, 'subject' => $subject]);
              
    }        

}
	
	


