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
            @if(Route::currentRouteName()=='student.grades')
            @foreach($students as $item)
            $("#ckbox{{$item->id}}").change(function() {
                if(this.checked) {
                    $('#ckbox{{$item->id}}').val(1);
                    $('#checked{{$item->id}}').val({{$item->id}});
                }else{
                    $('#ckbox{{$item->id}}').val(0);
                }
            });
            @endforeach

            $("#checkall").change(function() {
                if(this.checked) {
                    @foreach($students as $item)
                        document.getElementById("ckbox{{$item->id}}").checked = true;
                        $('#ckbox{{$item->id}}').val(1);
                        $('#checked{{$item->id}}').val({{$item->id}});
                    @endforeach
                }else{
                    @foreach($students as $item)
                        document.getElementById("ckbox{{$item->id}}").checked = false;
                        $('#ckbox{{$item->id}}').val(0);
                    @endforeach
                }
            });

            $('#grades_datatable').DataTable({
                "columns": [
                    { "orderable": true },
                    { "orderable": true },
                    { "orderable": false },
                    { "orderable": false },
                    { "orderable": false },
                ],
                responsive: true,
                "pageLength": 25,
                language: {
                    searchPlaceholder: 'Search...',
                    sSearch: '',
                    lengthMenu: 'show _MENU_ items',
                }
            });
            @endif
    
            $('#students_datatable').DataTable({
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
        @if(Route::currentRouteName()=='admin.students.schedules' || Route::currentRouteName()=='admin.students.courses')
            $('#schedules_datatable').DataTable({
                "columns": [
                    { "orderable": false },
                    { "orderable": true },
                    { "orderable": true },
                    { "orderable": true },
                    { "orderable": true },
                ],
                responsive: true,
                "pageLength": 10,
                language: {
                    searchPlaceholder: 'Search...',
                    sSearch: '',
                    lengthMenu: 'show _MENU_ items',
                }
            });

            @foreach($students as $item)
            $("#ckbox{{$item->id}}").change(function() {
                if(this.checked) {
                    $('#ckbox{{$item->id}}').val(1);
                    $('#checked{{$item->id}}').val({{$item->id}});
                }else{
                    $('#ckbox{{$item->id}}').val(0);
                }
            });
            @endforeach

            $("#checkall").change(function() {
                if(this.checked) {
                    @foreach($students as $item)
                        document.getElementById("ckbox{{$item->id}}").checked = true;
                        $('#ckbox{{$item->id}}').val(1);
                        $('#checked{{$item->id}}').val({{$item->id}});
                    @endforeach
                }else{
                    @foreach($students as $item)
                        document.getElementById("ckbox{{$item->id}}").checked = false;
                        $('#ckbox{{$item->id}}').val(0);
                    @endforeach
                }
            });
        @endif
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
                    url:"{{route('program.destroy')}}",
                    mehtod:"get",
                    data:{id:delete_id},
                    dataType:"json",
                    success:function(data)
                    {
                        toastr.success(data.original.data.message, 'Success!', {timeOut: 5000});
                        window.location.href = "{{URL::to('/admin/student')}}"
                        
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
                    url:"{{ route('documents.upload') }}",
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

            $('#schedule_form').on('submit', function(event){
                event.preventDefault();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url:"{{ route('students.insertSchedule') }}",
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

                        400: function(data) {
                            toastr.error(data.responseJSON.data.message, 'Error!', {timeOut: 5000});
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

            $('#schedules_form').on('submit', function(event){
                event.preventDefault();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url:"{{ route('students.insertSchedules') }}",
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

                        400: function(data) {
                            toastr.error(data.responseJSON.data.message, 'Error!', {timeOut: 5000});
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

            $('#progress_form').on('submit', function(event){
                event.preventDefault();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url:"{{ route('students.insertProgress') }}",
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

            $('#grades_form').on('submit', function(event){
                event.preventDefault();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url:"{{ route('students.insertGrades') }}",
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

            $('#courses_form').on('submit', function(event){
                event.preventDefault();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url:"{{ route('students.insertCourses') }}",
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
    <script type="text/javascript">
        function ShowHideDiv() {
            var program = document.getElementById("program");
            var diplom = document.getElementById("diplom");
            var training = document.getElementById("training");
            var consulting = document.getElementById("consulting");
            if(program.checked){
                $('.select_data').removeClass("pmd-textfield-floating-label-active pmd-textfield-floating-label-completed");
                $('#diplom_list').empty();
                $('#diplom_intake').empty();
                $('#diplom_course').empty();
                $('#program_list').empty();
                $('#program_intake').empty();
                $('#program_course').empty();
                $('#training_list').empty();
                $('#program_list').append('<option selected>  </option>');
                $.ajax({
                    url:"{{route('ajaxdata.programs')}}",
                    method:'get',
                    dataType:'json',
                    success:function(data)
                    {
                        $.each(data, function(index, programObj){
                            $('#program_list').append('<option value="'+programObj.program_id+'">'+programObj.program_name+' - '+programObj.university_name+'</option>')
                        });
                    }
                });
                document.getElementById('program_list').disabled = false;
                document.getElementById('program_list').required = true;
                document.getElementById('diplom_intake').disabled = true;
                document.getElementById('diplom_course').disabled = true;
                document.getElementById("diplom_intakes").style.display = "none";
                document.getElementById("diplom_courses").style.display = "none";
                document.getElementById('diplom_intake').required = false;
                document.getElementById('diplom_course').required = false;
                document.getElementById('program_intake').required = true;
                document.getElementById('program_course').required = true;
            }else{
                document.getElementById('program_list').disabled = true;
                document.getElementById('program_list').required = false;
            }
            if(diplom.checked){
                $('.select_data').removeClass("pmd-textfield-floating-label-active pmd-textfield-floating-label-completed");
                $('#diplom_list').empty();
                $('#diplom_intake').empty();
                $('#diplom_course').empty();
                $('#program_list').empty();
                $('#program_intake').empty();
                $('#program_course').empty();
                $('#training_list').empty();
                $('#diplom_list').append('<option selected>  </option>');
                $.ajax({
                    url:"{{route('ajaxdata.diploms')}}",
                    method:'get',
                    dataType:'json',
                    success:function(data)
                    {
                        $.each(data, function(index, diplomObj){
                            $('#diplom_list').append('<option value="'+diplomObj.diplom_id+'">'+diplomObj.diplom_name+' - '+diplomObj.university_name+'</option>')
                        });
                    }
                });
                document.getElementById('diplom_list').disabled = false;
                document.getElementById('diplom_list').required = true;
                document.getElementById('program_intake').disabled = true;
                document.getElementById('program_course').disabled = true;
                document.getElementById("program_intakes").style.display = "none";
                document.getElementById("program_courses").style.display = "none";
                document.getElementById('diplom_intake').required = true;
                document.getElementById('diplom_course').required = true;
                document.getElementById('program_intake').required = false;
                document.getElementById('program_course').required = false;
            }else{
                document.getElementById('diplom_list').disabled = true;
                document.getElementById('diplom_list').required = false;
            }
            if(training.checked){
                $('.select_data').removeClass("pmd-textfield-floating-label-active pmd-textfield-floating-label-completed");
                $('#diplom_list').empty();
                $('#diplom_intake').empty();
                $('#diplom_course').empty();
                $('#program_list').empty();
                $('#program_intake').empty();
                $('#program_course').empty();
                $('#training_list').empty();
                $('#training_list').append('<option selected>  </option>');
                $.ajax({
                    url:"{{route('ajaxdata.courses')}}",
                    method:'get',
                    dataType:'json',
                    success:function(data)
                    {
                        $.each(data, function(index, courseObj){
                            $('#training_list').append('<option value="'+courseObj.id+'">'+courseObj.name+'</option>')
                        });
                    }
                });
                document.getElementById('training_list').disabled = false;
                document.getElementById('training_list').required = true;
                document.getElementById("program_intakes").style.display = "none";
                document.getElementById("program_courses").style.display = "none";
                document.getElementById("diplom_intakes").style.display = "none";
                document.getElementById("diplom_courses").style.display = "none";
            }else{
                document.getElementById('training_list').disabled = true;
                document.getElementById('training_list').required = false;
            }
            if(consulting.checked){
                $('.select_data').removeClass("pmd-textfield-floating-label-active pmd-textfield-floating-label-completed");
                $('#diplom_list').empty();
                $('#diplom_intake').empty();
                $('#diplom_course').empty();
                $('#program_list').empty();
                $('#program_intake').empty();
                $('#program_course').empty();
                $('#training_list').empty();
                document.getElementById('program_list').disabled = true;
                document.getElementById('program_list').required = false;
                document.getElementById('diplom_list').disabled = true;
                document.getElementById('diplom_list').required = false;
                document.getElementById('training_list').disabled = true;
                document.getElementById('training_list').required = false;
                document.getElementById("program_intakes").style.display = "none";
                document.getElementById("program_courses").style.display = "none";
                document.getElementById("diplom_intakes").style.display = "none";
                document.getElementById("diplom_courses").style.display = "none";
            }
        }
    </script>
    <script type="text/javascript">
        function programFunction() {
            document.getElementById('program_intake').disabled = false;
            document.getElementById('program_course').disabled = false;
            document.getElementById("program_intakes").style.display = "block";
            document.getElementById("program_courses").style.display = "block";
            var program_id = $('#program_list').val();
            $('#program_intake').empty();
            $('#program_intake').append('<option selected>  </option>');
                $.ajax({
                    url:"{{route('ajaxdata.program_intake')}}",
                    method:'get',
                    data:{id:program_id},
                    dataType:'json',
                    success:function(data)
                    {
                        $.each(data, function(index, programObj){
                            if(programObj.program_id == program_id){
                                $('#program_intake').append('<option value="'+programObj.id+'">'+programObj.name+'</option>')
                            }
                        });
                    }
                });
            $('#program_course').empty();
            $('#program_course').append('<option selected>  </option>');
                $.ajax({
                    url:"{{route('ajaxdata.program_course')}}",
                    method:'get',
                    data:{id:program_id},
                    dataType:'json',
                    success:function(data)
                    {
                        $.each(data, function(index, programObj){
                            if(programObj.program_id == program_id){
                                $('#program_course').append('<option value="'+programObj.id+'">'+programObj.name+'</option>')
                            }
                        });
                    }
                });
        }
    </script>
    <script type="text/javascript">
        function diplomFunction() {
            document.getElementById('diplom_intake').disabled = false;
            document.getElementById('diplom_course').disabled = false;
            document.getElementById("diplom_intakes").style.display = "block";
            document.getElementById("diplom_courses").style.display = "block";
            var diplom_id = $('#diplom_list').val();
            $('#diplom_intake').empty();
            $('#diplom_intake').append('<option selected>  </option>');
                $.ajax({
                    url:"{{route('ajaxdata.diplom_intake')}}",
                    method:'get',
                    data:{id:diplom_id},
                    dataType:'json',
                    success:function(data)
                    {
                        $.each(data, function(index, diplomObj){
                            if(diplomObj.diplom_id == diplom_id){
                                $('#diplom_intake').append('<option value="'+diplomObj.id+'">'+diplomObj.name+'</option>')
                            }
                        });
                    }
                });
            $('#diplom_course').empty();
            $('#diplom_course').append('<option selected>  </option>');
                $.ajax({
                    url:"{{route('ajaxdata.diplom_course')}}",
                    method:'get',
                    data:{id:diplom_id},
                    dataType:'json',
                    success:function(data)
                    {
                        $.each(data, function(index, diplomObj){
                            if(diplomObj.diplom_id == diplom_id){
                                $('#diplom_course').append('<option value="'+diplomObj.id+'">'+diplomObj.name+'</option>')
                            }
                        });
                    }
                });
        }
    </script>
    <script>
    $(document).ready(function() {
        var num3 = 1;
        var num = 2;
        var num2 = 3;
        var schedule = 1;
        $('.add_form_field3').click(function(){
            $('.schedule').append('<div id="empty_schedule_'+(num3)+'" class="col-lg-12"><p> <p></div>'+
                                   '<div class="col-lg-3" id="remove_schedule1_'+(num3)+'"><div class="form-group pmd-textfield pmd-textfield-floating-label"><label class="control-label">Type</label><select class="form-control" name="schedules['+num3+'][type]"><option></option><option value="Lecture 1">Lecture 1</option><option value="Lecture 2">Lecture 2</option><option value="Lecture 3">Lecture 3</option><option value="Lecture 4">Lecture 4</option><option value="Lecture 5">Lecture 5</option><option value="Lecture 6">Lecture 6</option><option value="Lecture 7">Lecture 7</option><option value="Lecture 8">Lecture 8</option><option value="Lecture 9">Lecture 9</option><option value="Lecture 10">Lecture 10</option><option value="Lecture 11">Lecture 11</option><option value="Lecture 12">Lecture 12</option><option value="Final Exam">Final Exam</option></select></div></div>'+
                                   '<div class="col-lg-3" id="remove_schedule2_'+(num3)+'"><div class="form-group pmd-textfield pmd-textfield-floating-label"><label class="control-label">Date</label><input type="text" class="form-control datepicker dpd" name="schedules['+num3+'][date]" data-date-format="dd-mm-yyyy" autocomplete="off"/></div></div>'+
                                   '<div class="col-lg-2" id="remove_schedule3_'+(num3)+'"><div class="form-group pmd-textfield pmd-textfield-floating-label"><label class="control-label">Time From</label><input type="text" class="form-control" id="tpBasic'+(num)+'" name="schedules['+num3+'][time_from]" autocomplete="off"/></div></div>'+
                                   '<div class="col-lg-2" id="remove_schedule4_'+(num3)+'"><div class="form-group pmd-textfield pmd-textfield-floating-label"><label class="control-label">Time To</label><input type="text" class="form-control" id="tpBasic'+(num2)+'" name="schedules['+num3+'][time_to]" autocomplete="off"/></div></div>'+
                                   '<div id="remove_schedule_button_'+(num3)+'" class="col-lg-2"><a class="btn btn-outline-danger remove_form_field3_'+(schedule)+'"><i class="fa fa-minus"></i> Remove</a></div>');
            num3 = num3+1;
            $('#tpBasic'+num).timepicker({
                timeFormat: 'h:i A',
            });
            $('#tpBasic'+num2).timepicker({
                timeFormat: 'h:i A',
            });
            num = num+1;
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
        $('.schedule').on('click', '.remove_form_field3_'+num3 , function(e) {
            e.preventDefault();
            num3 = num3-1;
            schedule = num3;
            $('#remove_schedule1_'+schedule).remove();
            $('#remove_schedule2_'+schedule).remove();
            $('#remove_schedule3_'+schedule).remove();
            $('#remove_schedule_button_'+schedule).remove();
            $('#empty_schedule_'+schedule).remove();
        });
    });
    </script>
@if(Route::currentRouteName()=='students.attendance')
    <script>
        $(document).ready(function() {
            $('#attendance_datatable').DataTable({
                "columns": [
                    { "orderable": false },
                    { "orderable": true },
                    { "orderable": true },
                    { "orderable": true },
                ],
                responsive: true,
                "pageLength": 10,
                language: {
                    searchPlaceholder: 'Search...',
                    sSearch: '',
                    lengthMenu: 'show _MENU_ items',
                }
            });
            $('#attendance_form').on('submit', function(event){
                event.preventDefault();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url:"{{ route('students.addAttendance') }}",
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
                                //window.location.href = "{{URL::to('/admin/student')}}"
                            }
                        },
                    },
                })
            });
        });
    </script>
    <script type="text/javascript">
        function ShowHideDiv() {
            var program = document.getElementById("program");
            var diplom = document.getElementById("diplom");
            var training = document.getElementById("training");
            var consulting = document.getElementById("consulting");
            if(program.checked){
                $('.select_data').removeClass("pmd-textfield-floating-label-active pmd-textfield-floating-label-completed");
                $('#diplom_list').empty();
                $('#diplom_course').empty();
                $('#program_list').empty();
                $('#program_course').empty();
                $('#training_list').empty();
                $('#program_list').append('<option selected>  </option>');
                $.ajax({
                    url:"{{route('ajaxdata.programs')}}",
                    method:'get',
                    dataType:'json',
                    success:function(data)
                    {
                        $.each(data, function(index, programObj){
                            $('#program_list').append('<option value="'+programObj.program_id+'">'+programObj.program_name+' - '+programObj.university_name+'</option>')
                        });
                    }
                });
                document.getElementById('program_list').disabled = false;
                document.getElementById('program_list').required = true;
                document.getElementById('diplom_course').disabled = true;
                document.getElementById("diplom_courses").style.display = "none";
                document.getElementById('diplom_course').required = false;
                document.getElementById('program_course').required = true;
            }else{
                document.getElementById('program_list').disabled = true;
                document.getElementById('program_list').required = false;
            }
            if(diplom.checked){
                $('.select_data').removeClass("pmd-textfield-floating-label-active pmd-textfield-floating-label-completed");
                $('#diplom_list').empty();
                $('#diplom_course').empty();
                $('#program_list').empty();
                $('#program_course').empty();
                $('#training_list').empty();
                $('#diplom_list').append('<option selected>  </option>');
                $.ajax({
                    url:"{{route('ajaxdata.diploms')}}",
                    method:'get',
                    dataType:'json',
                    success:function(data)
                    {
                        $.each(data, function(index, diplomObj){
                            $('#diplom_list').append('<option value="'+diplomObj.diplom_id+'">'+diplomObj.diplom_name+' - '+diplomObj.university_name+'</option>')
                        });
                    }
                });
                document.getElementById('diplom_list').disabled = false;
                document.getElementById('diplom_list').required = true;
                document.getElementById('program_course').disabled = true;
                document.getElementById("program_courses").style.display = "none";
                document.getElementById('diplom_course').required = true;
                document.getElementById('program_course').required = false;
            }else{
                document.getElementById('diplom_list').disabled = true;
                document.getElementById('diplom_list').required = false;
            }
            if(training.checked){
                $('.select_data').removeClass("pmd-textfield-floating-label-active pmd-textfield-floating-label-completed");
                $('#diplom_list').empty();
                $('#diplom_course').empty();
                $('#program_list').empty();
                $('#program_course').empty();
                $('#training_list').empty();
                $('#training_list').append('<option selected>  </option>');
                $.ajax({
                    url:"{{route('ajaxdata.courses')}}",
                    method:'get',
                    dataType:'json',
                    success:function(data)
                    {
                        $.each(data, function(index, courseObj){
                            $('#training_list').append('<option value="'+courseObj.id+'">'+courseObj.name+'</option>')
                        });
                    }
                });
                document.getElementById('training_list').disabled = false;
                document.getElementById('training_list').required = true;
                document.getElementById("program_courses").style.display = "none";
                document.getElementById("diplom_courses").style.display = "none";
            }else{
                document.getElementById('training_list').disabled = true;
                document.getElementById('training_list').required = false;
            }
            if(consulting.checked){
                $('.select_data').removeClass("pmd-textfield-floating-label-active pmd-textfield-floating-label-completed");
                $('#diplom_list').empty();
                $('#diplom_course').empty();
                $('#program_list').empty();
                $('#program_course').empty();
                $('#training_list').empty();
                document.getElementById('program_list').disabled = true;
                document.getElementById('program_list').required = false;
                document.getElementById('diplom_list').disabled = true;
                document.getElementById('diplom_list').required = false;
                document.getElementById('training_list').disabled = true;
                document.getElementById('training_list').required = false;
                document.getElementById("program_courses").style.display = "none";
                document.getElementById("diplom_courses").style.display = "none";
            }
        }
    </script>
    <script type="text/javascript">
        function programFunction() {
            document.getElementById('program_course').disabled = false;
            document.getElementById("program_courses").style.display = "block";
            var program_id = $('#program_list').val();
            $('#program_course').empty();
            $('#program_course').append('<option selected>  </option>');
                $.ajax({
                    url:"{{route('ajaxdata.program_course')}}",
                    method:'get',
                    data:{id:program_id},
                    dataType:'json',
                    success:function(data)
                    {
                        $.each(data, function(index, programObj){
                            if(programObj.program_id == program_id){
                                $('#program_course').append('<option value="'+programObj.id+'">'+programObj.name+'</option>')
                            }
                        });
                    }
                });
        }
    </script>
    <script type="text/javascript">
        function diplomFunction() {
            document.getElementById('diplom_course').disabled = false;
            document.getElementById("diplom_courses").style.display = "block";
            var diplom_id = $('#diplom_list').val();
            $('#diplom_course').empty();
            $('#diplom_course').append('<option selected>  </option>');
                $.ajax({
                    url:"{{route('ajaxdata.diplom_course')}}",
                    method:'get',
                    data:{id:diplom_id},
                    dataType:'json',
                    success:function(data)
                    {
                        $.each(data, function(index, diplomObj){
                            if(diplomObj.diplom_id == diplom_id){
                                $('#diplom_course').append('<option value="'+diplomObj.id+'">'+diplomObj.name+'</option>')
                            }
                        });
                    }
                });
        }
    </script>

    <script type="text/javascript">
        function searchFunction() {
            var doctor_id = parseInt($('#doctor_id').val());
            var diplom_course_id = parseInt($('#diplom_course').val());
            var program_course_id = parseInt($('#program_course').val());
            var training_course_id = parseInt($('#training_list').val());
            var date = $('#date').val();
            //console.log(program_course_id);
            console.log(doctor_id);
            console.log(date);
            if(diplom_course_id != null){
                $('#attendance_data').empty();
                $.ajax({
                    url:"{{route('ajaxdata.studentsAttendance')}}",
                    method:'get',
                    data:{doctor_id:doctor_id,diplom_course_id:diplom_course_id,date:date,},
                    dataType:'json',
                    success:function(data)
                    {
                        $.each(data, function(index, studentObj){
                            //console.log(studentObj.student_id);
                            $('#attendance_data').append('<tr><th><label class="ckbox"><input id="ckbox'+studentObj.student_id+'" name="check'+studentObj.student_id+'" type="checkbox"><span> </span></label><input value="'+studentObj.student_id+'" id="checked'+studentObj.student_id+'"  name="checked'+studentObj.student_id+'"  type="hidden"></th><th><a href="{{ route("students.profile" , ["id" => '+studentObj.student_id+']) }}">'+studentObj.student_name+' '+studentObj.student_middle_name+' '+studentObj.student_last_name+' </a></th><th>'+studentObj.mobile+'</th><th>'+studentObj.email+'</th>')
                            $('#ckbox'+studentObj.student_id).change(function() {
                                if(this.checked) {
                                    $('#ckbox'+studentObj.student_id).val(1);
                                    $('#checked'+studentObj.student_id).val(studentObj.student_id);
                                }else{
                                    $('#ckbox'+studentObj.student_id).val(0);
                                }
                            });
                        });
                    }
                });
            }

            if(program_course_id != null){
                $('#attendance_data').empty();
                $.ajax({
                    url:"{{route('ajaxdata.studentsAttendance')}}",
                    method:'get',
                    data:{doctor_id:doctor_id,program_course_id:program_course_id,date:date,},
                    dataType:'json',
                    success:function(data)
                    {
                        $.each(data, function(index, studentObj){
                            //console.log(studentObj.student_id);
                            $('#attendance_data').append('<tr><th><label class="ckbox"><input id="ckbox'+studentObj.student_id+'" name="check'+studentObj.student_id+'" type="checkbox"><span> </span></label><input value="'+studentObj.student_id+'" id="checked'+studentObj.student_id+'"  name="checked'+studentObj.student_id+'"  type="hidden"></th><th><a href="{{ route("students.profile" , ["id" => '+studentObj.student_id+']) }}">'+studentObj.student_name+' '+studentObj.student_middle_name+' '+studentObj.student_last_name+' </a></th><th>'+studentObj.mobile+'</th><th>'+studentObj.email+'</th>')
                            $('#ckbox'+studentObj.student_id).change(function() {
                                if(this.checked) {
                                    $('#ckbox'+studentObj.student_id).val(1);
                                    $('#checked'+studentObj.student_id).val(studentObj.student_id);
                                }else{
                                    $('#ckbox'+studentObj.student_id).val(0);
                                }
                            });
                        });
                    }
                });
            }

            if(training_course_id != null){
                $('#attendance_data').empty();
                $.ajax({
                    url:"{{route('ajaxdata.studentsAttendance')}}",
                    method:'get',
                    data:{doctor_id:doctor_id,training_course_id:training_course_id,date:date,},
                    dataType:'json',
                    success:function(data)
                    {
                        $.each(data, function(index, studentObj){
                            //console.log(studentObj.student_id);
                            $('#attendance_data').append('<tr><th><label class="ckbox"><input id="ckbox'+studentObj.student_id+'" name="check'+studentObj.student_id+'" type="checkbox"><span> </span></label><input value="'+studentObj.student_id+'" id="checked'+studentObj.student_id+'"  name="checked'+studentObj.student_id+'"  type="hidden"></th><th><a href="{{ route("students.profile" , ["id" => '+studentObj.student_id+']) }}">'+studentObj.student_name+' '+studentObj.student_middle_name+' '+studentObj.student_last_name+' </a></th><th>'+studentObj.mobile+'</th><th>'+studentObj.email+'</th>')
                            $('#ckbox'+studentObj.student_id).change(function() {
                                if(this.checked) {
                                    $('#ckbox'+studentObj.student_id).val(1);
                                    $('#checked'+studentObj.student_id).val(studentObj.student_id);
                                }else{
                                    $('#ckbox'+studentObj.student_id).val(0);
                                }
                            });
                        });
                    }
                });
            }

            
        }
    </script>
    @endif
@endsection