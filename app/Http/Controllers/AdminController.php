<?php

namespace App\Http\Controllers;

use App\Book;
use App\Language;
use App\Source;
use App\Subject;
use App\Creator;
use App\Contributor;
use App\Publisher;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function execute()
    {
        $data = ['title'=>'Панель адміністратора'];
        return view('admin.index',$data);
    }

    public function createDoc()
    {
        $languages = Language::all();
        $subjects = Subject::all();
        $creators = Creator::all();
        $contributors = Contributor::all();
        $publishers = Publisher::all();
        $sources = Source::all();

        return view('docs.create', [
            'languages' => $languages,
            'publishers' => $publishers,
            'contributors' => $contributors,
            'subjects' => $subjects,
            'creators' => $creators,
            'sources' => $sources,
        ]);
    }

    

}
