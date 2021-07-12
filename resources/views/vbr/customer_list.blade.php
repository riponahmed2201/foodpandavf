@extends('master')

@section('title', 'My Customer List')
@section('dashboard-title', 'My Customer List')
@section('breadcrumb-title', 'My Customer List Information')

@section('stylesheet')
    <!-- <link href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@8.10.0/dist/sweetalert2.css" rel="stylesheet"> -->
@endsection

@section('container')
 <section class="content">
        <div class="container-fluid">
          <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title">Filter</h3>
            </div>

            <div class="card-body">
              <form role="form" action="{{ route('mycustomer') }}" method="post">
                  @csrf
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label>&nbsp;&nbsp; Name</label>
                      <div class="col-md-12 col-sm-12">
                        <select name="name" class="form-control">
                            <option value="-1">----select name----</option>
                            @foreach ($customers as $name)
                                <option value="{{ $name->name }}">{{  $name->name }}</option>
                            @endforeach
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
                            @foreach ($customers as $phone)
                                <option value="{{ $phone->mobile }}">{{  $phone->mobile }}</option>
                            @endforeach
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="col-sm-4">
                    <div class="form-group">
                      <label>&nbsp;&nbsp; Entry Date</label>
                      <div class="col-md-12 col-sm-12">
                        <select name="entry_date" class="form-control">
                            <option value="-1">----select entry date----</option>
                            @foreach ($customers as $entry_date)
                                <option value="{{ date('Y-m-d h:i:s A', strtotime($entry_date->created_at)) }}">{{ date('j F Y g:i A', strtotime($entry_date->created_at)) }}</option>
                            @endforeach
                          </select>
                        {{-- <input type="date" name="entry_date" id="from_date" class="form-control"> --}}
                      </div>
                    </div>
                  </div>
                </div>
            </div>
            <div class="card-footer">
              <button type="submit" id="generate" class="btn" style="background: #e83e8c; color: white">Generate</button>
            </div>
        </form>
          </div>

          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header bg-gray-light">
                  <h3 class="card-title">Customer List</h3>
                  <a href="{{route('create.customer')}}" class="float-right btn" style="margin-right: 1rem; background: #e83e8c; color: white"> <i class="fas fa-plus-circle mr-2"></i>Generate Coupon for Customer</a>

                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Entry Date</th>
                      </tr>
                    </thead>
                     <tbody>
                      <?php $i=1; ?>
                      @foreach($customersDataList as $customer)
                        @if ($customer->vbr_id == session('id'))
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$customer->name}}</td>
                            <td>{{$customer->mobile}}</td>
                            <td> {{ date('j F Y g:i A', strtotime($customer->created_at)) }} </td>
                          </tr>
                        @endif
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
