<?php

namespace App\Http\Controllers;

use App\Book;
use App\Categories;
use App\Format;
use App\Language;
use App\MainCategories;
use App\Menu;
use App\MimeType;
use App\SmallCategories;
use App\Source;
use App\Subject;
use App\Creator;
use App\Contributor;
use App\Publisher;
use Illuminate\Support\Facades\Validator; 
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DocController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($subject)
    {   
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public function store(Request $request)    
    {      
        $messages = array(
                'title.required' => 'Необхідно ввести назву.',
                'link.required' => 'Необхідно добавити файл.',
                'year.required' => 'Необхідно ввести рік.',
                'year.integer' => 'Необхідно ввести число.'

            );

         $validator = Validator::make($request->all(), [
        'title' => 'required|string|max:255',
        'link' => 'required|file',
        'year' => 'required|integer'        
        ], $messages );

        if ($validator->fails())
        {    
            return redirect()->back()->withErrors($validator->errors());
        }        
         


        $file = $this->fileController->uploadFile($request);
        
        $book = new Book;

        $id = $book->getlastid() + 1;        

        $format = new Format;
        $format->filesize = $file['filesize'].' Кб';
        $format->link = $file['path'];
        $format->ext = $file['ext'];
        $format->save();       

        if($request->isPrivate)
            {
                $book->isPrivate = 0;
            }
            else
            {
                $book->isPrivate = 1;
            }

        $book->title = $request->title;
        $book->description = $request->description;
        $book->year = $request->year;
        $book->language = $request->language;
        $book->publisher = $request->publisher;
        $book->source = $request->source;        
        $book->format = $format->id;
        $book->subject = $id;
        $book->creator = $id;
        $book->contributor = $id;
        $book->save();
        
        foreach ($request->subjects as $subject) {
            $book->subjects()->attach($subject);
        }
        
        foreach ($request->creators as $creator) {           
            $book->creators()->attach($creator);            
        }

        foreach ($request->contributors as $contributor) {            
            $book->contributors()->attach($contributor);
        }        

        return redirect()->route('doc.show',$id)->with('status', 'Добавлено!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {        
        if($book = Book::find($id)) {
            $id = $book->id;
            $title = $book->title;
            $subjects = $book->subjects()->pluck('title')->all();
            $creators = $book->creators()->pluck('name')->all();
            $contributors = $book->contributors()->pluck('name')->all();
            $description = $book->description;
            $language = $book->language()->pluck('ltitle')->first();
            $publisher = $book->publisher()->pluck('name')->first();
            $year = $book->year;
            $format = $book->format()->first();
            $source = $book->source()->pluck('title')->first();;
            $link = $book->format()->pluck('link')->first();
            $isPrivate = $book->isPrivate;

            if(Auth::user()->hasRole('user') == true)
            {               
                if($isPrivate == 1) abort('403');
            }

            $count_subjects = count($subjects);
            $count_creators = count($creators);
            $count_contributors = count($contributors);

        }
        else(abort('404'));

        return view('docs.doc', [
            'id' => $id,
            'description' => $description,
            'title' => $title,
            'language' => $language,
            'subjects' => $subjects,
            'count_subjects' => $count_subjects,
            'count_creators' => $count_creators,
            'count_contributors' => $count_contributors,
            'creators' => $creators,
            'publisher' => $publisher,
            'contributors' => $contributors,
            'date' => $year,
            'format' => $format,
            'source' => $source,
            'link' => $link

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if ($book = Book::find($id)) {
            $id = $book->id;
            $title = $book->title;

            $subjects = Subject::all();
            $book_subjects = $book->subjects()->pluck('id','id')->toArray();

            $creators = Creator::all();
            $book_creators = $book->creators()->pluck('id','id')->toArray();

            $contributors = Contributor::all();
            $book_contributors = $book->contributors()->pluck('id','id')->toArray();

            $description = $book->description;

            $languages = Language::all();
            $lang = $book->language()->first();

            $publishers = Publisher::all();
            $publ = $book->publisher()->first();

            $year = $book->year;

            $format = $book->format()->first();

            $sources = Source::all();
            $sour = $book->source()->first();

            $link = $book->format()->pluck('link')->first();

            $isPrivate = $book->isPrivate;           

        } else(abort('404'));

        return view('docs.edit', [
            'id' => $id,
            'description' => $description,
            'title' => $title,
            'languages' => $languages,
            'publishers' => $publishers,
            'contributors' => $contributors,
            'date' => $year,
            'format' => $format,
            'sources' => $sources,
            'link' => $link,
            'subjects' => $subjects,
            'book_subjects' => $book_subjects,
            'creators' => $creators,
            'book_creators' => $book_creators,
            'book_contributors' => $book_contributors,
            'lang' => $lang,
            'publ'=> $publ,
            'sour'=> $sour,
            'isPrivate' => $isPrivate
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id){

        $messages = array(
                'title.required' => 'Необхідно ввести назву.',              
                'year.required' => 'Необхідно ввести рік.',
                'year.integer' => 'Необхідно ввести число.'

            );

         $validator = Validator::make($request->all(), [
        'title' => 'required|string|max:255',        
        'year' => 'required|integer'        
        ], $messages );

        if ($validator->fails())
        {    
            return redirect()->back()->withErrors($validator->errors());
        } 


        if ($book = Book::find($id)) {

            if($request->filebool){               
                $file = $this->fileController->uploadFile($request);
                $format = Format::find($id);
                $format->filesize = $file['filesize'] . ' Кб';
                $format->link = $file['path'];
                $format->ext = $file['ext'];
                $format->save();
                $book->format = $format->id;
            }

            if($request->isPrivate)
            {
                $book->isPrivate = 0;
            }
            else
            {
                $book->isPrivate = 1;
            }

            $book->title = $request->title;
            $book->description = $request->description;
            $book->language = $request->languagesa[0];
            $book->publisher = $request->publishers[0];
            $book->year = $request->year;
            $book->source = $request->sources[0];            
            $book->save();


            $book->subjects()->detach();
            $book->creators()->detach();
            $book->contributors()->detach();

            foreach ($request->subjects as $subject) {
                $book->subjects()->attach($subject);
            }
        
            foreach ($request->creators as $creator) {           
                $book->creators()->attach($creator);            
            }

            foreach ($request->contributors as $contributor) {            
                $book->contributors()->attach($contributor);
            }

        }
        else (abort('404'));


        return redirect()->route('doc.show',$id)->with('status', 'Оновлено!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){

        $book = Book::find($id);
        $book->delete();


        return redirect()->route('index')->with('status', 'Видалено!');
    }



    protected $fileController;
    public function __construct(FileController $fileController)
    {
        $this->fileController = $fileController;
    }
}
