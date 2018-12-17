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
                                        @if($sour != null )
                                            @foreach($sources as $source)
                                                @if ($source->id == $sour->id)
                                                <option value="{{$source->id}}" selected>{{$source->title}}</option>
                                                @else
                                                <option value="{{$source->id}}">{{$source->title}}</option>
                                                @endif
                                            @endforeach
                                        @else
                                            @foreach($sources as $source)
                                                <option value="{{$source->id}}">{{$source->title}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group text-left">
                                    <label for="subjects">Дисципліна:</label>
                                    @foreach($subjects as $subject)
                                        <input type="checkbox" {{in_array($subject->id,$book_subjects)?"checked":""}}
                                        name="subjects[]" value="{{$subject->id}}" > {{$subject->title}}
                                    @endforeach
                                </div>
                                <div class="form-group text-left">
                                    <label for="creators">Автор:</label>
                                    @foreach($creators as $creator)
                                        <input type="checkbox" {{in_array($creator->id,$book_creators)?"checked":""}}
                                        name="creators[]" value="{{$creator->id}}" > {{$creator->name}}
                                    @endforeach
                                </div>
                                <div class="form-group text-left">
                                    <label for="creators">Співавтор:</label>
                                    @foreach($contributors as $contributor)
                                        <input type="checkbox" {{in_array($contributor->id,$book_contributors)?"checked":""}}
                                        name="contributors[]" value="{{$contributor->id}}" > {{$contributor->name}}
                                    @endforeach
                                </div>
                                <div class="form-group text-left">
                                    <label for="link">Текущий файл: {{$link}}</label>
                                    <input type="file" class="custom-file" name="link">
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