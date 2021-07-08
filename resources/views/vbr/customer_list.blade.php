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
              <form role="form" action="#" method="get">
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label>&nbsp;&nbsp; Name</label>
                      <div class="col-md-12 col-sm-12">
                        <select required="" class="form-control">
                          <option value="">----select name----</option>
                          <option value="">Imran</option>
                          <option value="">Suborna</option>
                          <option value="">Lisa</option>
                          <option value="">Laboni</option>
                          <option value="">Rita</option>
                          <option value="">Keya</option>
                          <option value="">Mila</option>
                          <option value="">Lima</option>
                          <option value="">Maya</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label>&nbsp;&nbsp; Location</label>
                      <div class="col-md-12 col-sm-12">
                        <select required="" class="form-control">
                          <option value="">----select location----</option>
                          <option value="">1</option>
                          <option value="">2</option>
                          <option value="">3</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="col-sm-4">
                    <div class="form-group">
                      <label>&nbsp;&nbsp; Status</label>
                      <div class="col-md-12 col-sm-12">
                        <select required="" class="form-control">
                          <option value="">----select status----</option>
                          <option value="">Gift Pending</option>
                          <option value="">Gift Taken</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="col-sm-4">
                    <div class="form-group">
                      <label>&nbsp;&nbsp; Phone</label>
                      <div class="col-md-12 col-sm-12">
                        <select required="" class="form-control">
                          <option value="">----select phone----</option>
                          <option value="">01711050777</option>
                          <option value="">01782229997</option>
                          <option value="">01865444522</option>
                          <option value="">01913932363</option>
                          <option value="">01313849254</option>
                          <option value="">01864932479</option>
                          <option value="">01792643266</option>
                          <option value="">01969250588</option>
                          <option value="">01715776705</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="col-sm-4">
                    <div class="form-group">
                      <label>&nbsp;&nbsp; Entry Date</label>
                      <div class="col-md-12 col-sm-12">
                        <input type="date" id="from_date" required="" class="form-control">
                      </div>
                    </div>
                  </div>

                </div>
              </form>
            </div>


            <div class="card-footer">
              <a href=""><button type="submit" id="generate" class="btn btn-success">Generate</button></a>
            </div>


          </div>

          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header bg-gray-light">
                  <h3 class="card-title">Customer List</h3>
                  <a href="{{route('create.customer')}}" class="float-right btn btn-success" style="margin-right: 1rem;"> <i class="fas fa-plus-circle mr-2"></i>Generate Coupon for Customer</a>

                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Gift Status</th>
                        <th>Entry Date</th>
                      </tr>
                    </thead>
                     <tbody>
                      <?php $i=1; ?>
                      @foreach($customers as $customer)
                      <tr>
                        <td>{{$i++}}</td>
                        <td>{{$customer->name}}</td>
                        <td>{{$customer->mobile}}</td>
                        @if ($customer->status==1)
                        <td><button class="btn btn-success btn-xs">Gift Taken</button></td>
                        @else
                        <td><button class="btn btn-danger btn-xs">Gift Pending</button></td>
                        @endif
                        <td>{{$customer->created_at}} </td>
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