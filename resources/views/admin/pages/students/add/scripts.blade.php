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
    <script src="{{asset('vendors/lib/select2/js/select2.min.js')}}"></script>
    <script src="{{asset('vendors/lib/jquery-toggles/toggles.min.js')}}"></script>
    <script src="{{asset('vendors/lib/jt.timepicker/jquery.timepicker.js')}}"></script>
    <script src="{{asset('vendors/lib/spectrum/spectrum.js')}}"></script>
    <script src="{{asset('vendors/lib/jquery.maskedinput/jquery.maskedinput.js')}}"></script>
    <script src="{{asset('vendors/lib/bootstrap-summernote/summernote.min.js')}}"></script>
    <script src="{{asset('vendors/lib/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script>
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
        $("#ckbox1").change(function() {
            if(this.checked) {
                $('#ckbox1').val(1);
            }
        });

        $("#ckbox2").change(function() {
            if(this.checked) {
                $('#ckbox2').val(1);
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
            //$('#student_image').text($(this).val());
        });
    </script>
    <script type="text/javascript">
        function readURL2(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#blah2').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#imgInp2").change(function() {
            readURL2(this);
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
        $(document).ready(function() {
            $('#show_corporate').on('click', function (){
                document.getElementById("corporate_text").style.display = "block";
                document.getElementById("corporate_button").style.display = "block";
            });
            $('#submit_corporate').on('click', function (){
                var corporate = $('#corp_name').val();
                var corporate_id = parseInt(document.getElementById("corp_id").value);
                var new_id = corporate_id+1;
                $('#corp1').append('<option value="'+new_id+'">'+corporate+'</option>');
                $('#corp2').append('<option value="'+new_id+'">'+corporate+'</option>');
                document.getElementById("corporate_text").style.display = "none";
                document.getElementById("corporate_button").style.display = "none";
            });
            // Time Picker
            $('#tpBasic').timepicker();
            $('#tp2').timepicker({'scrollDefault': 'now'});
            $('#tp3').timepicker();

            $('#setTimeButton').on('click', function (){
            $('#tp3').timepicker('setTime', new Date());
            });
            $('.summernote').summernote({
                height: 250,
                popover: {
                    image: [],
                    link: [],
                    air: []
                },
                toolbar: [
                    // [groupName, [list of button]]
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['fontname', ['fontname']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['codeview']],
                  ],
                callbacks: {
                    onImageUpload: function (files, editor, welEditable) {
                        // upload image to server and create imgNode...
                        sendFile1(files[0], editor, welEditable);
                    }
                }
            });
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

            $('#student_form').on('submit', function(event){
                event.preventDefault();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url:"{{ route('students.insert') }}",
                    method:"POST",
                    data:new FormData(this),
                    dataType:"json",
                    cache: false,
                    contentType : false,
                    processData: false,
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
        });
    </script>
    <script>
    $(document).ready(function() {
        var corporates = '';
        @foreach($corporates as $corporate)
            corporates = corporates+'<option value="{{$corporate->id}}">{{$corporate->name}}</option>';
        @endforeach
        var num3 = 1;
        var corporate = 1;
        $('.add_form_field3').click(function(){
            $('.corporate').append('<div id="empty_corporate_'+(num3)+'" class="col-lg-12"><p> <p></div><div id="remove_corporate1_'+(num3)+'" class="col-lg-6"><div class="form-group pmd-textfield pmd-textfield-floating-label"><label class="control-label">Corporate</label><select style="width:100%" class="form-control pmd-select2 select2-show-search" name="corporates['+num3+'][corporate_id]""><option></option>'+corporates+'</select></div></div>'+
                                   '<div class="col-lg-6" id="remove_corporate2_'+(num3)+'"><div class="form-group pmd-textfield pmd-textfield-floating-label"><label class="control-label">Position</label><input type="text" class="form-control" name="corporates['+num3+'][position]"/></div></div>'+
                                   '<div class="col-lg-6" id="remove_corporate3_'+(num3)+'"><div class="form-group pmd-textfield pmd-textfield-floating-label"><label class="control-label">Date From</label><input type="text" class="form-control datepicker dpd" data-date-format="dd-mm-yyyy" name="corporates['+num3+'][from]"/></div></div>'+
                                   '<div class="col-lg-6" id="remove_corporate4_'+(num3)+'"><div class="form-group pmd-textfield pmd-textfield-floating-label"><label class="control-label">Date To</label><input type="text" class="form-control datepicker dpd" data-date-format="dd-mm-yyyy" name="corporates['+num3+'][to]"/></div></div>'+
                                   '<div id="remove_corporate_button_'+(num3)+'" class="col-lg-6"><a class="btn btn-outline-danger remove_form_field3_'+(corporate)+'"><i class="fa fa-minus"></i> Remove Corporate</a></div>');
            num3 = num3+1;
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
        $('.corporate').on('click', '.remove_form_field3_'+num3 , function(e) {
            e.preventDefault();
            num3 = num3-1;
            corporate = num3;
            $('#remove_corporate1_'+corporate).remove();
            $('#remove_corporate2_'+corporate).remove();
            $('#remove_corporate3_'+corporate).remove();
            $('#remove_corporate4_'+corporate).remove();
            $('#remove_corporate_button_'+corporate).remove();
            $('#empty_corporate_'+corporate).remove();
        });
    });
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
@endsection