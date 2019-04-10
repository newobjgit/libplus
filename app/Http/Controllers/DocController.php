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
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

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
        $this->validate($request, [
            'title' => ['required', 'string', 'max:255'],
            'link' => 'file'
        ]);


        $file = $this->fileController->uploadFile($request);

        $book = new Book;
        $id = $book->getLastId() + 1;

        $format = new Format;
        $format->filesize = $file['filesize'].' Кб';
        $format->link = $file['path'];
        $format->ext = $file['ext'];
        $format->save();

        $book->title = $request->title;
        $book->description = $request->description;
        $book->year = $request->year;
        $book->language = $request->languagesa[0];
        $book->publisher = $request->publishers[0];
        $book->source = $request->sources[0];
        $book->subject = $id;
        $book->creator = $id;
        $book->contributor = $id;
        $book->format = $id;
        $book->save();

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
            'sour'=> $sour
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

        if ($book = Book::find($id)) {
            $file = $this->fileController->uploadFile($request);

            $format = Format::find($id);
            $format->filesize = $file['filesize'] . ' Кб';
            $format->link = $file['path'];
            $format->ext = $file['ext'];
            $format->save();

            $book->title = $request->title;
            $book->description = $request->description;
            $book->language = $request->languagesa[0];
            $book->publisher = $request->publishers[0];
            $book->year = $request->year;
            $book->source = $request->sources[0];
            $book->format = $id;
            $book->save();

            $book->subjects()->detach();
            $book->creators()->detach();
            $book->contributors()->detach();

            foreach ($request->subjects as $key => $value) {
                $book->subjects()->attach($value);
            }

            foreach ($request->creators as $key => $value) {
                $book->creators()->attach($value);
            }

            foreach ($request->contributors as $key => $value) {
                $book->contributors()->attach($value);
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

        return redirect()->route('doc.index')->with('status', 'Видалено!');
    }



    protected $fileController;
    public function __construct(FileController $fileController)
    {
        $this->fileController = $fileController;
    }
}
