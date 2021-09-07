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
        <div class="card">
          <div class="card-header" style="background: #D70F64; color: white">
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
            <button id="generate" class="btn" style="background: #D70F64; color: white">Generate</button>
          </div>


        </div>

        <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header bg-gray-light">
                    <h3 class="card-title">VBR Report Details</h3>
                    <a href="javascript:void(0)" class="btn float-right" style="background: #D70F64; color: white" id="btnExport" onclick="exportReportToExcel(this)">Export Excel</a>

        <!-- <a href="#" class="btn btn-success float-right" onclick="tableToExcel()">Export Excel</a> -->
        <!-- <button id="btnExport" onclick="exportReportToExcel(this)">EXPORT REPORT</button> -->

                </div>
                <iframe id="txtArea1" style="display:none"></iframe>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="excelReport" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                      <th>#</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Phone</th>
                      <th>VBR Name</th>
                      <th>Coupon Code</th>
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
                url:"{{ url('/print-vbr-report-excel') }}/",
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
                            $("#excelReport").append("<tr><td>" + i++ + "</td><td>" + element.name + "</td><td>" + element.email + "</td><td>" + element.mobile + "</td><td>" + element.vbr_name + "</td><td>" + element.coupon_code + "</td></tr>")
                        })
                    }
                }
            });
        });

    </script>


<script src="https://cdn.jsdelivr.net/gh/linways/table-to-excel@v1.0.4/dist/tableToExcel.js"></script>


<script>

// function fnExcelReport()
//     {
//         var tab_text="<table border='2px'><tr bgcolor='#87AFC6'>";
//         var textRange; var j=0;
//         tab = document.getElementById('excelReport'); // id of table

//         for(j = 0 ; j < tab.rows.length ; j++)
//         {
//             tab_text=tab_text+tab.rows[j].innerHTML+"</tr>";
//             //tab_text=tab_text+"</tr>";
//         }

//         tab_text=tab_text+"</table>";
//         tab_text= tab_text.replace(/<A[^>]*>|<\/A>/g, "");//remove if u want links in your table
//         tab_text= tab_text.replace(/<img[^>]*>/gi,""); // remove if u want images in your table
//         tab_text= tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params

//         var ua = window.navigator.userAgent;
//         var msie = ua.indexOf("MSIE ");

//         if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer
//         {
//             txtArea1.document.open("txt/html","replace");
//             txtArea1.document.write(tab_text);
//             txtArea1.document.close();
//             txtArea1.focus();
//             sa=txtArea1.document.execCommand("SaveAs",true,"Say Thanks to Sumit.xls");
//         }
//         else                 //other browser not tested on IE 11
//             sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));

//         return (sa);
//     }
  </script>

  <script>

    function exportReportToExcel() {
      let table = document.getElementsByTagName("table"); // you can use document.getElementById('tableId') as well by providing id to the table tag
      TableToExcel.convert(table[0], { // html code may contain multiple tables so here we are refering to 1st table tag
        name: `export.xlsx`, // fileName you could use any name
        sheet: {
          name: 'Sheet 1' // sheetName
        }
      });
    }

  </script>

@endsection
