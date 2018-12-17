@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ $title }} </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    <th scope="col">Назва</th>
                                    <th scope="col">{{ $title }}</th>
                                </tr>
                                <tr>
                                    <th scope="col">Дисципліна</th>
                                    <th scope="col">
                                        @if($count_subjects > 1)
                                            @foreach($subjects as $key => $subject)
                                                @if($key == ($count_subjects - 1))
                                                    {{$subject.'.'}}
                                                @else
                                                    {{$subject.', '}}
                                                @endif
                                            @endforeach
                                        @elseif ($count_subjects == 1)
                                            {{ $subjects[0] }}
                                        @endif
                                    </th>
                                </tr>
                                <tr>
                                    <th scope="col">Автор</th>
                                    <th scope="col">
                                        @if($count_creators > 1)
                                            @foreach($creators as $key => $creator)
                                                @if($key == ($count_creators - 1))
                                                    {{$creator.'.'}}
                                                @else
                                                    {{$creator.', '}}
                                                @endif
                                            @endforeach
                                        @elseif ($count_creators == 1)
                                        {{ $creators[0] }}
                                        @endif
                                    </th>
                                </tr>
                                <tr>
                                    <th scope="col">Опис</th>
                                    <th scope="col">{{ $description }}</th>
                                </tr>
                                <tr>
                                    <th scope="col">Видавець</th>
                                    <th scope="col">{{ $publisher }}</th>
                                </tr>
                                <tr>
                                    <th scope="col">Співавтор</th>
                                    <th scope="col">
                                        @if($count_contributors > 1)
                                            @foreach($contributors as $key => $contributor)
                                                @if($key == ($count_contributors - 1))
                                                    {{$contributor.'.'}}
                                                @else
                                                    {{$contributor.', '}}
                                                @endif
                                            @endforeach
                                        @elseif ($count_contributors == 1)
                                        {{ $contributors[0] }}
                                        @endif
                                    </th>
                                </tr>
                                <tr>
                                    <th scope="col">Рік видання</th>
                                    <th scope="col">{{ $date }}</th>
                                </tr>

                                <tr>
                                    <th scope="col">Файл</th>
                                    <th scope="col">{{$format->ext.', '.$format->filesize}} @role('admin') {{' ,'.$format->link}} @endrole</th>
                                </tr>
                                <tr>
                                    <th scope="col">Мова</th>
                                    <th scope="col">{{ $language }}</th>
                                </tr>
                                <tr>
                                    <th scope="col">Джерело</th>
                                    <th scope="col"><a href="http://{{ $source }}">{{ $source }}</a></th>
                                </tr>
                                <tr>
                                    <th scope="col">Дії</th>
                                    <th scope="col">
                                        <form action="{{route('downloadFile')}}" method="post">
                                        {{csrf_field()}}
                                        <input type="hidden" name="link" value="{{$link}}">
                                        <button type="submit" class="btn btn-success btn-sm">Скачати</button>
                                        </form>
                                    </th>
                                </tr>
                                @permission('edit-book')
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">
                                        <a class="btn btn-primary btn-sm" href="{{ route('doc.edit',$id) }}">Редагувати</a>
                                    </th>
                                </tr>
                                @endpermission
                                @permission('delete-book')
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">
                                <form action="{{route('doc.destroy',$id)}}" method="post">
                                    {{csrf_field()}}
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-danger btn-sm">Видалити</button>
                                </form>
                                    </th>
                                @endpermission
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
