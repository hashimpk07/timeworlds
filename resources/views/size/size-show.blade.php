@extends('dashboard')
@section('content')

<div class="card-header">
    <button type="button" class="btn btn-info" style="float: right"; onclick="window.location='{{ URL::route('size'); }}'" ><i class="fa fa-arrow-left"></i> Back </button>
</div>
<div class="card-body">
   <h5>  Details Size Page</h5>
</div>
<form action="javascript:void(0)" id="sizeForm" name="sizeForm"  method="post">
    
    <div class="card-body">
        <div class="form-group">
            <label for="color"> Size <span style="color:#ff0000">*</span></label>
                <input type="text" name="size" class="form-control" id="size" placeholder="Enter Color" value="{{$size->name}}" readonly>
            <div class="error" id="sizeErr"></div>
        </div>
    </div>
    <!-- /.card-body -->
</form>
@endsection