@extends('dashboard')
@section('content')

<!-- /.card-header -->
<div class="card-header">
    <button type="button" class="btn btn-info" style="float: right"; onclick="window.location='{{ URL::route('color.add'); }}'" ><i class="fa fa-plus"></i> Add Colors </button>
</div>
<div class="card-body">
    <h5> Colors Table</h5>
    <?php
    if( 0  != $colors->total() ){?>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th style="width: 10px">#</th>
                <th style="width: 250px">Name</th>
                <th style="width: 30px">Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $i = ($colors->perPage() * ($colors->currentPage() - 1)) + 1; ?>
            @foreach($colors as $color)
            <tr>
                <td >{{ $i++ }}</td>
                <td > {{ $color->name }} </td>
                <td>
                    <a class="btn"  title="edit" href="{{ route('color.edit', ['id' => $color->id]) }}"  ><i class="fas fa-edit"></i></a>
                    <a class="btn" title="view" href="{{ route('color.show', ['id' => $color->id]) }}" ><i class="fas fa-eye"></i></a>
                    <a class="btn" title="delete" onclick="return confirm('Are you sure to detete plan {{ $color->name }} ?')"  href="{{ route('color.delete', ['id' => $color->id]) }}" ><i class="fas fa-times"></i></a>
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
        {!! $colors->links('pagination::bootstrap-4') !!}
    </ul>
</div>
@endsection
