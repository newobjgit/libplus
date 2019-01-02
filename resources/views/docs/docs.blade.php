@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ $subject->title}}</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif                      
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Назва</th>
                                    <th scope="col">Автор</th>
                                    <th scope="col">Рiк видання</th>
                                    <th scope="col">Формат</th>
                                    <th scope="col">Дата додавання</th>
                                    <th scope="col">Перейти</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($books as $book)
                                <tr>
                                    <th scope="col">{{ $book->title }}</th>
                                    <th scope="col">
                                        @foreach($book->creators()->pluck('name')->all() as $creator)
                                         {{ $creator.', ' }}
                                        @endforeach
                                            </th>
                                    <th scope="col">{{ $book->year }}</th>
                                    <th scope="col">{{ $book->format()->first()->filesize.', ' .$book->format()->first()->ext }}</th>
                                    <th scope="col">{{ $book->created_at }}</th>
                                    <th scope="col">
                                        <a href="{{ route('doc.show',$book->id) }}" class="btn btn-link">Перейти</a>
                                    </th>
                                </tr>                                
                                @endforeach
                            </tbody>
                            </table>                          
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection