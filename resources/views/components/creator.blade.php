@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Додавання автора</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="table-responsive">
                        <form action="{{route('addCreator')}}" method="POST" role="form">
                                {{csrf_field()}}
                                {{method_field('POST')}}
                            <div class="form-group"><input class="form-control" type="text" name="title" required></div>
                            <div class="form-group"><button type="submit" class="btn btn-primary">Додати</button></div>
                        </form>                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
