@extends('dashboard')
@section('content')

<!-- /.card-header -->
<div class="card-header">
    <button type="button" class="btn btn-info" style="float: right"; onclick="window.location='{{ URL::route('size.add'); }}'" ><i class="fa fa-plus"></i> Add Colors </button>
</div>
<div class="card-body">
    <h5> Size Table</h5>
    <div style=" float: right;margin: 2px 5px 25px;">
        <select name="selectSize" id="selectSize">
            <option value="0">Please Select</option>
            <option value="1">Test 1</option>
            <option value="2">Test 2</option>
            <option value="3">Test 3</option>
        </select>
    </div>
    <div id="demo"> @include('size.size_data') </div>
   
    <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
    <input type="hidden" name="select_type" id="select_type" value="0" />

@endsection
@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>


    <script type="text/javascript">
        $('#selectSize').on('change', function() {
           $('#select_type').val(this.value);
           var page = 1; 
           fetch_data(page);
        });

        $(document).on('click', '.pagination a', function(event){
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            $('#hidden_page').val(page); 
            fetch_data(page);
            
        });
        function fetch_data(page)
        {
            var selectData =  $('#select_type').val(); 
            $.ajax({
                url:"/size/fetch_data?page="+page+"&query="+selectData,
                success:function(data)
                {
                    $('#demo').html('');
                    $('#demo').html(data);
                }
            });
        }

    </script>
@endsection