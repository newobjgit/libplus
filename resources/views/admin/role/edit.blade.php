@extends('admin.layout.admin')
@section('content')
    <div class="row justify-content-center">                        
            <div class="col-md-8">               
            <div class="panel panel-default">
                <div class="panel-heading clearfix">          
                    <h3 class="panel-title">Редагування ролей</h3>
                </div>
                <div class="panel-body">

    <form action="{{route('role.update',$role->id)}}" method="post" role="form">
        {{method_field('PATCH')}}
        {{csrf_field()}}

        <div class="form-group">
            <label for="name">Назва</label>
            <input type="text" class="form-control" name="display_name" id="" placeholder="Назва ролі" value="{{$role->display_name}}">
        </div>
        <div class="form-group">
            <label for="description">Опис</label>
            <input type="text" class="form-control" name="description" id="" placeholder="Опис ролі" value="{{$role->description}}">
        </div>
        <div class="form-group text-left">
            <h3>Права</h3>
            @foreach($permissions as $permission)
                <input type="checkbox" {{in_array($permission->id,$role_permissions)?"checked":""}}
                name="permission[]" value="{{$permission->id}}" > {{$permission->display_name}} <br>
            @endforeach
        </div>

        <button type="submit" class="btn btn-primary">Зберегти</button>
    </form>
</div>
</div>
</div>
</div>


@endsection