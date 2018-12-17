<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;
use App\Book;

class MenuController extends Controller
{
	public function index()
	{
    	$menus = Menu::get()->toTree(); 			

    	return view('menu.index', ['menus' => $menus]);
    }

    public function filter(Request $request)
    {   
        $books = Book::all();

        $books = $books->format

		return view('docs.docs', [
            'books' => $books
        ]);
    }    

}
	
	


