   
    <?php
    if( 0  != $sizes->total() ){?>

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
            $i = ($sizes->perPage() * ($sizes->currentPage() - 1)) + 1; ?>
            @foreach($sizes as $size)
            <tr>
                <td >{{ $i++ }}</td>
                <td > {{ $size->name }} </td>
                <td>
                    <a class="btn"  title="edit" href="{{ route('size.edit', ['id' => $size->id]) }}"  ><i class="fas fa-edit"></i></a>
                    <a class="btn" title="view" href="{{ route('size.show', ['id' => $size->id]) }}" ><i class="fas fa-eye"></i></a>
                    <a class="btn" title="delete" onclick="return confirm('Are you sure to detete plan {{ $size->name }} ?')"  href="{{ route('size.delete', ['id' => $size->id]) }}" ><i class="fas fa-times"></i></a>
                </td>
            </tr>
            @endforeach 
        </tbody> 
    </table>

<?php } else{?> 
<img src="{{url('/images/norecordfound.png')}}" class="no-data-found" style="width: 100%;" />
    <?php } ?>

<!-- /.card-body -->
<div class="card-footer clearfix">
    <ul class="pagination pagination-sm m-0 float-right">
        {!! $sizes->links('pagination::bootstrap-4') !!}
    </ul>
</div>
</div>