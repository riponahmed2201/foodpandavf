@extends('master')

@section('title', 'Create Vbr')
@section('dashboard-title', 'Create Vbr')
@section('breadcrumb-title', 'Create Vbr')

@section('stylesheet')
    <!-- <link href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@8.10.0/dist/sweetalert2.css" rel="stylesheet"> -->
@endsection

@section('container')
 <section class="content">
      <div class="container-fluid">
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Create VBR</h3>

            <a class="float-right btn btn-success" href="{{route('vbr.list')}}"> <i class="fas fa-list mr-2"></i>VBR List </a>
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
          <!-- /.card-header -->
          <form action="{{route('add.vbr')}}" method="POST">
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
                    <label>Phone<span style="color: red;" class="required">*</span></label>
                    <input type="number" name="mobile" value="{{old('mobile')}}" class="form-control" placeholder="Enter phone">
                    @if($errors->has('mobile'))
                      <span class="text-danger">{{ $errors->first('mobile') }}</span>
                    @endif
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Password<span style="color: red;" class="required">*</span></label>
                    <input type="password" name="password" class="form-control" placeholder="Enter password">
                  </div>
                </div>
              </div>
              <div class="card-footer">
                 <button type="submit" class="btn btn-primary float-right">Submit</button>
              </div>
            </div>
          </form>
          <!-- /.card-body -->
        </div>
      </div><!-- /.container-fluid -->
    </section>
@endsection

@section('custom_script')


@endsection