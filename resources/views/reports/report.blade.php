@extends('master')

@section('title', 'Reports')
@section('dashboard-title', 'Reports')
@section('breadcrumb-title', 'Reports')

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
            <form role="form">
              <div class="row">
                <div class="col-sm-4">
                  <div class="form-group">
                    <label>&nbsp;&nbsp;VBR Name</label>
                    <div class="col-md-12 col-sm-12">
                      <select name="vbr_name" id="vbr_name" class="form-control">
                        <option value="">----select VBR name----</option>
                        <option value="all">All</option>
                        @foreach ($vbrName as $name)
                            <option value="{{ $name->id }}">{{ $name->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-sm-4">
                  <div class="form-group">
                    <label>&nbsp;&nbsp; From Date</label>
                    <div class="col-md-12 col-sm-12">
                      <input type="date" id="from_date" class="form-control">
                    </div>
                  </div>
                </div>

                <div class="col-sm-4">
                  <div class="form-group">
                    <label>&nbsp;&nbsp; To Date</label>
                    <div class="col-md-12 col-sm-12">
                      <input type="date" id="to_date" class="form-control">
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
          <div class="card-footer">
            <button id="generate" class="btn btn-success">Generate</button>
          </div>


        </div>

        <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header bg-gray-light">
                    <h3 class="card-title">VBR Report Details</h3>
                    <a href="#" class="btn btn-success float-right" onclick="exportToExcel('excelReport','excelReport')">Export Excel</a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="excelReport" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                      <th>#</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Phone</th>
                    </tr>
                    </thead>
                    <tbody>

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

        $("#generate").on("click",function() {
            $('#generate').attr('disabled', true);
            $('#generate').addClass('loading-bar');

            var vbr_name = $("#vbr_name").val();
            var from_date = $("#from_date").val();
            var to_date = $("#to_date").val();

            $("#excelReport tbody").empty();

            $.ajax({
                url:"{{ url('/print-vbr-report-excel') }}",
                type:"GET",
                dataType:"json",
                data:{vbr_name:vbr_name, from_date:from_date, to_date:to_date},
                success:function(data){
                    $('#generate').attr('disabled', false);
                    $('#generate').removeClass('loading-bar');
                    //console.log(data);
                    $("#excelReport tbody").empty();
                    if (data) {
                        var i = 1;
                        $.each(data,function(index,element){
                            $("#excelReport").append("<tr><td>" + i++ + "</td><td>" + element.name + "</td><td>" + element.email + "</td><td>" + element.mobile + "</td></tr>")
                        })
                    }
                }
            });
        });

    </script>


<script>
    function exportToExcel(tableID, filename){

    var vbr_name = $("#vbr_name").val();
    var from_date = $("#from_date").val();
    var to_date = $("#to_date").val();

    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var header = "<h2 style='text-align:center;'>Name : Md. Ripon Mia</h2><h2 style='text-align:center;'>Staff Code: 1111</h2>";
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    // console.log(header);
    // Specify file name
    filename = filename?filename+'('+ vbr_name + '-' + from_date + ' ' + to_date +').xls':'excel_data.xls';

    // Create download link element
    downloadLink = document.createElement("a");

    document.body.appendChild(downloadLink);

    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;

        // Setting the file name
        downloadLink.download = filename;

        //triggering the function
        downloadLink.click();
    }
}
  </script>

@endsection
