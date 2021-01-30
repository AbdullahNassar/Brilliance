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
        var num3 = 1;
        var num2 = 3;
        var payment = 1;
        $('.add_form_field3').click(function(){
            $('.payment').append('<div id="empty_payment_'+(num3)+'" class="col-lg-12"><p> <p></div>'+
                                   '<div class="col-lg-3" id="remove_payment1_'+(num3)+'"><div class="form-group pmd-textfield pmd-textfield-floating-label"><label class="control-label">Payment Name</label><select class="form-control" name="payments['+num3+'][name]"><option></option><option value="Application Fees">Application Fees</option><option value="1st Installment">1st Installment</option><option value="2nd Installment">2nd Installment</option><option value="3rd Installment">3rd Installment</option><option value="4th Installment">4th Installment</option><option value="5th Installment">5th Installment</option><option value="6th Installment">6th Installment</option><option value="7th Installment">7th Installment</option><option value="8th Installment">8th Installment</option><option value="9th Installment">9th Installment</option><option value="10th Installment">10th Installment</option><option value="11th Installment">11th Installment</option><option value="12th Installment">12th Installment</option><option value="13th Installment">13th Installment</option><option value="14th Installment">14th Installment</option><option value="15th Installment">15th Installment</option><option value="16th Installment">16th Installment</option><option value="17th Installment">17th Installment</option><option value="18th Installment">18th Installment</option><option value="19th Installment">19th Installment</option><option value="20th Installment">20th Installment</option><option value="21th Installment">21th Installment</option><option value="22th Installment">22th Installment</option><option value="23th Installment">23th Installment</option><option value="24th Installment">24th Installment</option><option value="Graduation Fees">Graduation Fees</option><option value="Legalization Certificate">Legalization Certificate</option><option value="Caps & Growns Insurance">Caps & Growns Insurance</option><option value="Transcript">Transcript</option><option value="Make up Exam">Make up Exam</option><option value="Resubmission">Resubmission</option><option value="No Show in Final Exam">No Show in Final Exam</option><option value="Failed">Failed</option><option value="Rechecking Exam Paper">Rechecking Exam Paper</option><option value="Freezing">Freezing</option><option value="Photography">Photography</option></select></div></div>'+
                                   '<div class="col-lg-2" id="remove_payment2_'+(num3)+'"><div class="form-group pmd-textfield pmd-textfield-floating-label"><label class="control-label">Date</label><input type="text" class="form-control datepicker dpd" name="payments['+num3+'][date]" data-date-format="dd-mm-yyyy" autocomplete="off"/></div></div>'+
                                   '<div class="col-lg-2" id="remove_payment3_'+(num3)+'"><div class="form-group pmd-textfield pmd-textfield-floating-label"><label class="control-label">Euro = EGP</label><input type="number" class="form-control" name="payments['+num3+'][egp_amount]" autocomplete="off"/></div></div>'+
                                   '<div class="col-lg-2" id="remove_payment4_'+(num3)+'"><div class="form-group pmd-textfield pmd-textfield-floating-label"><label class="control-label">Euro</label><input type="number" class="form-control" name="payments['+num3+'][euro_amount]" autocomplete="off"/></div></div>'+
                                   '<div class="col-lg-2" id="remove_payment5_'+(num3)+'"><div class="form-group pmd-textfield pmd-textfield-floating-label"><label class="control-label">USD</label><input type="number" class="form-control" name="payments['+num3+'][usd_amount]" autocomplete="off"/></div></div>'+
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

        $('#payment_form').on('submit', function(event){
                event.preventDefault();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url:"{{ route('students.addPayment') }}",
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
                                window.location.href = "{{URL::to('/admin/applicants/payment-print/')}}"+"/{{$student->id}}"
                            }
                        },
                    },
                })
        });

        $('#pay_form').on('submit', function(event){
                event.preventDefault();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url:"{{ route('payment.edit') }}",
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
                                window.location.href = "{{URL::to('/admin/student')}}"
                            }
                        },
                    },
                })
        });
    });
    </script>
@endsection