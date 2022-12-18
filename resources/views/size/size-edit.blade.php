@extends('dashboard')
@section('content')
<div class="card-header">
    <button type="button" class="btn btn-info" style="float: right"; onclick="window.location='{{ URL::route('size'); }}'" ><i class="fa fa-arrow-left"></i> Back </button>
</div>
<div class="card-body">
   <h5>  Edit Size Page</h5>
</div>
<form action="javascript:void(0)" id="sizeForm" name="sizeForm"  method="post">
    <div class="card-body">
        <div class="form-group">
            <input type="hidden" name="size_id" class="form-control" id="size_id"  value="{{$size->id}}" >
            <label for="color"> Size <span style="color:#ff0000">*</span></label>
                <input type="text" name="size" class="form-control" id="size" placeholder="Enter Size" value="{{$size->name}}" >
            <div class="error" id="sizerErr"></div>
        </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <button type="submit" class="sizeForm-edit btn btn-submit btn-primary" id="sizeForm-edit">Save</button>
    </div>
</form>
                                          
<div style="display: none;" class="pop-outer">
    <div class="pop-inner">
        <h2 class="pop-heading">Size Updated Successfully</h2>
    </div>
</div> 
@endsection
@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

    <script type="text/javascript">  
        $( function() {     
            $('#size').on('input', function() {
                $('#sizeErr').hide();
            });
        });

        $(document).on('click', '.sizeForm-edit', function (e) {
        
        $('#size').on('input', function() {
            $('#sizeErr').hide();
        });
       
        var sizeFlag  = 0;
        var size     = $("#size").val();
        var id        = $("#size_id").val();
    
        if(size == "") {
            $("#sizeErr").html("Please Enter Size");
            sizeFlag = 1;
        }
        
        if( 1 == sizeFlag ){
            return false;
        }else{
           
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url:"{{ route('size.update') }}",
                type: "POST",
                dataType: "json",
                data:{ 
                    id :id,
                    size:size,
                },
                success:function(data){
                    if( data.status == 'success' ){
                        $(".pop-outer").fadeIn("slow");
                        setTimeout(function () {
                            window.location = '{{ route('size') }}'
                        }, 2500);
                    }else{
                        $("#colorErr").html("Data Not Saved ! Please check Data");
                    }
                    
                },
                error: function(response) {
                    
                }
                 
            });
        }
    });
       

</script>
@endsection