<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;
use App\Book;
use App\Subject;
use App\User;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    public $globalMenus = array();
	public function index(Request $request)	{         
        
        return view('menu.index');
    }    	    

    public function indexPost(Request $request)
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

       /* if(Auth::user()->hasRole('user') == true)
        {
            foreach ($menus as $key => $value) {
                if($value['name'] != "Для студентів"){
                        $menus[$key] = [];

                }
            }
        }*/

        $result = array();

        if(Auth::user()->hasRole('user') == true)
        {
            foreach ($menus as $key => $value) {
                if($value['name'] == "Для студентів"){                        
                    array_push($result, $value);
                   
                }
            }
        }
                     

        return $result;
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

        Menu::fixTree();       
                        
        return view("admin.menu.index");   

    }

    public function addFormPost(Request $request)
    { 
        $menu = new Menu();
        $menu->parent_id = $request->parent_id;
        $menu->title = $request->category_name;
        
        $menu->save(); 
        Menu::fixTree();

        return redirect()->route('addForm')->withMessage('Добавлено!');     

    }

    public function subjectForm(Request $request)
    {
        $subjects = Subject::all();        
        return view("admin.menu.subject", ['subjects' => $subjects]); 
    }

    public function subjectFormPost(Request $request)
    {
        $category_id = $request->parent_id;
        $subject_id = $request->subject;

        $menu = Menu::find($category_id);

        $menu->subjects()->attach($subject_id);
        
        return redirect()->route('subjectFormPost')->withMessage('Успішно!');
    }

           

}
	
	


