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
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal-{{$user->id}}">
                        Редагувати
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="myModal-1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                                aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">{{$user->name}}</h4>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('user.update',$user->id)}}" method="post" role="form" id="role-form-{{$user->id}}">
                                        {{csrf_field()}}
                                        {{method_field('PATCH')}}
                                        <div class="form-group">
                                            <select name="roles[]" multiple>
                                                @foreach($roles as $role)
                                                    <option value="{{$role->id}}">{{$role->display_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        {{--<button type="submit" class="btn btn-primary">Submit</button>--}}
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрити</button>
                                    <button type="submit" class="btn btn-primary" onclick="$('#role-form-{{$user->id}}').submit()">Зберегти</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
    </table>
</div>
</div>
</div>
</div>




@endsection