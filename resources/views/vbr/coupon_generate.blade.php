@extends('master')

@section('title', 'Customer Create')
@section('dashboard-title', 'Customer Create')
@section('breadcrumb-title', 'Customer Create')

@section('stylesheet')
    <!-- <link href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@8.10.0/dist/sweetalert2.css" rel="stylesheet"> -->
@endsection

@section('container')
<section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header" style="background: #D70F64; color: white">
                  <h3 class="card-title">Customer Create</h3>
                  <a href="{{route('mycustomer')}}" class="float-right btn" style="margin-right: 1rem; background: #D70F64; color: white"> <i class="fas fa-list mr-2"></i> Customer List</a>
                </div>
                <div class="col-md-8 offset-2 mt-2">
                  @if ($message = Session::get('success'))
                    <div class="alert alert-block text-center" style="background: #D70F64; color: white">
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
                    </div>
                    <div class="card-footer">
                      <button type="submit" class="btn float-right" style="background: #D70F64; color: white">Submit</button>
                      </div>
                </div>
              </form>
            </div>
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
