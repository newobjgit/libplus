@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"></div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif                      
                    </div>
                    <div class="container">     
                        <ul class="list-group">
                            @foreach($subjects as $subject)
                                <div>
                                    <li class="list-group-item list-group-item-action">
                                    <a href="{{ route('filterBook',$subject->id) }}">{{$subject->title}}</a></li>
                                </div>                                
                            @endforeach
                        </ul>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
