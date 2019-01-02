@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Каталог літератур</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif                      
                    </div>
                    <div class="container">     
                        <ul class="menu">
                            @foreach($menus as $menu)
                                @include('menu.partials.menu', $menu)
                            @endforeach
                        </ul>
                    </div>
            </div>
        </div>
    </div>
</div>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.menu').addClass('active');
            $('.menu li').hide();

        });

    </script>

@endsection
