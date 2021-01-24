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
        function readURL1(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#blah').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#imgInp").change(function() {
            readURL1(this);
        });
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
        $(document).ready(function() {
            $('.form-layout .form-control').on('focusin', function(){
                $(this).closest('.form-group').addClass('form-group-active');
            });
    
            $('.form-layout .form-control').on('focusout', function(){
                $(this).closest('.form-group').removeClass('form-group-active');
            });

            $('#ticket_form').on('submit', function(event){
                event.preventDefault();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url:"{{ route('tickets.insert') }}",
                    method:"POST",
                    data:new FormData(this),
                    dataType:"json",
                    cache: false,
                    contentType : false,
                    processData: false,
                    success:function(data)
                    {
                        toastr.success(data.original.data.message, 'Success!', {timeOut: 5000});
                        //window.history.back();
                        window.location.href = "{{URL::to('/admin/tickets')}}";
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
    <script type="text/javascript">
        function sourceFunction() {
            var source = document.getElementById("source_list");
            if(source.value == 'Referral'){
                document.getElementById("others").style.display = "none";
                document.getElementById("referral").style.display = "block";
                document.getElementById("other_input").value = "";
                document.getElementById('user_list').required = true;
                document.getElementById('other_input').required = false;
            }
            if(source.value == 'Others'){
                document.getElementById('other_input').disabled = false;
                document.getElementById('other_input').required = true;
                document.getElementById("others").style.display = "block";
                document.getElementById("referral").style.display = "none";
                document.getElementById("user_list").value = "";
                document.getElementById('user_list').required = false;
            }
            if(source.value != 'Others' && source.value != 'Referral'){
                document.getElementById('other_input').disabled = true;
                document.getElementById('other_input').required = false;
                document.getElementById("referral").style.display = "none";
                document.getElementById("others").style.display = "block";
                document.getElementById('user_list').required = false;
            }
        }
    </script>
@endsection