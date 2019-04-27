<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->    
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/jquery-3.3.1.js') }}"></script>    
    <script src="{{ asset('js/bootstrap-treeview.js') }}"></script>
    <script src="{{ asset('js/bootstrap-select.js') }}"></script>           

    <!-- Styles -->
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="{{ asset('css/bootstrap-treeview.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-select.css') }}" rel="stylesheet"> 
      
    
              
    
           
    <!-- Icons -->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">          
        
</style>   
    
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">          
          <a class="navbar-brand" href="{{ route('index') }}">{{ config('app.name', 'Laravel') }}</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">            
                        
          </ul>          
          <ul class="nav navbar-nav navbar-right">
            @permission('add-book')
                <li>                                
                    <a href="{{ route('create') }}">Додати новий документ</a>
                </li>
            @endpermission            
            @guest
                <li>
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Вхід') }}</a>
                 </li>                
            @else
                @role('admin')

                            <li>
                                <a class="nav-link" href="{{ route('admin') }}">{{ __('Панель адміністратора') }}</a>
                            </li>

                @endrole
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Вихід') }}</a></li>
                <li><form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form></li>                
              </ul>
            </li>
            @endguest
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
</nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

</body>
<script type="text/javascript">
{               
            $(function () {

                $("#link").hide();
                $('select').selectpicker(
                    {
                        noneSelectedText: "Виберіть зі списку",
                                                
                    });                
            });

            $(function () {
                $("#filebool").click(function () {
                    if ($(this).is(":checked")) {                
                        $("#link").show();
                    } else {
                        $("#link").hide();                
                }
        });
    });
            
}
</script>
</html>
