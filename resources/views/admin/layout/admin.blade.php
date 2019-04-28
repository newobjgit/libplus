<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>Панель адміністратора</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
    <script src="{{ asset('js/bootstrap-treeview.js') }}"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="{{ asset('css/bootstrap-treeview.css') }}" rel="stylesheet">    
    <link rel="stylesheet" href="{{asset('css/admin.css')}}">


</head>
<body>
@include('admin.layout.includes.header')
<div class="page-content">
    @if(Session::has('message'))
        <div class="alert alert-info">
            <p>{{ Session::get('message') }}</p>
        </div>
    @endif
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

<div class="row">
        @include('admin.layout.includes.sidenav')                
               
           <div class="content-box-large">
                        @yield('content')
            </div>         
</div>           
</div>

<script>
    $(document).ready(function () {

        $(".submenu > a").click(function (e) {
            e.preventDefault();
            var $li = $(this).parent("li");
            var $ul = $(this).next("ul");
            if ($li.hasClass("open")) {
                $ul.slideUp(350);
                $li.removeClass("open");
            } else {
                $(".nav > li > ul").slideUp(350);
                $(".nav > li").removeClass("open");
                $ul.slideDown(350);
                $li.addClass("open");
            }
        });        

    });
</script>
@yield('js')
</body>
</html>