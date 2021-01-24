/**
 * 
 * admin-login
 */
(function($) {


    "use strict";
    var fromservices = {
        initialized: false,
        initialize: function() {
            if (this.initialized)
                return;
            this.initialized = true;
            this.build();
            this.events();
        },
        build: function() {
            this.validations();
        },
        events: function() {},
        validations: function() {
            var fromabout = $(".login-form"),
                url = fromabout.attr("action");
            fromabout.validate({
                submitHandler: function(form) {
                    var submitButton = $(this.submitButton);
                    // submitButton.button("loading");
                    $.ajax({
                        method: "POST",
                        url: url,
                        data: $(form).serialize(),
                        dataType: "json",
                        success: function(data) {
                            if (data.status == "success") {
                                $(".alerts-danger").stop().addClass("hidden");
                                $(".alerts-success").stop().removeClass("hidden").hide().fadeIn();

                                setTimeout(function() {
                                    $(".alerts-success").stop().fadeOut().addClass("hidden");
                                    //                                     window.open(data.url); 
                                    location.href = data.url;
                                }, 1500);
                                form.get[0].reset();
                            } else {

                                //                                $(".alert-danger").html(mess + '<br>' + data.data);
                                $(".alerts-danger").stop().removeClass("hidden").hide().fadeIn();
                                setTimeout(function() {
                                    $(".alerts-danger").stop().fadeOut().addClass("hidden");
                                    //                                     window.open(data.url); 
                                }, 2000);
                            }
                            form.get[0].reset();
                        },
                        complete: function() {
                            // submitButton.button("reset");
                        }
                    });
                },
                rules: {
                    email: {
                        required: true
                    },
                    password: {
                        required: true
                    },
                    type: {
                        required: true
                    }
                },
                highlight: function(element) {
                    $(element).parent().removeClass("has-success").addClass("has-error");
                    if (typeof $.fn.isotope !== 'undefined') {
                        $('.filter-elements').isotope('layout');
                    }
                },
                success: function(element) {
                    $(element).parent().removeClass("has-error").addClass("has-success").find("label.error").remove();
                }
            });
            $.ajaxSetup({
                headers: {

                    'csrf_token': $('[name="csrf_token"]').attr('content')
                }
            });
        }
    };
    fromservices.initialize();
})(jQuery);