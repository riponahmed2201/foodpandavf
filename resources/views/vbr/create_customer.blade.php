@extends('master')

@section('title', 'Create Customer')
@section('dashboard-title', 'Create Customer')
@section('breadcrumb-title', 'Create Customer')

@section('stylesheets')
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
@endsection

@section('container')
<section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header bg-gray-light">
                  <h3 class="card-title">Customer Create</h3>
                  <a href="{{route('mycustomer')}}" class="float-right btn btn-success" style="margin-right: 1rem;"> <i class="fas fa-list mr-2"></i> Customer List</a>
                </div>
                <div class="col-md-8 offset-2 mt-2">
                  @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block text-center">
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

                <form action="{{route('add.customer')}}" method="POST">
                  @csrf
                  <div class="card-body">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Name<span style="color: red;" class="required">*</span></label>
                            <input type="text" name="name" id="name" value="{{old('name')}}" class="form-control" placeholder="Enter name">
                            @if($errors->has('name'))
                              <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Email<span style="color: red;" class="required">*</span></label>
                            <input type="email" name="email" id="name" value="{{old('email')}}" class="form-control" placeholder="Enter email">
                            @if($errors->has('email'))
                              <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Mobile<span style="color: red;" class="required">*</span></label>
                            <input type="number" name="mobile" id="mobile" value="{{old('mobile')}}" class="form-control" placeholder="Enter mobile">
                            @if($errors->has('mobile'))
                              <span class="text-danger">{{ $errors->first('mobile') }}</span>
                            @endif
                          </div>
                        </div>
                    </div>
                    <div class="card-footer">
                      <button  type="sutmit" class="btn btn-success float-right">Submit</button>
                      </div>
                </div>
              </form>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
@endsection

@section('custom_script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>

<script>
    $(function() {
       $('.select2bs4').select2({
          theme: 'bootstrap4'
        });
    });


        $( "#addCustomer" ).on("click",function() {
            var name = $("#name").val();
            var email = $("#email").val();
            var mobile = $("#mobile").val();
            var api_url = "https://smsplus.sslwireless.com/api/v3/send-sms?api_token=Smartpick-dfe06f43-a143-4b3a-91e3-f75e071166c5&sid=HIGHVOLNONBRAND&sms=test&msisdn=88"+mobile+"&csms_id=123456789";
            // alert(email);
            console.log(api_url);
                $.ajax({
                    url:api_url,
                    type:"GET",
                    success:function(data){
                        console.log(data);
                    }
            });
        });
</script>

@endsection
