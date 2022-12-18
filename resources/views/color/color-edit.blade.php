@extends('dashboard')
@section('content')
<div class="card-header">
    <button type="button" class="btn btn-info" style="float: right"; onclick="window.location='{{ URL::route('color'); }}'" ><i class="fa fa-arrow-left"></i> Back </button>
</div>
<div class="card-body">
   <h5>  Edit Colors Page</h5>
</div>
<form action="javascript:void(0)" id="colorForm" name="colorForm"  method="post">
    <div class="card-body">
        <div class="form-group">
            <input type="hidden" name="color_id" class="form-control" id="color_id"  value="{{$color->id}}" >
            <label for="color"> Color <span style="color:#ff0000">*</span></label>
                <input type="text" name="color" class="form-control" id="color" placeholder="Enter Color" value="{{$color->name}}" >
            <div class="error" id="colorErr"></div>
        </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <button type="submit" class="colorForm-edit btn btn-submit btn-primary" id="colorForm-edit">Save</button>
    </div>
</form>
                                          
<div style="display: none;" class="pop-outer">
    <div class="pop-inner">
        <h2 class="pop-heading">Color Updated Successfully</h2>
    </div>
</div> 
@endsection
@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

    <script type="text/javascript">  
        $( function() {     
            $('#color').on('input', function() {
                $('#colorErr').hide();
            });
        });

        $(document).on('click', '.colorForm-edit', function (e) {
        
        $('#color').on('input', function() {
            $('#colorErr').hide();
        });
       
        var colorFlag  = 0;
        var color     = $("#color").val();
        var id        = $("#color_id").val();
    
        if(color == "") {
            $("#colorErr").html("Please Enter Color");
            colorFlag = 1;
        }
        
        if( 1 == colorFlag ){
            return false;
        }else{
           
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url:"{{ route('color.update') }}",
                type: "POST",
                dataType: "json",
                data:{ 
                    id :id,
                    color:color,
                },
                success:function(data){
                    if( data.status == 'success' ){
                        $(".pop-outer").fadeIn("slow");
                        setTimeout(function () {
                            window.location = '{{ route('color') }}'
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