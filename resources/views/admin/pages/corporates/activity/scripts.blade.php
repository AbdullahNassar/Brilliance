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
    <script src="{{asset('vendors/js/custom-file-input.js')}}"></script>
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
            var training = document.getElementById("training");
            var consulting = document.getElementById("consulting");
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
            if(training.checked){
                document.getElementById('training_list').disabled = false;
                document.getElementById('training_list').required = true;
            }else{
                document.getElementById('training_list').disabled = true;
                document.getElementById('training_list').required = false;
            }
            if(consulting.checked){
                document.getElementById('program_list').disabled = true;
                document.getElementById('program_list').required = false;
                document.getElementById('diplom_list').disabled = true;
                document.getElementById('diplom_list').required = false;
                document.getElementById('training_list').disabled = true;
                document.getElementById('training_list').required = false;
            }
        }
    </script>
    <script type="text/javascript">
        function statusFunction() {
            var status = document.getElementById("status");
            if(status.value != 'Close'){
                document.getElementById('next_call').disabled = false;
            }else{
                document.getElementById('next_call').disabled = true;
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
            $('#file2').change(function() {
                var i = $(this).prev('label').clone();
                var file = $('#file-upload2')[0].files[0].name;
                $(this).prev('label').text(file);
            });
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
                    url:"{{ route('corporates.addActivity') }}",
                    method:"POST",
                    data:new FormData(this),
                    dataType:"json",
                    cache: false,
                    contentType : false,
                    processData: false,
                    success:function(data)
                    {
                        toastr.success(data.original.data.message, 'Success!', {timeOut: 5000});
                        window.location.href = "{{URL::to('/admin/corporates')}}";
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