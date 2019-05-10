@extends('admin.layout.admin')
@section('content')
<div class="row justify-content-center">                        
            <div class="col-md-8">               
            <div class="panel panel-default">
                <div class="panel-heading clearfix">          
                    <h3 class="panel-title">Редагування користувача {{$user->name}}</h3>
                </div>
                <div class="panel-body">                   
                        
                            
                                
                                    <form action="{{route('user.update',$user->id)}}" method="post" role="form" id="role-form-{{$user->id}}">
                                        {{csrf_field()}}
                                        {{method_field('PATCH')}}
                                        <div class="form-group">
                                            <select name="roles">
                                                @foreach($roles as $role)
                                                    <option value="{{$role->id}}">{{$role->display_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <button type="submit" class="btn btn-primary">Зберегти</button>

                                    </form>
                                </div>                                
                            </div>
                        </div>                                       
</div>
</div>
</div>


@endsection