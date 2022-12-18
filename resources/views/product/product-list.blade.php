@extends('dashboard')
@section('content')

<!-- /.card-header -->
<div class="card-header">
    <button type="button" class="btn btn-info" style="float: right"; onclick="window.location='{{ URL::route('product.add'); }}'" ><i class="fa fa-plus"></i> Add Products </button>
</div>
<div class="card-body">
    <h5> Products Table</h5>
    <?php
    if( 0  != $products->total() ){?>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th style="width: 10px">#</th>
                <th >Product Image </th>
                <th> Product Name </th>
                <th> Product Color </th>
                <th> Product Size </th>
                <th style="width: 170px">Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $i = ($products->perPage() * ($products->currentPage() - 1)) + 1; ?>
            @foreach($products as $product)
 
            <tr>
                <td >{{ $i++ }}</td>
                <td style="width: 10px" > 
                <?php 
                    if( '' == $product->productimage ){?>
                    <img src="{{ asset('images/avatar.png') }}" alt="tag"  height="50" width="50"> 
                <?php }else{ ?>
                    <img src="{{asset('images/').'/'.$product->productimage }}" alt="tag"  height="50" width="50" >
                    <?php     } ?>
                </td>
                <td > {{ $product->productName }} </td>
                <td > {{ $product->colorName }} </td>
                <td > {{ $product->sizeName }} </td>
                 <td>
                    <a class="btn"  title="edit" href="{{ route('product.edit', ['id' => $product->productId]) }}"  ><i class="fas fa-edit"></i></a>
                    <a class="btn" title="view" href="{{ route('product.show', ['id' => $product->productId]) }}" ><i class="fas fa-eye"></i></a>
                    <a class="btn" title="delete" onclick="return confirm('Are you sure to detete Product {{ $product->productName }} ?')"  href="{{ route('product.delete', ['id' => $product->productId]) }}" ><i class="fas fa-times"></i></a>
                </td>
            </tr>

         @endforeach 
        </tbody>
    </table>
</div>
<?php } else{?> 
<img src="{{url('/images/norecordfound.png')}}" class="no-data-found" style="width: 100%;" />
    <?php } ?>
</div>
<!-- /.card-body -->
<div class="card-footer clearfix">
    <ul class="pagination pagination-sm m-0 float-right">
        {!! $products->links('pagination::bootstrap-4') !!}
    </ul>
</div>
@endsection
