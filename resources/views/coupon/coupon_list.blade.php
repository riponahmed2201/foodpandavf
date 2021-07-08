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
        <div class="card card-secondary">
          <div class="card-header">
            <h3 class="card-title">Filter</h3>
          </div>

          <div class="card-body">
            <form role="form" action="#" method="get">
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>&nbsp;&nbsp; Coupon Code</label>
                    <div class="col-md-12 col-sm-12">
                      <select required="" class="form-control">
                        <option value="">----select Coupon Code----</option>
                        <option value="">BSH@KSS0171</option>
                        <option value="">BSH@KSS0171</option>
                        <option value="">BSH@KSS0171</option>
                        <option value="">BSH@KSS0171</option>
                        <option value="">BSH@KSS0171</option>
                        <option value="">BSH@KSS0171</option>
                        <option value="">BSH@KSS0171</option>
                        <option value="">BSH@KSS0171</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>&nbsp;&nbsp; Status</label>
                    <div class="col-md-12 col-sm-12">
                      <select required="" class="form-control">
                        <option value="">----select location----</option>
                        <option value="">Used</option>
                        <option value="">Not Used</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-sm-6">
                  <div class="form-group">
                    <label>&nbsp;&nbsp; Assigned</label>
                    <div class="col-md-12 col-sm-12">
                      <select required="" class="form-control">
                        <option value="">----select Assigned----</option>
                        <option value="">Imran</option>
                        <option value="">Jui</option>
                        <option value="">Hasan</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-sm-6">
                  <div class="form-group">
                    <label>&nbsp;&nbsp; Date</label>
                    <div class="col-md-12 col-sm-12">
                      <input type="date" required="" class="form-control">
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
                  <h3 class="card-title">All Coupons</h3>
                  
                  <a class="float-right btn btn-success" style="margin-right: 1rem;" href="{{route('assign.coupon')}}"> <i class="fas fa-plus-circle mr-2"></i>Assign Coupon</a>

                  <a class="float-right btn btn-success" style="margin-right: 1rem;" data-toggle="modal" data-target="#exampleModalCenter"> <i class="fas fa-plus-circle mr-2"></i>Upload Coupon</a>

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
                            <div class="input-group-prepend">
                                <span class="input-group-text">Upload</span>
                              </div>
                              <div class="custom-file">
                                <input type="file" class="custom-file-input" id="inputGroupFile01">
                                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                              </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-success">Uoload</button>
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
                      <th>Assigned</th>
                      <th>Date</th>
                    </tr>
                    </thead>
                    <tbody>

                    <tr>
                        <td>1</td>
                        <td>BSH@KSS0171</td>
                        <td> <span class="badge badge-danger">Used</span> </td>
                        <td>Imran</td>
                        <td> 14 June 2021 03:32 PM</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>BSH@KSS0321</td>
                        <td> <span class="badge badge-danger">Used</span> </td>
                        <td>Imran</td>
                        <td> 14 June 2021 03:32 PM</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>BSH@KSS0173</td>
                        <td> <span class="badge badge-danger">Used</span> </td>
                        <td>Jui</td>
                        <td> 14 June 2021 03:32 PM</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>BSH@KSS0171</td>
                        <td> <span class="badge badge-danger">Used</span> </td>
                        <td>Hasan</td>
                        <td> 14 June 2021 03:32 PM</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>BSH@KSS0171</td>
                        <td> <span class="badge badge-success">Not Used</span> </td>
                        <td>NA</td>
                        <td> 14 June 2021 03:32 PM</td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>BSH@KSS0171</td>
                        <td> <span class="badge badge-success">Not Used</span> </td>
                        <td>NA</td>
                        <td> 14 June 2021 03:32 PM</td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td>BSH@KSS0171</td>
                        <td> <span class="badge badge-success">Not Used</span> </td>
                        <td>NA</td>
                        <td> 14 June 2021 03:32 PM</td>
                    </tr>
                    <tr>
                        <td>8</td>
                        <td>BSH@KSS0171</td>
                        <td> <span class="badge badge-success">Not Used</span> </td>
                        <td>NA</td>
                        <td> 14 June 2021 03:32 PM</td>
                    </tr>
                    <tr>
                        <td>9</td>
                        <td>BSH@KSS0171</td>
                        <td> <span class="badge badge-success">Not Used</span> </td>
                        <td>NA</td>
                        <td> 14 June 2021 03:32 PM</td>
                    </tr>
                    <tr>
                        <td>10</td>
                        <td>BSH@KSS0171</td>
                        <td> <span class="badge badge-danger">Used</span> </td>
                        <td>NA</td>
                        <td> 14 June 2021 03:32 PM</td>
                    </tr>
                
                  </tbody></table>
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


@endsection