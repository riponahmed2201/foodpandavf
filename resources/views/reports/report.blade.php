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
            <form role="form" action="{{ route('exportToExcelReport') }}" method="get">
                @csrf
              <div class="row">
                <div class="col-sm-4">
                  <div class="form-group">
                    <label>&nbsp;&nbsp;VBR Name</label>
                    <div class="col-md-12 col-sm-12">
                      <select name="name" class="form-control">
                        <option value="">----select VBR name----</option>
                        {{-- <option value="all">All</option> --}}
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
                      <input type="date" class="form-control">
                    </div>
                  </div>
                </div>

                <div class="col-sm-4">
                  <div class="form-group">
                    <label>&nbsp;&nbsp; To Date</label>
                    <div class="col-md-12 col-sm-12">
                      <input type="date" class="form-control">
                    </div>
                  </div>
                </div>

              </div>

          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-success">Export Excel</button>
            {{-- <a href="{{route('vbr.report')}}" target="blank" class="btn btn-success">Export Excel</a> --}}
          </div>

        </form>
        </div>

      </div><!-- /.container-fluid -->
    </section>
@endsection

@section('custom_script')


@endsection
