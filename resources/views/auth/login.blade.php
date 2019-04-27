@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default justify-content-center">
                <div class="panel-heading clearfix">          
          <h3 class="panel-title">{{ __('Вхід') }}</h3>
        </div>
               

                <div class="panel-body">
                    <form method="POST" action="{{ route('login') }}" class="">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('Електрона пошта:') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <div class="alert alert-danger" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Пароль:') }}</label>

                            <div class="col-md-6 offset-md-4">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <div class="alert alert-danger" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Запам\'ятати') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Здійснити вхід') }}
                                </button>

                                @role('admin')
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Забули свій пароль?') }}
                                </a>
                                @endrole

                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
