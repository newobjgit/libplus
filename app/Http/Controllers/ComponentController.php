<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; 
use App\Language;
use App\Publisher;
use App\Source;
use App\Subject;
use App\Contributor;
use App\Creator;

class ComponentController extends Controller
{
    public function Lang()
    {        
    	return view('components.language');

    }

    public function addLang(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string', 'max:255'],            
        ]);    	

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $language = new Language;
        $language->ltitle = $request->title;
        $language->save();

        return redirect()->route('create')->with('status', 'Добавлено!');
    }

    public function Publisher()
    {
        return view('components.publisher');

    }

    public function addPublisher(Request $request)
    {        
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string', 'max:255'],            
        ]);     

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $publisher = new Publisher;
        $publisher->name = $request->title;
        $publisher->save();

        return redirect()->route('create')->with('status', 'Добавлено!');
    }

    public function Source()
    {
        return view('components.source');

    }

    public function addSource(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string', 'max:255'],            
        ]);     

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $source = new Source;
        $source->title = $request->title;
        $source->save();

        return redirect()->route('create')->with('status', 'Добавлено!');
    }

    public function Subject()
    {
        return view('components.subject');

    }

    public function addSubject(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string', 'max:255'],            
        ]);     

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $subject = new Subject;
        $subject->title = $request->title;
        $subject->save();

        return redirect()->route('create')->with('status', 'Добавлено!');
    }

    public function Creator()
    {
        return view('components.creator');

    }

    public function addCreator(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string', 'max:255'],            
        ]);     

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $creator = new Creator;
        $creator->name = $request->title;
        $creator->save();

        return redirect()->route('create')->with('status', 'Добавлено!');
    }

    public function Contributor()
    {
        return view('components.contributor');

    }

    public function addContributor(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string', 'max:255'],            
        ]);     

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $contributor = new Contributor;
        $contributor->name = $request->title;
        $contributor->save();

        return redirect()->route('create')->with('status', 'Добавлено!');
    }
}
