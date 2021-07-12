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
            <form role="form" action="{{ route('vbr.list') }}" method="post">
                @csrf
              <div class="row">
                <div class="col-sm-4">
                  <div class="form-group">
                    <label>&nbsp;&nbsp; Name</label>
                    <div class="col-md-12 col-sm-12">
                      <select name="name" class="form-control">
                        <option value="-1">----select name----</option>
                        @foreach ($vbrData as $name)
                            <option value="{{ $name->name }}">{{  $name->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-sm-4">
                  <div class="form-group">
                    <label>&nbsp;&nbsp; Email</label>
                    <div class="col-md-12 col-sm-12">
                      <select name="email" class="form-control">
                        <option value="-1">----select email----</option>
                        @foreach ($vbrData as $email)
                            <option value="{{ $email->email }}">{{  $email->email }}</option>
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
                        @foreach ($vbrData as $phone)
                            <option value="{{ $phone->mobile }}">{{  $phone->mobile }}</option>
                        @endforeach
                      </select>
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
                  <button class="btn btn-danger btn-sm float-sm-left" id="delete_all" style="margin:5px;"><i class="fa fa-trash"></i> Delete</button>&nbsp
                <button class="btn btn-sm float-sm-left" id="active_all" style="margin:5px; background: #e83e8c; color: white"><i class="fa fa-check"></i> Active</button>
                <button class="btn btn-warning btn-sm float-sm-left" id="deactivate_all" style="margin:5px;"><i class="fa fa-exclamation-circle"></i> Inactive</button>
                  <a class="float-right btn" style="background: #e83e8c; color: white" href="{{route('create.vbr')}}"> <i class="fas fa-plus-circle mr-2"></i>Create VBR </a>
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
                    @foreach($vbrDataList as $vbrData)
                        @if ($vbrData->role == 'vbr')
                            <tr>
                            <td><input type="checkbox" name="vbrs_ids[]" value="{{$vbrData->id}}"></td>
                            <td>{{$vbrData->name}}</td>
                            <td>{{$vbrData->email}}</td>
                            <td>{{$vbrData->mobile}}</td>
                            <td>
                                @if ($vbrData->status==1)
                                <button class="btn btn-success btn-xs">Active</button>
                                @else
                                <button class="btn btn-danger btn-xs">Inactive</button>
                                @endif
                            </td>
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
$(function () {
      // delete all selected question id
      $('#delete_all').click(function () {
          var ids = [];
          // get all selected user id
          $.each($("input[name='vbrs_ids[]']:checked"), function(){
              ids.push($(this).val());
          });
          if (ids.length!==0) {
              var url = "{{ url('delete/all/vbrs') }}";
              Swal.fire({
                  title: 'Are you sure?',
                  text: "You want to delete?",
                  type: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Yes, Delete it!'
              }).then(function(result) {
                  if (result.value) {
                      $.ajax({
                          url: url,
                          type: 'POST',
                          data: {"vbrs_ids": ids, "_token": "{{ csrf_token() }}"},
                          dataType: "json",
                          beforeSend:function () {
                              Swal.fire({
                                  title: 'Deleting Data.......',
                                  showConfirmButton: false,
                                  html: '<i class="fa fa-spinner fa-spin" style="font-size:24px"></i>',
                                  allowOutsideClick: false
                              });
                          },
                          success:function (response) {
                              Swal.close();
                              console.log(response);
                              if (response==="success"){
                                  Swal.fire({
                                      title: 'Successfully Deleted',
                                      type: 'success',
                                      confirmButtonColor: '#3085d6',
                                      confirmButtonText: 'Ok'
                                  }).then(function(result) {
                                      if (result.value) {
                                          window.location.reload();
                                      }
                                  });
                              }
                          },
                          error:function (error) {
                              Swal.close();
                              console.log(error);
                          }
                      })
                  }
              });
          }else{
              Swal.fire(
                  'Error',
                  'Select The Vbr First!',
                  'error'
              )
          }
      });
    });
   // activate all selected user id
  $('#active_all').click(function () {
      var ids = [];
      // get all selected user id
      $.each($("input[name='vbrs_ids[]']:checked"), function(){
          ids.push($(this).val());
      });
      if (ids.length!==0) {
          var url = "{{ url('activate/all/vbrs') }}";
          Swal.fire({
              title: 'Are you sure?',
              text: "You want to active?",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, Activate'
          }).then(function(result) {
              if (result.value) {
                  $.ajax({
                      url: url,
                      type: 'POST',
                      data: {"vbrs_ids": ids, "_token": "{{ csrf_token() }}"},
                      dataType: "json",
                      beforeSend:function () {
                          Swal.fire({
                              title: 'Activating Vbr Status.......',
                              showConfirmButton: false,
                              html: '<i class="fa fa-spinner fa-spin" style="font-size:24px"></i>',
                              allowOutsideClick: false
                          });
                      },
                      success:function (response) {
                          Swal.close();
                          console.log(response);
                          if (response==="success"){
                              Swal.fire({
                                  title: 'Successfully Activated',
                                  type: 'success',
                                  confirmButtonColor: '#3085d6',
                                  confirmButtonText: 'Ok',
                                  allowOutsideClick: false
                              }).then(function(result) {
                                  if (result.value) {
                                      window.location.reload();
                                  }
                              });
                          }
                      },
                      error:function (error) {
                          Swal.close();
                          console.log(error);
                      }
                  })
              }
          });
      }else{
          Swal.fire(
              'Error',
              'Select The Vbr First!',
              'error'
          )
      }
  });
  // deactivate all selected users
  $('#deactivate_all').click(function () {
      var ids = [];
      // get all selected user id
      $.each($("input[name='vbrs_ids[]']:checked"), function(){
          ids.push($(this).val());
      });
      if (ids.length!==0) {
          var url = "{{ url('deactivate/all/vbrs') }}";
          Swal.fire({
              title: 'Are you sure?',
              text: "You want to Deactivate?",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, Deactivate'
          }).then(function(result) {
              if (result.value) {
                  $.ajax({
                      url: url,
                      type: 'POST',
                      data: {"vbrs_ids": ids, "_token": "{{ csrf_token() }}"},
                      dataType: "json",
                      beforeSend:function () {
                          Swal.fire({
                              title: 'Deactivating Vbr Status.......',
                              showConfirmButton: false,
                              html: '<i class="fa fa-spinner fa-spin" style="font-size:24px"></i>',
                              allowOutsideClick: false
                          });
                      },
                      success:function (response) {
                          Swal.close();
                          console.log(response);
                          if (response==="success"){
                              Swal.fire({
                                  title: 'Successfully Deactivated',
                                  type: 'success',
                                  confirmButtonColor: '#3085d6',
                                  confirmButtonText: 'Ok',
                                  allowOutsideClick: false
                              }).then(function(result) {
                                  if (result.value) {
                                      window.location.reload();
                                  }
                              });
                          }
                      },
                      error:function (error) {
                          Swal.close();
                          console.log(error);
                      }
                  })
              }
          });
      }else{
          Swal.fire(
              'Error',
              'Select The Vbr First!',
              'error'
          )
      }
  });
</script>

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
