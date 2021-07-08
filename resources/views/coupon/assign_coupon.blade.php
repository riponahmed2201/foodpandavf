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
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>VBR Name</label>
                  <select class="form-control">
                    <option selected="">Select VBR..</option>
                    <option value="1">Imran</option>
                    <option value="2">Lisa</option>
                    <option value="3">Lima</option>
                    <option value="1">Morjina</option>
                    <option value="2">Raihan</option>
                  </select>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                    <label>Assign Coupons</label>
                    <select class="form-control">
                      <option selected="">Select Coupon..</option>
                      <option value="1">BSH@KSS0171</option>
                      <option value="2">BSH@KSS01344</option>
                      <option value="3">MdH@KSS0171</option>
                      <option value="1">PSSH@KSS0171</option>
                      <option value="2">ASSH@KSS0171</option>
                    </select>
                  </div>
              </div>
            </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
          <button type="submit" class="btn btn-success">Assigned</button>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
@endsection

@section('custom_script')


@endsection