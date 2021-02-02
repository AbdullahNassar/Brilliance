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
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#blah').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#imgInp").change(function() {
            readURL(this);
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
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#employees_datatable').DataTable({
                "columns": [
                    { "orderable": true },
                    { "orderable": true },
                    { "orderable": true },
                    { "orderable": true },
                    { "orderable": true },
                    { "orderable": true },
                    { "orderable": false },
                ],
                responsive: true,
                "pageLength": 10,
                language: {
                    searchPlaceholder: 'Search...',
                    sSearch: '',
                    lengthMenu: 'show _MENU_ items',
                }
            });

            $('.form-layout .form-control').on('focusin', function(){
                $(this).closest('.form-group').addClass('form-group-active');
            });
    
            $('.form-layout .form-control').on('focusout', function(){
                $(this).closest('.form-group').removeClass('form-group-active');
            });
    
            // Input Masks
            $('#dateMask').mask('99/99/9999');
    
            // Time Picker
            $('#tpBasic0').timepicker({
                timeFormat: 'h:i A',
            });
            $('#tpBasic1').timepicker({
                timeFormat: 'h:i A',
            });
            
            var delete_id = 0;
            $(document).on('click', '.btndelet', function(){
                delete_id = $(this).attr("id");
                $('#delete-modal').modal('show');
            });

            $(document).on('click', '.btndel', function(){
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url:"{{route('employee.destroy')}}",
                    mehtod:"get",
                    data:{id:delete_id},
                    dataType:"json",
                    success:function(data)
                    {
                        toastr.success(data.original.data.message, 'Success!', {timeOut: 5000});
                        window.location.href = "{{URL::to('/admin/employee')}}"
                        
                    },
                    error: function(data) { 
                        var error = data.responseJSON.errors;
                        $.each(error, function(k, v) {
                            toastr.error(v, 'Error!', {timeOut: 5000});
                        });
                    } 
                })
            });
        
            $('#document_form').on('submit', function(event){
                event.preventDefault();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url:"{{ route('employee-upload-file') }}",
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
                                location.reload(); 
                            }
                        },
                    },
                    xhr: function(){
                        // get the native XmlHttpRequest object
                        var xhr = $.ajaxSettings.xhr() ;
                        // set the onprogress event handler
                        xhr.upload.onprogress = function(evt){
                             document.getElementById("progress_bar").style.display = "block";
                                var i = 0;
                                if (i == 0) {
                                    i = 1;
                                    var elem = document.getElementById("myBar");
                                    var width = 10;
                                    var id = setInterval(frame, 10);
                                    function frame() {
                                    if (width >= 100) {
                                        clearInterval(id);
                                        i = 0;
                                    } else {
                                        width++;
                                        elem.style.width = width + "%";
                                        elem.innerHTML = width  + "%";
                                    }
                                    }
                                }
                        } ;
                        // set the onload event handler
                        xhr.upload.onload = function(){ console.log('DONE!') } ;
                        // return the customized object
                        return xhr ;
                    }
                })
            });

        });
    </script>
@endsection