@extends('dashboard')
@section('content')

<div class="card-header">
    <button type="button" class="btn btn-info" style="float: right"; onclick="window.location='{{ URL::route('color'); }}'" ><i class="fa fa-arrow-left"></i> Back </button>
</div>
<div class="card-body">
   <h5>  Details Colors Page</h5>
</div>
<form action="javascript:void(0)" id="colorForm" name="colorForm"  method="post">
    
    <div class="card-body">
        <div class="form-group">
            <label for="color"> Color <span style="color:#ff0000">*</span></label>
                <input type="text" name="color" class="form-control" id="color" placeholder="Enter Color" value="{{$color->name}}" readonly>
            <div class="error" id="colorErr"></div>
        </div>
    </div>
    <!-- /.card-body -->
</form>
@endsection