@extends('master')

@section('title', 'Assign Coupon')
@section('dashboard-title', 'Assign Coupon')
@section('breadcrumb-title', 'Assign Coupon')

@section('stylesheet')
    <!-- <link href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@8.10.0/dist/sweetalert2.css" rel="stylesheet"> -->
@endsection

@section('container')
 <section class="content">
      <div class="container-fluid">
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Assign Coupon</h3>

            <a class="float-right btn btn-success" href="{{route('vbr.list')}}"> <i class="fas fa-list mr-2"></i>VBR List </a>
          </div>
          <form action="" method="POST">
                <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                    <label>VBR Name</label>
                    <select class="form-control">
                        <option selected="">----Please select VBR name----</option>

                        @foreach ($vbrList as $vbr)
                            <option value="{{ $vbr->id }}">{{  $vbr->name }}</option>
                        @endforeach

                    </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Assign Coupons</label>
                        <select class="form-control">
                        <option selected="">----Please select coupon----</option>
                        @foreach ($couponList as $couponRow)
                            <option value="{{ $couponRow->coupon }}">{{  $couponRow->coupon }}</option>
                        @endforeach
                        </select>
                    </div>
                </div>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn" style="background: #e83e8c; color: white">Assigned</button>
            </div>
          </form>
        </div>
      </div><!-- /.container-fluid -->
    </section>
@endsection

@section('custom_script')


@endsection
