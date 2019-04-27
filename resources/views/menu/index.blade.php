@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
            @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
            @endif                
                    <div id="tree"></div>            
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
                    enableLinks: true,
                    expandIcon: 'glyphicon glyphicon-chevron-right',
                    collapseIcon: 'glyphicon glyphicon-chevron-down',                                    
                                        
                });
            }   
            });
        }    
});        
</script>   

@endsection
