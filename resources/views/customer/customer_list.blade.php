@extends('master')

@section('title', 'Admin Dashboard')
@section('dashboard-title', 'Dashboard')
@section('breadcrumb-title', 'Dashboard Information')

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
              <form role="form" action="{{ route('customer.list') }}" method="POST">
                @csrf
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label>&nbsp;&nbsp; Name</label>
                      <div class="col-md-12 col-sm-12">
                        <select name="name" required="" class="form-control">
                          <option value="-1">----select name----</option>
                          @foreach($allCustomerDataList as $custdata)
                            <option value="{{ $custdata->name }}">{{ $custdata->name }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label>&nbsp;&nbsp; Coupon Code</label>
                      <div class="col-md-12 col-sm-12">
                        <select name="coupon_code" class="form-control">
                          <option value="-1">----select coupon code----</option>
                          @foreach($allCustomerDataList as $custdata)
                            <option value="{{ $custdata->coupon_code }}">{{ $custdata->coupon_code }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="col-sm-4">
                    <div class="form-group">
                      <label>&nbsp;&nbsp; Status</label>
                      <div class="col-md-12 col-sm-12">
                        <select name="status" class="form-control">
                          <option value="-1">----select status----</option>
                          <option value="0">Gift Pending</option>
                          <option value="1">Gift Taken</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="col-sm-4">
                    <div class="form-group">
                      <label>&nbsp;&nbsp; Phone</label>
                      <div class="col-md-12 col-sm-12">
                        <select name="mobile" class="form-control">
                          <option value="-1">----select phone----</option>
                          @foreach($allCustomerDataList as $custdata)
                            <option value="{{ $custdata->mobile }}">{{ $custdata->mobile }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="col-sm-4">
                    <div class="form-group">
                      <label>&nbsp;&nbsp; Entry Date</label>
                      <div class="col-md-12 col-sm-12">
                        <input name="entry_date" type="date" id="from_date" class="form-control">
                      </div>
                    </div>
                  </div>

                </div>
            <div class="card-footer">
              <button type="submit" id="generate" class="btn" style="background: #D70F64; color: white">Generate</button>
            </div>
        </form>
          </div>

          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header bg-gray-light">
                  <h3 class="card-title">Customer List</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>VBR Name</th>
                        <th>Coupon Status</th>
                        <th>Coupon</th>
                        <th>Entry Date</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i=1; ?>
                     @foreach($customerData as $custdata)
                      <tr>
                        <td>{{$i++}}</td>
                        <td>{{$custdata->name}}</td>
                        <td>{{$custdata->mobile}}</td>
                        <td>{{$custdata->admin_name}}</td>
                            @if ($custdata->status==1)
                                <td>
                                    <span class="badge badge-success">Gift Taken</span>
                                </td>
                            @else
                                <td>
                                    <span class="badge badge-danger">Gift Pending</span>
                                </td>
                            @endif
                        <td>{{$custdata->coupon_code}} </td>
                        <td> {{ date('j F Y g:i A', strtotime($custdata->created_at)) }} </td>
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
