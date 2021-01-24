@section('scripts')
    <script src="{{asset('vendors/lib/jquery/jquery.js')}}"></script>
    <script src="{{asset('vendors/lib/popper.js/popper.js')}}"></script>
    <script src="{{asset('vendors/lib/bootstrap/bootstrap.js')}}"></script>
    <script src="{{asset('vendors/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js')}}"></script>
    <script src="{{asset('vendors/lib/moment/moment.js')}}"></script>
    <script src="{{asset('vendors/lib/jquery-ui/jquery-ui.js')}}"></script>
    <script src="{{asset('vendors/lib/jquery-switchbutton/jquery.switchButton.js')}}"></script>
    <script src="{{asset('vendors/lib/peity/jquery.peity.js')}}"></script>
    <script src="{{asset('vendors/lib/highlightjs/highlight.pack.js')}}"></script>
    <script src="{{asset('vendors/lib/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('vendors/lib/datatables-responsive/dataTables.responsive.js')}}"></script>
    <script src="{{asset('vendors/lib/select2/js/select2.min.js')}}"></script>
    <script src="{{asset('vendors/lib/jt.timepicker/jquery.timepicker.js')}}"></script>
    <script src="{{asset('vendors/lib/spectrum/spectrum.js')}}"></script>
    <script src="{{asset('vendors/lib/jquery.maskedinput/jquery.maskedinput.js')}}"></script>
    <script src="{{asset('vendors/lib/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script>
    <script src="{{asset('vendors/lib/ion.rangeSlider/js/ion.rangeSlider.min.js')}}"></script>
    <script src="{{asset('vendors/js/bootstrap-toggle.min.js')}}"></script>
    <script src="{{asset('vendors/js/dropzone.js')}}"></script>
    <script src="{{asset('vendors/js/bracket.js')}}"></script>
    <script src="{{asset('vendors/js/jquery.nicescroll.min.js')}}"></script>
    <script src="{{asset('vendors/toastr/toastr.min.js')}}"></script>
    <script src="{{asset('vendors/js/float-labels.js')}}"></script>
    <script src="{{asset('vendors/lib/parsleyjs/parsley.js')}}"></script>
    <script src="{{asset('vendors/js/custom-file-input.js')}}"></script>
    <script type="text/javascript">
        /* Nice Scroll 
        $(document).ready(function() {
            "use strict";
            $("html").niceScroll({
                scrollspeed: 60,
                mousescrollstep: 35,
                cursorwidth: 5,
                cursorcolor: '#b02e2e54',
                cursorborder: 'none',
                background: 'rgb(176 46 46 / 38%)',
                cursorborderradius: 3,
                autohidemode: false,
                cursoropacitymin: 0.1,
                cursoropacitymax: 1,
                zindex: "999",
                horizrailenabled: false
            });
        });*/
    </script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script>
    $(document).ready(function() {
        var pay = '';
        @foreach($payments as $payment)
        @if($payment->paid != 1)
            pay = '<option value="{{$payment->id}}">{{$payment->name}}</option>' + pay;
        @endif
        @endforeach
        var num3 = 1;
        var num2 = 3;
        var payment = 1;
        $('.add_form_field3').click(function(){
            $('.payment').append('<div id="empty_payment_'+(num3)+'" class="col-lg-12"><p> <p></div>'+
                                   '<div class="col-lg-3" id="remove_payment1_'+(num3)+'"><div class="form-group pmd-textfield pmd-textfield-floating-label"><label class="control-label">Payment Name</label><select class="form-control" name="payments['+num3+'][type]"><option></option>'+pay+'</select></div></div>'+
                                   '<div class="col-lg-2" id="remove_payment2_'+(num3)+'"><div class="form-group pmd-textfield pmd-textfield-floating-label"><label class="control-label">Date</label><input type="text" value="{{$now}}" disabled class="form-control datepicker dpd" data-date-format="dd-mm-yyyy" autocomplete="off"/></div></div>'+
                                   '<div class="col-lg-2" id="remove_payment3_'+(num3)+'"><div class="form-group pmd-textfield pmd-textfield-floating-label"><label class="control-label">Euro = EGP</label><input type="number" class="form-control" name="payments['+num3+'][egp_paid]" autocomplete="off"/></div></div>'+
                                   '<div class="col-lg-2" id="remove_payment4_'+(num3)+'"><div class="form-group pmd-textfield pmd-textfield-floating-label"><label class="control-label">Euro</label><input type="number" class="form-control" name="payments['+num3+'][euro_paid]" autocomplete="off"/></div></div>'+
                                   '<div class="col-lg-2" id="remove_payment5_'+(num3)+'"><div class="form-group pmd-textfield pmd-textfield-floating-label"><label class="control-label">USD</label><input type="number" class="form-control" name="payments['+num3+'][usd_paid]" autocomplete="off"/></div></div>'+
                                   '<div id="remove_payment_button_'+(num3)+'" class="col-lg-1"><a class="btn btn-outline-danger remove_form_field3_'+(payment)+'"><i class="fa fa-close"></i></a></div>');
            num3 = num3+1;
            num2 = num2+1;
            $('#num3').val(num3); 
            $('.datepicker').datepicker({
                dateFormat: 'yy-mm-dd'
            });

                var nowTemp = new Date();
                var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);

                var checkin = $('.dpd').datepicker({
                    onRender: function(date) {
                        return date.valueOf() < now.valueOf() ? 'disabled' : '';
                    }
                }).on('changeDate', function(ev) {
                    checkin.hide();
                }).data('datepicker');

        });
        $('.payment').on('click', '.remove_form_field3_'+num3 , function(e) {
            e.preventDefault();
            num3 = num3-1;
            payment = num3;
            $('#remove_payment1_'+payment).remove();
            $('#remove_payment2_'+payment).remove();
            $('#remove_payment3_'+payment).remove();
            $('#remove_payment4_'+payment).remove();
            $('#remove_payment5_'+payment).remove();
            $('#remove_payment_button_'+payment).remove();
            $('#empty_payment_'+payment).remove();
        });
    });
    </script>
    <script>
    $(document).ready(function() {
        var pay2 = '';
        @foreach($payments as $p)
        @if($p->paid != 1)
            pay2 = '<option value="{{$p->name}}">{{$p->name}}</option>' + pay2;
        @endif
        @endforeach
        var num = 1;
        var num1 = 3;
        var cash = 1;
        $('.add_form_field').click(function(){
            $('.cash').append('<div id="empty_cash_'+(num)+'" class="col-lg-12"><p> <p></div>'+
                                   '<div class="col-lg-3" id="remove_cash1_'+(num)+'"><div class="form-group pmd-textfield pmd-textfield-floating-label"><label class="control-label">Description</label><select class="form-control" name="cash['+num+'][description]"><option></option>'+pay2+'</select></div></div>'+
                                   '<div class="col-lg-3" id="remove_cash2_'+(num)+'"><div class="form-group pmd-textfield pmd-textfield-floating-label"><label class="control-label">Type</label><select class="form-control" name="cash['+num+'][type]"><option></option><option value="cash">Cash</option><option value="pos">POS</option><option value="bank">Bank Transfer</option><option value="online">Online</option></select></div></div>'+
                                   '<div class="col-lg-3" id="remove_cash3_'+(num)+'"><div class="form-group pmd-textfield pmd-textfield-floating-label"><label class="control-label">Currency</label><select class="form-control" name="cash['+num+'][currency]"><option></option><option value="egp">EGP</option><option value="euro">Euro</option><option value="usd">USD</option></select></div></div>'+
                                   '<div class="col-lg-2" id="remove_cash4_'+(num)+'"><div class="form-group pmd-textfield pmd-textfield-floating-label"><label class="control-label">Amount</label><input type="number" class="form-control" name="cash['+num+'][amount]" autocomplete="off"/></div></div>'+
                                   '<div id="remove_cash_button_'+(num)+'" class="col-lg-1"><a class="btn btn-outline-danger remove_form_field_'+(cash)+'"><i class="fa fa-close"></i></a></div>');
            num = num+1;
            num1 = num1+1;
            $('#num').val(num); 
        });
        $('.cash').on('click', '.remove_form_field_'+num , function(e) {
            e.preventDefault();
            num = num-1;
            cash = num;
            $('#remove_cash1_'+cash).remove();
            $('#remove_cash2_'+cash).remove();
            $('#remove_cash3_'+cash).remove();
            $('#remove_cash4_'+cash).remove();
            $('#remove_cash_button_'+cash).remove();
            $('#empty_cash_'+cash).remove();
        });

        $('#pay_form').on('submit', function(event){
                event.preventDefault();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url:"{{ route('students.addPay') }}",
                    method:"POST",
                    data:new FormData(this),
                    dataType:"json",
                    cache: false,
                    contentType : false,
                    processData: false,
                    statusCode: {
                        500: function(data) {
                            toastr.error(data.responseJSON.message, 'Error!', {timeOut: 5000});
                        },
                        
                        422: function(data) {
                            var error = data.responseJSON.errors;
                            $.each(error, function(k, v) {
                                toastr.error(v, 'Error!', {timeOut: 5000});
                            });
                        },
                        
                        200: function(data) {
                            if(data.original.data.status_code == 400){
                                toastr.error(data.original.data.message, 'Error!', {timeOut: 5000});
                            }

                            if(data.original.data.status_code == 422){
                                toastr.error(data.original.data.message, 'Error!', {timeOut: 5000});
                            }

                            if(data.original.data.status_code == 500){
                                toastr.error(data.original.data.message, 'Error!', {timeOut: 5000});
                            }
                            
                            if(data.original.data.status_code == 200){
                                toastr.success(data.original.data.message, 'Success!', {timeOut: 5000});
                                window.location.href = "{{route('students.print', ['id' => $student->id])}}";
                            }
                        },
                    },
                });
        });
    });
    </script>
@endsection