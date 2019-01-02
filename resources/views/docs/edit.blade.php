@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"> {{ $title }} </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="form">
                            <form action="{{route('doc.update',$id)}}" method="post" role="form" enctype="multipart/form-data">
                                {{csrf_field()}}
                                {{method_field('PATCH')}}
                                <div class="form-group">
                                    <label for="title">Назва:</label>
                                    <input type="text" class="form-control" name="title" id="" placeholder="Назва" value="{{$title }}">
                                </div>
                                <div class="form-group">
                                    <label for="description">Опис:</label>
                                    <textarea class="form-control" name="description" id="" placeholder="Опис">{{ $description }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="year">Рік видання:</label>
                                    <input type="text" class="form-control" name="year" id="" placeholder="Рік видання" value="{{ $date  }}">
                                </div>
                                <div class="form-group">
                                    <label for="language">Мова:</label>
                                    <select class="form-control" name="languagesa[]">
                                        @foreach($languages as $language)
                                            @if ($language->id == $lang->id)
                                            <option value="{{$language->id}}" selected>{{$language->ltitle}}</option>
                                                @else
                                                <option value="{{$language->id}}">{{$language->ltitle}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="publisher">Видавець:</label>
                                    <select class="form-control" name="publishers[]">
                                        @foreach($publishers as $publisher)
                                            @if ($publisher->id == $publ->id)
                                                <option value="{{$publisher->id}}" selected>{{$publisher->name}}</option>
                                            @else
                                                <option value="{{$publisher->id}}">{{$publisher->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="publisher">Джерело:</label>
                                    <select class="form-control" name="sources[]">
                                        @foreach($sources as $source)
                                            @if ($source->id == $sour->id)
                                                <option value="{{$source->id}}" selected>{{$source->title}}</option>
                                            @else
                                                <option value="{{$source->id}}">{{$source->title}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group text-left">
                                    <label for="subjects">Дисципліна:</label>
                                    <select class="form-control" name="subjects[]" multiple>
                                    @foreach($subjects as $subject)
                                        <option value="{{$subject->id}}" {{in_array($subject->id,$book_subjects)?"selected":""}}>{{$subject->title}}</option>
                                    @endforeach
                                    </select>
                                </div>
                                <div class="form-group text-left">
                                    <label for="creators">Автор:</label>
                                    <select class="form-control" name="creators[]" multiple>
                                    @foreach($creators as $creator)
                                        <option value="{{$creator->id}}" {{in_array($creator->id,$book_creators)?"selected":""}}>{{$creator->name}}</option>
                                    @endforeach
                                    </select>                                    
                                </div>
                                <div class="form-group text-left">
                                    <label for="contributors">Співавтор:</label>
                                    <select class="form-control" name="contributors[]" multiple>
                                    @foreach($contributors as $contributor)
                                        <option value="{{$contributor->id}}" {{in_array($contributor->id,$book_contributors)?"selected":""}}>{{$contributor->name}}</option>
                                    @endforeach
                                </div>
                                <div class="form-group">                                   
                                    <input type="file" class="form-control custom-file" name="link">
                                    <label for="link">Текущий файл: {{$link}}</label>
                                </div>
                                <button type="submit" class="btn btn-primary">Зберегти</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection