@extends('master')

@section('title', 'Coupon List')
@section('dashboard-title', 'Coupon List')
@section('breadcrumb-title', 'Coupon List Information')

@section('stylesheet')
    <!-- <link href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@8.10.0/dist/sweetalert2.css" rel="stylesheet"> -->
@endsection

@section('container')
 <section class="content">
      <div class="container-fluid">
        <div class="card">
          <div class="card-header" style="background: #D70F64; color: white">
            <h3 class="card-title">Filter</h3>
          </div>

          <div class="card-body">
            <form role="form" action="{{ route('coupon.list') }}" method="post">
                @csrf
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>&nbsp;&nbsp; Coupon Code</label>
                    <div class="col-md-12 col-sm-12">
                      <select name="coupon_code" class="form-control">
                        <option value="-1">----select Coupon Code----</option>
                        @foreach ($couponDataList as $couponRow)
                            <option value="{{ $couponRow->coupon }}">{{  $couponRow->coupon }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>&nbsp;&nbsp; Status</label>
                    <div class="col-md-12 col-sm-12">
                      <select  name="coupon_status" class="form-control">
                        <option value="-1">----select status----</option>
                        <option value="1">Used</option>
                        <option value="0">Not Used</option>
                        <option value="2">Taken</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-sm-6">
                  <div class="form-group">
                    <label>&nbsp;&nbsp; VBR Name</label>
                    <div class="col-md-12 col-sm-12">
                      <select name="vbr_name" class="form-control">
                        <option value="-1 ">----select vbr name----</option>
                        @foreach ($vbrDataList as $vbr)
                            <option value="{{ $vbr->name }}">{{  $vbr->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-sm-6">
                  <div class="form-group">
                    <label>&nbsp;&nbsp; Date</label>
                    <div class="col-md-12 col-sm-12">
                      <input type="date" name="entry_date"  type="date" class="form-control">
                    </div>
                  </div>
                </div>

              </div>
          </div>
          <div class="card-footer">
            <button type="submit" id="generate" class="btn" style="background: #D70F64; color: white">Generate</button>
          </div>
        </form>
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

        <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header bg-gray-light">
                  <h3 class="card-title">All Coupons</h3>

                  <a class="float-right btn" style="margin-right: 1rem; background: #D70F64; color: white"  data-toggle="modal" data-target="#changeStatusModal"> <i class="fas fa-plus-circle mr-2"></i>Change Status</a>

                  <a class="float-right btn" style="margin-right: 1rem; background: #D70F64; color: white" data-toggle="modal" data-target="#exampleModalCenter"> <i class="fas fa-plus-circle mr-2"></i>Upload Coupon</a>

                </div>
                <!-- /.card-header -->

                <!-- modal -->
                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLongTitle">Upload CSV File</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                        </div>

                        <div class="modal-body">
                            <form action="{{route('coupon.excel.upload')}}" method="post" enctype="multipart/form-data">
                              @csrf
                              <div class="custom-file">
                                <input type="file" name="file" class="form-control-file" id="inputGroupFile01">
                                {{-- <label class="custom-file-label" for="inputGroupFile01">Choose file</label> --}}
                              </div>
                              <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn" style="background: #D70F64; color: white">Upload</button>
                              </div>
                            </form>
                          </div>

                      </div>
                    </div>
                  </div>

                  <!-- modal -->
                <div class="modal fade" id="changeStatusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLongTitle">Upload CSV File with updated Status</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                        </div>

                        <div class="modal-body">
                            <form action="{{route('changeCouponStatusBatchUpload')}}" method="post" enctype="multipart/form-data">
                              @csrf
                              <div class="custom-file">
                                <input type="file" name="file" class="custom-file-input" id="inputGroupFile01">
                                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                              </div>
                              <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn" style="background: #D70F64; color: white">Upload</button>
                              </div>
                            </form>
                          </div>

                      </div>
                    </div>
                  </div>

                  <!-- modal -->
                <div class="card-body">
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                      <th>#</th>
                      <th>Coupon Code</th>
                      <th>Status</th>
                      <th>VBR Name</th>
                      <th>Date</th>
                    </tr>
                    </thead>
                    <tbody>

                        @foreach ($couponList as $coupon)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $coupon->coupon }}</td>
                                <td>
                                    @if ($coupon->status == 0)
                                        <span class="badge badge-danger">Not Used</span>
                                    @elseif ($coupon->status == 2)
                                        <span class="badge badge-warning">Taken</span>
                                    @else
                                        <span class="badge badge-success">Used</span>
                                    @endif

                                 </td>
                                <td>{{ $coupon->vbr_name }}</td>
                                <td>
                                    {{ date('j F Y g:i A', strtotime($coupon->created_at)) }}
                                </td>
                            </tr>
                        @endforeach

                  </tbody>
                </table>
                </div>
                <!-- /.card-body -->
              </div>
            </div>
            <!-- /.col -->
          </div>
      </div><!-- /.container-fluid -->
    </section>
@endsection

@section('custom_script')
<script>
      $(document).ready(function() {
    $('#example2').DataTable( {
        "info": true,
          "autoWidth": false,
          scrollX:'50vh',
          scrollY:'50vh',
        scrollCollapse: true,
    } );
} );
</script>
@endsection
