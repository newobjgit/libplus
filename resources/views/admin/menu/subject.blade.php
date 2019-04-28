@extends('admin.layout.admin')
@section('content')   
    <div class="container">
        <div class="row justify-content-center">                        
            <div class="col-md-8">
                    <div class="panel panel-default">
                    <div class="panel-heading clearfix">          
                        <h3 class="panel-title">Прив'язка дисципліни до пункту меню</h3>
                    </div>
                    <div class="panel-body">


                  <div class="">
                    <div id="tree">
                   </div>

                    <div class="">
                      <form action="{{route('subjectFormPost')}}" method="post" role="form" >
                        {{csrf_field()}}
                        {{method_field('POST')}}
                      <div class="form-group">
                        <label>Батківська категорія:</label>
                        <input type="text" name="parent_name" id="parent_name" class="form-control" required readonly="">
                        <input type="hidden" name="parent_id" id="parent_id">
                      </div>                      
                      <div class="form-group">
                        <label>Виберіть дисципліну</label>
                        <select class="form-control" name="subject" required="">
                        @foreach($subjects as $subject)
                           <option value="{{$subject->id}}">{{$subject->title}}</option>
                                        @endforeach
                        </select>                          
                      </div>
                      <div class="form-group">
                      <input type="submit" name="action" id="action" value="Додати" class="btn btn-info" />
                      </div>
                  </form>
                    </div>
                       
                      
                </div> 
              </div>        
        </div>     
      </div>
    </div> 
    <script type="text/javascript">
    $(document).ready(function(){ 

        fill_treeview();

        function fill_treeview()
        {
            $.ajax({
           headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, 
           url: "{{ url('/') }}",
           method:"POST",
           dataType: "json",       
           success: function(data) 
            {    
                $('#tree').treeview({
                    data:data,
                    color: "#428bca",
                    levels: 0,                    
                    expandIcon: 'glyphicon glyphicon-chevron-right',
                    collapseIcon: 'glyphicon glyphicon-chevron-down',
                    multiSelect: $('#chk-select-multi').is(':checked'),
                    onNodeSelected: function(event, node) {                                      
                    $("#parent_name").val(node.name);
                    $("#parent_id").val(node.id);
                        },  

                                        
                });
            }   
            });
        }    
});        
</script>      
@endsection