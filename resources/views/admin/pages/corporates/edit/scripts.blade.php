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
        $(document).ready(function() {
            $('.summernote').summernote({
                height: 250,
                popover: {
                    image: [],
                    link: [],
                    air: []
                }
            });
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
            
            $('#corporate_form').on('submit', function(event){
                event.preventDefault();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url:"{{ route('corporates.update') }}",
                    method:"POST",
                    data:new FormData(this),
                    dataType:"json",
                    cache: false,
                    contentType : false,
                    processData: false,
                    success:function(data)
                    {
                        toastr.success(data.original.data.message, 'Success!', {timeOut: 5000});
                        window.location.href = "{{URL::to('/admin/corporates')}}"
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
        var num3 = 1;
        var number3 = parseInt(document.getElementById("number3").value);
        var contact = 1;
        var check = 0;
        $('.add_form_field3').click(function(){
            $('.contact').append('<div id="empty_contact_'+(num3)+'" class="col-lg-12"><p> <p></div><div id="remove_contact1_'+(num3)+'" class="col-lg-6"><div class="form-group pmd-textfield pmd-textfield-floating-label"><label class="control-label">Name</label><input type="text" class="form-control" name="contacts['+number3+'][name]"/></div></div>'+
                                   '<div class="col-lg-6" id="remove_contact2_'+(num3)+'"><div class="form-group pmd-textfield pmd-textfield-floating-label"><label class="control-label">Position</label><input type="text" class="form-control" name="contacts['+number3+'][position]"/></div></div>'+
                                   '<div class="col-lg-6" id="remove_contact3_'+(num3)+'"><div class="form-group pmd-textfield pmd-textfield-floating-label"><label class="control-label">Email</label><input type="text" class="form-control" name="contacts['+number3+'][email]"/></div></div>'+
                                   '<div class="col-lg-6" id="remove_contact4_'+(num3)+'"><div class="form-group pmd-textfield pmd-textfield-floating-label"><label class="control-label">Mobile</label><input type="text" class="form-control" name="contacts['+number3+'][mobile]"/></div></div>'+
                                   '<div class="col-lg-6" id="remove_contact5_'+(num3)+'"><div class="form-group"><label class="ckbox"><input id="ckbox'+(check)+'" name="contacts['+check+'][default]" type="checkbox" value="0"><span>Default</span></label></div></div>'+
                                   '<div id="remove_contact_button_'+(num3)+'" class="col-lg-6"><a class="btn btn-outline-danger remove_form_field3_'+(contact)+'"><i class="fa fa-minus"></i> Remove contact</a></div>');
            $("#ckbox").change(function() {
                if(this.checked) {
                    $('#ckbox').val(1);
                }else{
                    $('#ckbox').val(0);
                }
            });
            $("#ckbox0").change(function() {
                if(this.checked) {
                    $('#ckbox0').val(1);
                }else{
                    $('#ckbox0').val(0);
                }
            });
            $("#ckbox1").change(function() {
                if(this.checked) {
                    $('#ckbox1').val(1);
                }else{
                    $('#ckbox1').val(0);
                }
            });
            $("#ckbox2").change(function() {
                if(this.checked) {
                    $('#ckbox2').val(1);
                }else{
                    $('#ckbox2').val(0);
                }
            });
            $("#ckbox3").change(function() {
                if(this.checked) {
                    $('#ckbox3').val(1);
                }else{
                    $('#ckbox3').val(0);
                }
            });
            $("#ckbox4").change(function() {
                if(this.checked) {
                    $('#ckbox4').val(1);
                }else{
                    $('#ckbox4').val(0);
                }
            });
            $("#ckbox5").change(function() {
                if(this.checked) {
                    $('#ckbox5').val(1);
                }else{
                    $('#ckbox5').val(0);
                }
            });
            $("#ckbox6").change(function() {
                if(this.checked) {
                    $('#ckbox6').val(1);
                }else{
                    $('#ckbox6').val(0);
                }
            });
            $("#ckbox7").change(function() {
                if(this.checked) {
                    $('#ckbox7').val(1);
                }else{
                    $('#ckbox7').val(0);
                }
            });
            $("#ckbox8").change(function() {
                if(this.checked) {
                    $('#ckbox8').val(1);
                }else{
                    $('#ckbox8').val(0);
                }
            });
            $("#ckbox9").change(function() {
                if(this.checked) {
                    $('#ckbox9').val(1);
                }else{
                    $('#ckbox9').val(0);
                }
            });
            num3 = num3 + 1;
            check = check + 1;
            number3 = number3 + 1;
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
            $('#remove_contact_button_'+contact).remove();
            $('#empty_contact_'+contact).remove();
        });
    });
    $("#ckbox").change(function() {
                if(this.checked) {
                    $('#ckbox').val(1);
                }else{
                    $('#ckbox').val(0);
                }
            });
            $("#ckbox0").change(function() {
                if(this.checked) {
                    $('#ckbox0').val(1);
                }else{
                    $('#ckbox0').val(0);
                }
            });
            $("#ckbox1").change(function() {
                if(this.checked) {
                    $('#ckbox1').val(1);
                }else{
                    $('#ckbox1').val(0);
                }
            });
            $("#ckbox2").change(function() {
                if(this.checked) {
                    $('#ckbox2').val(1);
                }else{
                    $('#ckbox2').val(0);
                }
            });
            $("#ckbox3").change(function() {
                if(this.checked) {
                    $('#ckbox3').val(1);
                }else{
                    $('#ckbox3').val(0);
                }
            });
            $("#ckbox4").change(function() {
                if(this.checked) {
                    $('#ckbox4').val(1);
                }else{
                    $('#ckbox4').val(0);
                }
            });
            $("#ckbox5").change(function() {
                if(this.checked) {
                    $('#ckbox5').val(1);
                }else{
                    $('#ckbox5').val(0);
                }
            });
            $("#ckbox6").change(function() {
                if(this.checked) {
                    $('#ckbox6').val(1);
                }else{
                    $('#ckbox6').val(0);
                }
            });
            $("#ckbox7").change(function() {
                if(this.checked) {
                    $('#ckbox7').val(1);
                }else{
                    $('#ckbox7').val(0);
                }
            });
            $("#ckbox8").change(function() {
                if(this.checked) {
                    $('#ckbox8').val(1);
                }else{
                    $('#ckbox8').val(0);
                }
            });
            $("#ckbox9").change(function() {
                if(this.checked) {
                    $('#ckbox9').val(1);
                }else{
                    $('#ckbox9').val(0);
                }
            });
    </script>
@endsection