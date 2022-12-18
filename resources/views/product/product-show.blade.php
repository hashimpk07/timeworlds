@extends('dashboard')
@section('content')

<div class="card-header">
    <button type="button" class="btn btn-info" style="float: right"; onclick="window.location='{{ URL::route('product'); }}'" ><i class="fa fa-arrow-left"></i> Back </button>
</div>
<div class="card-body">
   <h5>  Product Details  Page</h5>
</div>

<form action="javascript:void(0)" id="productEditForm" name="productEditForm"  enctype="multipart/form-data">

    <div class="card-body">
        <div class="form-group">
            <label for="color"> Product Name <span style="color:#ff0000">*</span></label>
                <input type="text" name="productName" class="form-control" id="productName" placeholder="Enter Product" value="{{$products->productName}}" readonly>
            <div class="error" id="productNameErr"></div>
        </div>

        <div class="form-group">
            <label for="productSize"> Product Sizes <span style="color:#ff0000">*</span> </label>
            <div class="form-group">
                <div class="input-group">
                <select class="form-control" id="productSize" name="productSize" disabled > 
                    <option value="0">Select Size</option>
                    @foreach ($sizes as $size)
                    <option value="{{ $size->id }}" {{ ( $size->id == $products->productSizeId) ? 'selected' : '' }}>{{ $size->name }}</option>
                    @endforeach  
                </select>
                </div>
                <div class="error" id="productSizeErr"></div>
            </div>
        </div>

        <div class="form-group">
            <label for="productColors"> Product Colors  <span style="color:#ff0000">*</span></label>
            <div class="form-group">
                <div class="input-group">
                <?php   $prodColor = explode(",",$products->colorId)   ?>
                <select class="selectpicker" multiple data-live-search="true" name="productColors[]" id="productColors" disabled>
                    @foreach ($colors as $color)
                    <option value="{{ $color->id }}" {{ (  in_array($color->id, $prodColor) )  ? 'selected' : '' }}> {{ $color->name }}</option>
                    @endforeach                   
                </select>
                <div class="error" id="productColorsErr"></div>
                </div>
            </div>
        </div>


        <div class="form-group">
            <label for="member_input_image"> Product Image <span style="color:#ff0000">*</span> </label>
            <div class="form-group" id="product_image_div" >
                <?php if( '' != $products->productimage ){?>
                <div class="input-group">
                    <img id="product_image" name="product_image" src="{{ asset('images/').'/'.$products->productimage }}" alt="your image" />
                </div>
                <?php }else{ ?>
                <div class="input-group">
                    <img id="product_image" name="product_image" src="" alt="your image" />
                </div>
                <?php } ?>
            </div>
            
        </div>

         <div class="form-group">
            <label for="mobileNumber"> Product Description  </label>
            <div class="form-group">
                <div class="input-group">
                    <textarea  type="textarea" name="description" class="form-control" id="description" placeholder="Description"  rows="4" cols="50" readonly>{{ $products->productdescription }}</textarea>
                </div>
        </div>


    <!-- /.card-body -->
   
</form>
                                          

@endsection
@section('scripts')
   
@endsection