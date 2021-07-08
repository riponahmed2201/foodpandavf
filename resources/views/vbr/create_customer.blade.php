@extends('master')

@section('title', 'Create Customer')
@section('dashboard-title', 'Create Customer')
@section('breadcrumb-title', 'Create Customer')

@section('stylesheets')
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
@endsection

@section('container')
<section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header bg-gray-light">
                  <h3 class="card-title">Customer Create</h3>
                  <a href="{{route('mycustomer')}}" class="float-right btn btn-success" style="margin-right: 1rem;"> <i class="fas fa-list mr-2"></i> Customer List</a>
                </div>
                <div class="col-md-8 offset-2 mt-2">
                  @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block text-center">
                      <button type="button" class="close" data-dismiss="alert">×</button>
                      <strong class="text-center">{{ $message }}</strong>
                    </div>
                  @endif

                  @if ($message = Session::get('danger'))
                    <div class="alert alert-danger alert-block text-center">
                      <button type="button" class="close" data-dismiss="alert">×</button>
                      <strong>{{ $message }}</strong>
                    </div>
                  @endif
                </div>

                <form action="{{route('add.customer')}}" method="POST">
                  @csrf
                  <div class="card-body">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Name<span style="color: red;" class="required">*</span></label>
                            <input type="text" name="name" value="{{old('name')}}" class="form-control" placeholder="Enter name">
                            @if($errors->has('name'))
                              <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                          </div>
                        </div>
          
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Email<span style="color: red;" class="required">*</span></label>
                            <input type="email" name="email" value="{{old('email')}}" class="form-control" placeholder="Enter email">
                            @if($errors->has('email'))
                              <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Mobile<span style="color: red;" class="required">*</span></label>
                            <input type="number" name="mobile" value="{{old('mobile')}}" class="form-control" placeholder="Enter mobile">
                            @if($errors->has('mobile'))
                              <span class="text-danger">{{ $errors->first('mobile') }}</span>
                            @endif
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Date Of Birth</label>
                            <input type="date" name="date_of_birth" id="date_of_birth" class="form-control" value="{{old('date_of_birth')}}" placeholder="Enter Date Of Birth">
                            @if($errors->has('date_of_birth'))
                              <span class="text-danger">{{ $errors->first('date_of_birth') }}</span>
                            @endif
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Location</label>
                            <input type="text" name="location" value="{{old('location')}}" class="form-control" placeholder="Enter Location">
                            @if($errors->has('location'))
                              <span class="text-danger">{{ $errors->first('location') }}</span>
                            @endif
                          </div>
                        </div>
                    </div>
                    <div class="card-footer">
                      <button data-toggle="modal" data-target="#exampleModalCenter" type="submit" class="btn btn-primary float-right">Submit</button>
                      </div>
                </div>
              </form>
            </div>

             <!-- modal -->
            <!--  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-body">
                      <h3>Customer registered successfully!</h3>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div> -->
              <!-- modal -->


            <!-- /.col -->
          </div>
        </div><!-- /.container-fluid -->
      </section>
@endsection

@section('custom_script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
 
<script>
    $(function() {
       $('.select2bs4').select2({
          theme: 'bootstrap4'
        });
    });
</script>

@endsection