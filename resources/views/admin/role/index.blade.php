@extends('admin.layout.admin')
@section('content')    
    <div class="row justify-content-center">                        
            <div class="col-md-8">               
            <div class="panel panel-default">
                <div class="panel-heading clearfix">          
                    <h3 class="panel-title">Ролі</h3>
                </div>
                <div class="panel-body">
    <table class="table table-bordered">
        <thead class="thead-light">
        <tr>
            <th>Назва</th>
            <th>Опис</th>
            <th>Права</th>
            <th>Дії</th>
        </tr>
        </thead>
        @foreach($roles as $role)
            <tr>
                <td>{{$role->display_name}}</td>
                <td>{{$role->description}}</td>
                <td>
                    @foreach($role->permissions as $permission)
                        {{$permission->display_name }}
                    @endforeach
                </td>
                <td>
                    <a class="btn btn-primary btn-sm" href="{{route('role.edit',$role->id)}}">Редагувати</a>
                </td>
            </tr>
        @endforeach

    </table>
</div>
</div>
</div>
</div>
@endsection