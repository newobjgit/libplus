<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
    	$this->validate($request, [
            'title' => ['required', 'string', 'max:255'],            
        ]);

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
        $this->validate($request, [
            'title' => ['required', 'string', 'max:255'],            
        ]);

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
        $this->validate($request, [
            'title' => ['required', 'string', 'max:255'],            
        ]);

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
        $this->validate($request, [
            'title' => ['required', 'string', 'max:255'],            
        ]);

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
        $this->validate($request, [
            'title' => ['required', 'string', 'max:255'],            
        ]);

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
        $this->validate($request, [
            'title' => ['required', 'string', 'max:255'],            
        ]);

        $contributor = new Contributor;
        $contributor->name = $request->title;
        $contributor->save();

        return redirect()->route('create')->with('status', 'Добавлено!');
    }
}
