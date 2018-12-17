@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Додавання нового документа</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                            <form action="{{route('doc.store')}}" method="post" role="form" enctype="multipart/form-data">
                                {{csrf_field()}}
                                {{method_field('POST')}}
                                <div class="form-group">
                                    <label for="title">Назва:<span>*</span></label>
                                    <input type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title') }}" id="" placeholder="Назва" required>
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
                                    @if ($errors->has('languagesa[]'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('languagesa[]') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="publisher">Видавець:</label>
                                    <select class="form-control" name="publishers[]">
                                        @foreach($publishers as $publisher)
                                                <option value="{{$publisher->id}}">{{$publisher->name}}</option>
                                        @endforeach
                                    </select>
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
                                    @if ($errors->has('sources[]'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('sources[]') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group text-left">
                                    <label for="subjects">Дисципліна:</label>
                                    @foreach($subjects as $subject)
                                        <input type="checkbox" name="subjects[]" value="{{$subject->id}}" > {{$subject->title}}
                                    @endforeach
                                    @if ($errors->has('subjects[]'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('subjects[]') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group text-left">
                                    <label for="creators">Автор:</label>
                                    @foreach($creators as $creator)
                                        <input type="checkbox" name="creators[]" value="{{$creator->id}}" > {{$creator->name}}
                                    @endforeach
                                    @if ($errors->has('creators[]'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('creators[]') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group text-left">
                                    <label for="contributors">Співавтор:</label>
                                    @foreach($contributors as $contributor)
                                        <input type="checkbox" name="contributors[]" value="{{$contributor->id}}" > {{$contributor->name}}
                                    @endforeach
                                    @if ($errors->has('contributors[]'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('contributors[]') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group text-left">
                                    <label for="link">Вибрати файл:</label>
                                    <input type="file" class="custom-file" name="link" required>
                                    @if ($errors->has('link'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('link') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <button type="submit" class="btn btn-primary">Додати</button>

                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
