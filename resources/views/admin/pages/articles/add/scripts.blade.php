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
    <script src="{{ asset('vendors/js/croppie.js') }}"></script>
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
        /* Nice Scroll */
        $(document).ready(function() {
            "use strict";
            $("html").niceScroll({
                scrollspeed: 60,
                mousescrollstep: 35,
                cursorwidth: 5,
                cursorcolor: '#39b586',
                cursorborder: 'none',
                background: 'rgba(57, 181, 134, 0.5)',
                cursorborderradius: 3,
                autohidemode: false,
                cursoropacitymin: 0.1,
                cursoropacitymax: 1,
                zindex: "999",
                horizrailenabled: false
            });
            
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $("#ckbox1").change(function() {
                if(this.checked) {
                    $('#ckbox1').val(1);
                }
            });
            $('.summernote1').summernote({
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
            $('.summernote1').summernote('justifyLeft');
            $('.summernote1').summernote('lineHeight', 0.5);
            $('.summernote2').summernote({
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
                        sendFile2(files[0], editor, welEditable);
                    }
                }
            });
            $('.summernote2').summernote('justifyRight');
            $('.summernote2').summernote('lineHeight', 0.5);
            function sendFile1(file, editor, welEditable) {
                console.log(file);
                data = new FormData();
                data.append("file", file);
                data.append("_token", '{{csrf_token()}}');
                $.ajax({
                    url: "{{route('editor.upload')}}",
                    data: data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    type: 'POST',
                    success: function (data) {
                        console.log(data);
                        if(data=='error')
                        {
                            alert("Error while uploading");
                        }else{
                            var image = $('<img>').attr('src', data);
                            $(document.getSelection().anchorNode.parentNode).append(image);
                        }

                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log("Error while uploading");
                    }
                });
            }
            function sendFile2(file, editor, welEditable) {
                console.log(file);
                data = new FormData();
                data.append("file", file);
                data.append("_token", '{{csrf_token()}}');
                $.ajax({
                    url: "{{route('editor.upload')}}",
                    data: data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    type: 'POST',
                    success: function (data) {
                        console.log(data);
                        if(data=='error')
                        {
                            alert("Error while uploading");
                        }else{
                            var image = $('<img>').attr('src', data);
                            $(document.getSelection().anchorNode.parentNode).append(image);
                        }

                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log("Error while uploading");
                    }
                });
            }

            $('.form-layout .form-control').on('focusin', function(){
                $(this).closest('.form-group').addClass('form-group-active');
            });
    
            $('.form-layout .form-control').on('focusout', function(){
                $(this).closest('.form-group').removeClass('form-group-active');
            });

            $('#draft').click(function(){
                $('#submitbutton').val('draft'); 
            });

            $('#publish').click(function(){
                $('#submitbutton').val('publish'); 
            });

            $('#article_form').on('submit', function(event){
                event.preventDefault();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url:"{{ route('articles.insert') }}",
                    method:"POST",
                    data:new FormData(this),
                    dataType:"json",
                    cache: false,
                    contentType : false,
                    processData: false,
                    success:function(data)
                    {
                        toastr.success(data.original.data.message, 'Success!', {timeOut: 5000});
                        window.location.href = "{{URL::to('/admin/articles')}}"
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
        $(document).ready(function(){
        
        $image_crop = $('#image-preview').croppie({
            enableExif:true,
            enableOrientation: true, 
            viewport: { // Default { width: 100, height: 100, type: 'square' } 
                width: 670,
                height: 360,
                type: 'square' //square
            },
            boundary: {
                width: 800,
                height: 400
            }
        });

        $('#upload_image').change(function(){
            var reader = new FileReader();

            reader.onload = function(e){
                $image_crop.croppie('bind', {
                    url: e.target.result
                }).then(function(){
                    console.log('jQuery bind complete');
                });
            }
            reader.readAsDataURL(this.files[0]);
        });

        $('.crop_image').click(function(event){
            $image_crop.croppie('result', {
            type:'canvas',
            size:'viewport'
            }).then(function(response){
            var _token = $('input[name=_token]').val();
            html = '<img src="' + response + '" />';
            $("#uploaded_image").html(html);
            $.ajax({
                url:'{{ route("image_crop.upload") }}',
                type:'post',
                data:{"image":response, _token:_token},
                dataType:"json",
                success:function(data)
                {
                    $("#image_name").val(data.name);
                    $("#upload-success").html('Image cropped and uploaded successfully.<br> {{asset("images/articles/")}}/'+ data.name + '');
                    $("#upload-success").show();
                }
            });
            });
        });
        
        });  
    </script>
@endsection