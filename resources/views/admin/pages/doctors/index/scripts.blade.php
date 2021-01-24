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
            $('#doctors_datatable').DataTable({
                "columns": [
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
            $('#tpBasic0').timepicker();
            $('#tpBasic1').timepicker();
            
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
                        location.reload();
                        
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
                                location.reload();
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
                    url:"{{ route('doctors.insertSchedule') }}",
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
                $('#program_list').append('<option>  </option>');
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
                $('#diplom_list').append('<option>  </option>');
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
                            $('#program_intake').append('<option value="'+programObj.id+'">'+programObj.name+'</option>')
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
                            $('#program_course').append('<option value="'+programObj.id+'">'+programObj.name+'</option>')
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
                            $('#diplom_intake').append('<option value="'+diplomObj.id+'">'+diplomObj.name+'</option>')
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
                            $('#diplom_course').append('<option value="'+diplomObj.id+'">'+diplomObj.name+'</option>')
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
                                   '<div class="col-lg-4" id="remove_schedule1_'+(num3)+'"><div class="form-group pmd-textfield pmd-textfield-floating-label"><label class="control-label">Date</label><input type="text" class="form-control datepicker dpd" name="schedules['+num3+'][date]" data-date-format="dd-mm-yyyy"/></div></div>'+
                                   '<div class="col-lg-3" id="remove_schedule2_'+(num3)+'"><div class="form-group pmd-textfield pmd-textfield-floating-label"><label class="control-label">Time From</label><input type="text" class="form-control" id="tpBasic'+(num)+'" name="schedules['+num3+'][time_from]"/></div></div>'+
                                   '<div class="col-lg-3" id="remove_schedule3_'+(num3)+'"><div class="form-group pmd-textfield pmd-textfield-floating-label"><label class="control-label">Time To</label><input type="text" class="form-control" id="tpBasic'+(num2)+'" name="schedules['+num3+'][time_to]"/></div></div>'+
                                   '<div id="remove_schedule_button_'+(num3)+'" class="col-lg-2"><a class="btn btn-outline-danger remove_form_field3_'+(schedule)+'"><i class="fa fa-minus"></i> Remove</a></div>');
            num3 = num3+1;
            $('#tpBasic'+num).timepicker();
            $('#tpBasic'+num2).timepicker();
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
@endsection