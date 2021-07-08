@extends('master')

@section('title', 'Vbr List')
@section('dashboard-title', 'Vbr List')
@section('breadcrumb-title', 'Vbr List Information')

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
                    <label>&nbsp;&nbsp; Email</label>
                    <div class="col-md-12 col-sm-12">
                      <select required="" class="form-control">
                        <option value="">----select email----</option>
                        <option value="">imran@gmail.com</option>
                        <option value="">suborna@gmail.com</option>
                        <option value="">lisa@gmail.com</option>
                        <option value="">laboni@gmail.com</option>
                        <option value="">rita@gmail.com</option>
                        <option value="">keya@gmail.com</option>
                        <option value="">mila@gmail.com</option>
                        <option value="">lima@gmail.com</option>
                        <option value="">maya@gmail.com</option>
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
                  <h3 class="card-title">VBR List</h3>
                  <a class="float-right btn btn-success" href="{{route('create.vbr')}}"> <i class="fas fa-plus-circle mr-2"></i>Create VBR </a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                      <th>#</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Phone</th>
                      <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php $i=1; ?>
                    @foreach($vbrData as $vbrData)
                    <tr>
                      <td>{{$i++}}</td>
                      <td>{{$vbrData->name}}</td>
                      <td>{{$vbrData->email}}</td>
                      <td>{{$vbrData->mobile}}</td>
                      <td>
                        @if ($vbrData->status==1)
                        <a class="updateVbrStatus" id="vbr-{{$vbrData->id}}" vbr_id="{{$vbrData->id}}" href="javascript:void(0)">Approved</a>
                        @else
                        <a class="updateVbrStatus" id="vbr-{{$vbrData->id}}" vbr_id="{{$vbrData->id}}" href="javascript:void(0)">Not Approved</a>
                        @endif
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
//   $(document).ready(function() {
   
// } );
 $(".updateVbrStatus").click(function(){
    var status=$(this).text();
    var vbr_id=$(this).attr("vbr_id");
    $.ajax({
       type:'post',
       url:'/vbr/update-status',
       data:{status:status,vbr_id:vbr_id},
       success:function(resp){
          if (resp['status']==1) {
            
              $("#vbr-"+vbr_id).html("<a class='updateVbrStatus' href='javascript:void(0)'>Approved</a>");
          }else if (resp['status']==0) {
              $("#vbr-"+vbr_id).html("<a class='updateVbrStatus' href='javascript:void(0)'>Not Approved</a>");
          }
       },error:function(){
        alert("Error");
       }
    });
 });
</script>
@endsection