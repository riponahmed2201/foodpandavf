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
                        <div class="card-header" style="background: #D70F64; color: white">
                            <h3 class="card-title">Customer Create</h3>
                            <a href="{{ route('mycustomer') }}" class="float-right btn"
                                style="margin-right: 1rem; background: #D70F64; color: white"> <i
                                    class="fas fa-list mr-2"></i> Customer List</a>
                        </div>
                        <div class="col-md-8 offset-2 mt-2">
                            @if ($message = Session::get('success'))
                                <div class="alert alert-block text-center" style="background: #e83e8c; color: white">
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

                        {{-- <form action="{{ route('add.customer') }}" id="createCustomerForm" name="createCustomerForm"
                            method="POST">
                            @csrf --}}
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Name<span style="color: red;" class="required">*</span></label>
                                        <input type="text" name="name" id="name" value="{{ old('name') }}"
                                            class="form-control" placeholder="Enter name">
                                        @if ($errors->has('name'))
                                            <span class="text-danger">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email<span style="color: red;" class="required">*</span></label>
                                        <input type="email" name="email" id="email" value="{{ old('email') }}"
                                            class="form-control" placeholder="Enter email">
                                        @if ($errors->has('email'))
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Mobile<span style="color: red;" class="required">*</span></label>
                                        <input type="number" name="mobile" id="mobile" value="{{ old('mobile') }}"
                                            class="form-control" placeholder="Enter mobile">
                                        @if ($errors->has('mobile'))
                                            <span class="text-danger">{{ $errors->first('mobile') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6" id="check_otp_div">
                                    <div class="form-group">
                                        <label>Check OTP<span style="color: red;" class="required">*</span></label>
                                        <input type="number" name="check_otp" id="check_otp" class="form-control"
                                            placeholder="Enter OTP">
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer">

                                <button type="button" id="sendOTPButton" class="btn"
                                    style="background: #D70F64; color: white">Send OTP</button>

                                <button type="button" id="formSubmitButton" class="btn float-right"
                                    style="background: #D70F64; color: white">Submit</button>
                            </div>
                        </div>
                        {{-- </form> --}}
                    </div>
                </div>
            </div><!-- /.container-fluid -->
    </section>
@endsection

@section('custom_script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>

    <script>
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $("#formSubmitButton").hide();
            $("#check_otp_div").hide();
        });

        $(function() {
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            });
        });

        var check_otp_four_digit = '';

        $("#sendOTPButton").on("click", function() {
            var mobile = $("#mobile").val();
            console.log(mobile)
            $.ajax({
                url: "{{ route('sendOTPToCustomer') }}",
                type: "POST",
                data: {
                    mobile: mobile
                },
                success: function(data) {

                    check_otp_four_digit = data;
                    // console.log(check_otp_four_digit)

                    $("#sendOTPButton").hide();
                    $("#check_otp_div").show();
                    $("#formSubmitButton").show();
                    $("#mobile").attr("disabled", true);
                }
            });
        });

        // form submit data and create customer
        $("#formSubmitButton").on("click", function() {

            var check_otp = $("#check_otp").val();

            if (check_otp == check_otp_four_digit) {
                var name = $("#name").val();
                var email = $("#email").val();
                var mobile = $("#mobile").val();

                $.ajax({
                    type: 'POST',
                    url: "{{ route('add.customer') }}",
                    data: {
                        name: name,
                        email: email,
                        mobile: mobile
                    },
                    success: (data) => {
                        if (data == 'coupon') {
                            alert("No coupon available for customer.");
                        }
                        console.log(data)
                        alert("Customer added successfully.");

                        $("#name").val('');
                        $("#email").val('');
                        $("#mobile").val('');

                        $("#sendOTPButton").show();
                        $("#check_otp_div").hide();
                        $("#formSubmitButton").hide();
                        $("#mobile").attr("disabled", false);
                    },
                    error: function(data) {
                        alert("Operation Failed.");
                    }
                });
            } else {
                alert("Customer OTP and your OTP do not match.");
            }
        });

        // $("#addCustomer").on("click", function() {
        //     var name = $("#name").val();
        //     var email = $("#email").val();
        //     var mobile = $("#mobile").val();
        //     var api_url =
        //         "https://smsplus.sslwireless.com/api/v3/send-sms?api_token=Smartpick-dfe06f43-a143-4b3a-91e3-f75e071166c5&sid=HIGHVOLNONBRAND&sms=test&msisdn=88" +
        //         mobile + "&csms_id=123456789";
        //     // alert(email);
        //     console.log(api_url);
        //     $.ajax({
        //         url: api_url,
        //         type: "GET",
        //         success: function(data) {
        //             console.log(data);
        //         }
        //     });
        // });
    </script>

@endsection
