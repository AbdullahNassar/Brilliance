@section('scripts')
    <script src="{{asset('vendors/lib/jquery/jquery.js')}}"></script>
    <script src="{{asset('vendors/lib/popper.js/popper.js')}}"></script>
    <script src="{{asset('vendors/lib/bootstrap/bootstrap.js')}}"></script>
    <script src="{{asset('vendors/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js')}}"></script>
    <script src="{{asset('vendors/lib/moment/moment.js')}}"></script>
    <script src="{{asset('vendors/lib/bootstrap-summernote/summernote.min.js')}}"></script>
    <script src="{{asset('vendors/lib/jquery-ui/jquery-ui.js')}}"></script>
    <script src="{{asset('vendors/lib/jquery-switchbutton/jquery.switchButton.js')}}"></script>
    <script src="{{asset('vendors/lib/peity/jquery.peity.js')}}"></script>
    <script src="{{asset('vendors/lib/highlightjs/highlight.pack.js')}}"></script>
    <script src="{{asset('vendors/lib/select2/js/select2.min.js')}}"></script>
    <script src="{{asset('vendors/lib/jt.timepicker/jquery.timepicker.js')}}"></script>
    <script src="{{asset('vendors/lib/spectrum/spectrum.js')}}"></script>
    <script src="{{asset('vendors/lib/jquery.maskedinput/jquery.maskedinput.js')}}"></script>
    <script src="{{asset('vendors/lib/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script>
    <script src="{{asset('vendors/js/dropzone.js')}}"></script>
    <script src="{{asset('vendors/js/bracket.js')}}"></script>
    <script src="{{asset('vendors/js/jquery.nicescroll.min.js')}}"></script>
    <script src="{{asset('vendors/toastr/toastr.min.js')}}"></script>
    <script src="{{asset('vendors/js/float-labels.js')}}"></script>
    <script src="{{asset('vendors/lib/parsleyjs/parsley.js')}}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script type="text/javascript">
        function ShowHideDiv() {
            var program = document.getElementById("program");
            var diplom = document.getElementById("diplom");
            if(program.checked){
                document.getElementById('program_list').disabled = false;
                document.getElementById('program_list').required = true;
            }else{
                document.getElementById('program_list').disabled = true;
                document.getElementById('program_list').required = false;
            }
            if(diplom.checked){
                document.getElementById('diplom_list').disabled = false;
                document.getElementById('diplom_list').required = true;
            }else{
                document.getElementById('diplom_list').disabled = true;
                document.getElementById('diplom_list').required = false;
            }
        }
    </script>
    <script type="text/javascript">
        function statusFunction() {
            var status = document.getElementById("status");
            if (status.value == 'Potential' || status.value == 'Hold' || status.value == 'Interested'){
                document.getElementById('rate').disabled = false;
                document.getElementById('temperature').disabled = false;
                document.getElementById('next_call').disabled = false;
            } else if (status.value == 'Time/ Not Decided' || status.value == 'No Answer' || status.value == 'Out Of Reach'){
                document.getElementById('rate').disabled = true;
                document.getElementById('temperature').disabled = true;
                document.getElementById('next_call').disabled = false;
            } else if (status.value == 'Not Interested' || status.value == 'Student' || status.value == 'Applicant'){
                document.getElementById('rate').disabled = true;
                document.getElementById('temperature').disabled = true;
                document.getElementById('next_call').disabled = true;
            }
        }
    </script>

    <script type="text/javascript">
        function tempFunction() {
            var temp = document.getElementById("temperature");
            if(temp.value == 'Cold'){
                $('#rate').empty();
                $('#rate').append('<option></option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option>');
            }
            if(temp.value == 'Warm'){
                $('#rate').empty();
                $('#rate').append('<option></option><option value="6">6</option><option value="7">7</option><option value="8">8</option>');
            }
            if(temp.value == 'Hot'){
                $('#rate').empty();
                $('#rate').append('<option></option><option value="9">9</option><option value="10">10</option>');
            }
        }
    </script>

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

    <script type="text/javascript">
        $(document).ready(function() {
            $('.form-layout .form-control').on('focusin', function(){
                $(this).closest('.form-group').addClass('form-group-active');
            });
    
            $('.form-layout .form-control').on('focusout', function(){
                $(this).closest('.form-group').removeClass('form-group-active');
            });

            $('#activity_form').on('submit', function(event){
                event.preventDefault();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url:"{{ route('sales.activity.insert') }}",
                    method:"POST",
                    data:new FormData(this),
                    dataType:"json",
                    cache: false,
                    contentType : false,
                    processData: false,
                    success:function(data)
                    {
                        toastr.success(data.original.data.message, 'Success!', {timeOut: 5000});
                        window.location.href = "{{URL::to('/admin/sales/advisor-leads')}}";
                    },
                    error: function(data) { 
                        var error = data.responseJSON.errors;
                        $.each(error, function(k, v) {
                            toastr.error(v, 'Error!', {timeOut: 5000});
                        });
                    } 
                })
            });
        });
    </script>
@endsection