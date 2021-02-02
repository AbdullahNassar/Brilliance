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
                    url:"{{ route('students.update') }}",
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
                        //location.reload();
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
        });
    </script>
    <script>
    $(document).ready(function() {
        var num3 = 1;
        var contact = 1;
        $('.add_form_field3').click(function(){
            $('.contact').append('<div id="empty_contact_'+(num3)+'" class="col-lg-12"><p> <p></div><div id="remove_contact1_'+(num3)+'" class="col-lg-6"><div class="form-group pmd-textfield pmd-textfield-floating-label"><label class="control-label">Name</label><input type="text" class="form-control" name="contacts['+num3+'][name]"/></div></div>'+
                                   '<div class="col-lg-6" id="remove_contact2_'+(num3)+'"><div class="form-group pmd-textfield pmd-textfield-floating-label"><label class="control-label">Position</label><input type="text" class="form-control" name="contacts['+num3+'][position]"/></div></div>'+
                                   '<div class="col-lg-6" id="remove_contact3_'+(num3)+'"><div class="form-group pmd-textfield pmd-textfield-floating-label"><label class="control-label">Email</label><input type="text" class="form-control" name="contacts['+num3+'][email]"/></div></div>'+
                                   '<div class="col-lg-6" id="remove_contact4_'+(num3)+'"><div class="form-group pmd-textfield pmd-textfield-floating-label"><label class="control-label">Mobile</label><input type="text" class="form-control" name="contacts['+num3+'][mobile]"/></div></div>'+
                                   '<div id="remove_contact_button_'+(num3)+'" class="col-lg-6"><a class="btn btn-outline-danger remove_form_field3_'+(contact)+'"><i class="fa fa-minus"></i> Remove contact</a></div>');
            num3 = num3+1;
            $('#num3').val(num3); 
        });
        $('.contact').on('click', '.remove_form_field3_'+num3 , function(e) {
            e.preventDefault();
            num3 = num3-1;
            contact = num3;
            $('#remove_contact1_'+contact).remove();
            $('#remove_contact2_'+contact).remove();
            $('#remove_contact3_'+contact).remove();
            $('#remove_contact4_'+contact).remove();
            $('#remove_contact5_'+contact).remove();
            $('#remove_contact6_'+contact).remove();
            $('#remove_contact_button_'+contact).remove();
            $('#empty_contact_'+contact).remove();
        });
    });
    </script>
@endsection