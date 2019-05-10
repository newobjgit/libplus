@extends('admin.layout.admin')
@section('content')
    <div class="row justify-content-center">                        
            <div class="col-md-8">               
            <div class="panel panel-default">
                <div class="panel-heading clearfix">          
                    <h3 class="panel-title">Всі користувачі</h3>
                </div>
                <div class="panel-body">    <table class="table table-bordered">
        <thead class="thead-light">
        <tr>
            <th>Ім'я</th>
            <th>Пошта</th>
            <th>Роль</th>
            <th>Дата регістрації</th>
            <th>Дії</th>
        </tr>
        </thead>
        @foreach($users as $user)
            <tr>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>

                <td>
                    @foreach($user->roles as $role)
                        {{$role->display_name }}
                    @endforeach
                </td>
                <td>{{$user->created_at}}</td>
                <td>
                    <!-- Button trigger modal -->
                    <a class="btn btn-primary btn-sm" href="{{ route('user.edit', $user->id) }}">
                                    {{ __('Редагувати') }}
                                </a>                    
                    
                </td>
            </tr>
        @endforeach
    </table>
</div>
</div>
</div>
</div>




@endsection