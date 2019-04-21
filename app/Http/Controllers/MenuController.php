<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;
use App\Book;
use App\Subject;

class MenuController extends Controller
{
    public $globalMenus = array();

	public function index()	{         
        
        //Menu::fixTree();      
        return view('menu.index');
    }    	    

    public function indexPost()
    {
        $menuTree = Menu::get()->toTree();        
        $this->treeHref($menuTree);
        $hrefMenus = $this->globalMenus;         

        $data = Menu::get()->toarray();        

        foreach($data as $key => &$value)
        {            
            $sub_data["id"] = $value["id"];
            $sub_data["name"] = $value["title"];
            $sub_data["text"] = $value["title"];
            $sub_data["parent_id"] = $value["parent_id"];
            
            if(in_array($value["id"],$hrefMenus))
            {
                $sub_data["href"] = "category/".$value["id"];                
            }
            
            $menus[] = $sub_data;
        }

        foreach($menus as $key => &$value)
        {
                $output[$value["id"]] = &$value;
        }

        foreach($menus as $key => &$value)
        {

            if($value["parent_id"] && isset($output[$value["parent_id"]]))
                {
                         $output[$value["parent_id"]]["nodes"][] = &$value;
                }
        }

        foreach($menus as $key => &$value)
        {
                if($value["parent_id"] && isset($output[$value["parent_id"]]))
                {
                        unset($menus[$key]);
                }
        }              

        return $menus;
    }

    public function filterCategory($id)
    {   

        $menu = Menu::find($id);

        $subjects = $menu->subjects()->get();

        
        return view('menu.category', ['subjects' => $subjects, 'parent' => $menu->parent->title, 'name' => $menu->title]); 		
    }

    public function filterBook($id)
    {   
        $subject = Subject::find($id);
        $books = $subject->books()->get();     
        
        return view('docs.docs', ['books' => $books, 'subject' => $subject]);
              
    }

    public function treeHref($data)
    {
        foreach ($data as $key => $value) {
            if(count($value->children) == 0) array_push($this->globalMenus, $value['id']);
            $this->treeHref($value->children);          
        }                    

    }

    public function addForm(Request $Request) 
    {       

        $parent_categories = Menu::get()->toarray();

        Menu::fixTree();       
                        
        return view("admin.menu.index", ['parent_categories' => $parent_categories]);   

    }

    public function addFormPost(Request $request)
    {        
        $menu = new Menu();
        $menu->parent_id = $request->parent_category;
        $menu->title = $request->category_name;
        
        $menu->save(); 
        Menu::fixTree();

        return redirect()->route('addForm')->withMessage('Добавлено!');     

    }

           

}
	
	


