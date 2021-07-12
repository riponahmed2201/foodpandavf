@extends('master')

@section('title', 'Password Change')
@section('dashboard-title', 'Password Change')
@section('breadcrumb-title', 'Password Change')

@section('container')
    <section class="content">
        <div class="container-fluid">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Password Change</h3>
                </div>
                <div class="col-md-8 offset-2 mt-2">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-block text-center" style="background: #e83e8c; color: white">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong class="text-center">{{ $message }}</strong>
                        </div>
                    @endif

                    @if ($message = Session::get('failed'))
                        <div class="alert alert-danger alert-block text-center">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                </div>
                <!-- /.card-header -->
                <form action="{{route('adminPasswordChangeCheck')}}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <div class="">
                                    <div class="form-group">
                                        <label>Old Password<span style="color: red;" class="required">*</span></label>
                                        <input type="password" name="old_password" required value="{{old('old_password')}}" class="form-control" placeholder="Enter old password">
                                        @if($errors->has('old_password'))
                                            <span class="text-danger">{{ $errors->first('old_password') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="">
                                    <div class="form-group">
                                        <label>New Password<span style="color: red;" class="required">*</span></label>
                                        <input type="password" required name="password" value="{{old('new_password')}}" class="form-control" placeholder="Enter new password">
                                        @if($errors->has('new_password'))
                                            <span class="text-danger">{{ $errors->first('new_password') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="">
                                    <div class="form-group">
                                        <label>Confirm Password<span style="color: red;" class="required">*</span></label>
                                        <input type="password" required name="password_confirmation" value="{{old('password_confirmation')}}" class="form-control" placeholder="Enter confirm password">
                                        @if($errors->has('password_confirmation'))
                                            <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" style="background: #e83e8c; color: white" class="btn float-right">Submit</button>
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
