@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">          
                        <h3 class="panel-title">Додавання нового документа</h3>
                    </div>                    
                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                            <form action="{{route('doc.store')}}" method="post" role="form" enctype="multipart/form-data">
                                {{csrf_field()}}
                                {{method_field('POST')}}
                                <div class="form-group">
                                    <label for="title">Назва:</label>
                                    <input type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title') }}" id="" placeholder="Назва">
                                    @if ($errors->has('title'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="description">Опис:</label>
                                    <textarea class="form-control" name="description" id="" placeholder="Опис"></textarea>
                                    @if ($errors->has('description'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="year">Рік видання:</label>
                                    <input type="text" class="form-control" name="year" id="" placeholder="Рік видання">
                                    @if ($errors->has('year'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('year') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="language">Мова:</label>
                                    <select class="form-control" name="languagesa[]">                                        
                                        @foreach($languages as $language)
                                                <option value="{{$language->id}}">{{$language->ltitle}}</option>
                                        @endforeach
                                    </select>                                                                        
                                    <div align="right" class="">
                                        <a href="{{ route('Lang') }}" class="btn btn-primary btn-sm ">Добавити нову мову</a>
                                    </div>
                                    @if ($errors->has('languagesa[]'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('languagesa[]') }}</strong>
                                    </span>
                                    @endif                                                                      
                                <div class="form-group">
                                    <label for="publisher">Видавець:</label>
                                    <select class="form-control" name="publishers[]" >
                                        @foreach($publishers as $publisher)
                                                <option value="{{$publisher->id}}">{{$publisher->name}}</option>
                                        @endforeach
                                    </select>
                                    <div align="right" class="group">
                                        <a href="{{ route('Publisher') }}" class="btn btn-primary btn-sm">Добавити нового видавця</a>
                                    </div>                                    
                                    @if ($errors->has('publishers[]'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('publishers[]') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="publisher">Джерело:</label>
                                    <select class="form-control" name="sources[]">
                                            @foreach($sources as $source)
                                                <option value="{{$source->id}}">{{$source->title}}</option>
                                            @endforeach
                                    </select>
                                    <div align="right" class="">
                                        <a href="{{ route('Source') }}" class="btn btn-primary btn-sm ">Додати нове джерело</a>
                                    </div>                                    
                                    @if ($errors->has('sources[]'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('sources[]') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group text-left">
                                    <label for="subjects">Дисципліна:</label>
                                    <select class="form-control" name="subjects[]" multiple>
                                    @foreach($subjects as $subject)
                                        <option value="{{$subject->id}}">{{$subject->title}}</option>
                                    @endforeach
                                    </select>                                    
                                    <div align="right" class="">
                                        <a href="{{ route('Subject') }}" class="btn btn-primary btn-sm ">Додати нову дисциплiну</a>
                                    </div>
                                    @if ($errors->has('subjects[]'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('subjects[]') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group tet-left">
                                    <label for="creators">Автор:</label>
                                    <select class="form-control" name="creators[]" multiple>
                                    @foreach($creators as $creator)
                                        <option value="{{$creator->id}}">{{$creator->name}}</option>
                                    @endforeach
                                    </select>
                                    <div align="right" class="">
                                        <a href="{{ route('Creator') }}" class="btn btn-primary btn-sm ">Додати нового автора</a>
                                    </div>                                    
                                    @if ($errors->has('creators[]'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('creators[]') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group text-left">
                                    <label for="contributors">Співавтор:</label>
                                    <select class="form-control" name="contributors[]" multiple>
                                    @foreach($contributors as $contributor)
                                        <option value="{{$contributor->id}}">{{$contributor->name}}</option> 
                                    @endforeach
                                    </select>
                                    <div align="right" class="">
                                        <a href="{{ route('Contributor') }}" class="btn btn-primary btn-sm ">Додати нового спiвавтора</a>
                                    </div>                                   
                                    @if ($errors->has('contributors[]'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('contributors[]') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group text-left">
                                    <label for="link">Вибрати файл:</label>
                                    <input type="file" class="custom-file" name="link">
                                    @if ($errors->has('link'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('link') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <button type="submit" class="btn btn-success btn-lg">Додати</button>
                            </div>
                        </form>                            
                    </div>
                </div>
            </div>
        </div>
    </div>    
            
               
    
@endsection
