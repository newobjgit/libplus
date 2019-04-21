@extends('admin.layout.admin')
@section('content')
    <h3>Меню</h3>
    <div class="container">
        <div class="row justify-content-center">
            <div class="row">                
                    <div class="col-md-12">
                    <h4 align="center"><u>Додати новий пункт меню</u></h4> 
                    <form action="{{route('addFormPost')}}" method="post" role="form" >
                    	{{csrf_field()}}
                                {{method_field('POST')}}
      <div class="form-group">
       <label>Виберіть батьківську категорію</label>
       <select name="parent_category" id="parent_category" class="form-control">
       	<option value="0">Головна</option>
       	@foreach($parent_categories as $parent_category)
       		<option value="{{$parent_category['id']}}">{{$parent_category['id']}}.{{$parent_category['title']}}. parent_id - {{$parent_category['parent_id']}}</option>
       	@endforeach
       
       </select>
      </div>
      <div class="form-group">
       <label>Введiть назву</label>
       <input type="text" name="category_name" id="category_name" class="form-control">
      </div>
      <div class="form-group">
       <input type="submit" name="action" id="action" value="Додати" class="btn btn-info" />
      </div>
     </form>
    </div>              
        </div>
    </div> 
    </div>       
@endsection