@extends('layout')
@section('content')

<div class="container">
     <section class="content" style="margin-top: 20px;">
            <div class="container-fluid">
                <div class="row"><nav class="navbar navbar-expand-sm bg-light">

  <!-- Links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" href="#">Link 1</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">Link 2</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">Link 3</a>
    </li>
  </ul>

</nav>
                    <div class="col-md-12">
                      
                        <div class="card card-primary">
                            
                            <form action="javascript:void(0)" id="productAddForm" name="productAddForm"  method="post">
                                <div class="card-body">

                                    <div class="form-group">
                                        <label for="productName">Product Name <span style="color:#ff0000">*</span></label>
                                        <input type="text" name="productName" class="form-control" id="productName" placeholder="Enter Product Name">
                                        <div class="error" id="productNameErr"></div>
                                    </div>

                                    <div class="form-group">
                                        <label for="dob"> Date Of Birth <span style="color:#ff0000">*</span> </label>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                </div>
                                                <input type="text" class="form-control datetimepicker-input"  id="dob" name="dob" placeholder="Enter Date Of Birth " />
                                            </div>
                                            <div class="error" id="dobErr"></div>
                                        </div>
                                    </div>

                                    

                                    
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="students-add btn btn-submit btn-primary" id="students-add">Save</button>
                                </div>
                            </form>
                                          
                            <div style="display: none;" class="pop-outer">
                                <div class="pop-inner"
                                >
                                    <h2 class="pop-heading">Students Added Successfully</h2>
                                </div>
                            </div>

                        </div>
                    </div>    
                </div>
            </div>
        </section>    
</div>
@endsection