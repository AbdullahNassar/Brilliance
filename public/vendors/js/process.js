/*global $*/
(function () {



    /* Date range picker and SummerNote Eitor Trigger Code
    =======================================================*/
    $(document).ready(function () {
        "use strict";
        
        
        $('.summernote').summernote({height: 200});
        
        
    });

    /***************************************************************************
     * Common Ajax Delete Section
     **************************************************************************/

    $(document).on('click', ".ajax-delete", function (e) {
        e.preventDefault();
        var $this = $(this);
        var url = $this.data('url');
        var originalHtml = $this.html();
        var altText = loading;
        var notification = 'm';
        if ($this.data('loading') !== undefined) {
            altText = $this.data('loading');
        }
        $this.prop('disabled', true).html(altText);

        // if ($this.data('notification') !== undefined) {
        //     notification = $this.data('notification');
        // }

        request(url, csrf, function (result) {
            // notify(result.status, result.title, result.msg, notification);
            $this.prop('disabled', false).html(originalHtml);
            $this.closest('.ajax-target').remove();

        }, function () {
            alert('Internal Server Error.');
        });
    });
    /***************************************************************************
     * Comprehensive Ajax Form Section
     **************************************************************************/

    $(document).on('click', ".ajax-submit", function (e) {
        e.preventDefault();
        var ajaxSubmit = $(this);
        var form = $(this).closest('form');
        var url = form.attr('action');
        var method = form.attr('method');
        var ajaxSubmitHtml = ajaxSubmit.html();
        var altText = loading;
        var notification = 'm';

        if (!form.length) {
            var csrf_token = $('meta[name=csrf]').attr('content');
            form = $('<form></form>')
                    .html('<input type="hidden" name="_token" value="' + csrf_token + '"/>');
        }

        if (ajaxSubmit.data('url') !== undefined) {
            url = ajaxSubmit.data('url');
        }

        if (ajaxSubmit.data('method') !== undefined) {
            method = ajaxSubmit.data('method');
        } else if (method == undefined || method == '') {
            method = 'post';
        }

        if (form.data('notification') !== undefined) {
            notification = form.data('notification');
        }

        if (ajaxSubmit.data('notification') !== undefined) {
            notification = ajaxSubmit.data('notification');
        }

        if (form.data('loading') !== undefined) {
            altText = form.data('loading');
        }

        if (ajaxSubmit.data('loading') !== undefined) {
            altText = ajaxSubmit.data('loading');
        }

        ajaxSubmit.prop('disabled', true).html(altText);

        var formData = null;
        if (method.toLowerCase() == 'get') {
            formData = form.serialize();
        } else {
            formData = new FormData(form[0]);
            if (form.find('.tiny-editor').length) {
                for (var i = 0; i < tinymce.editors.length; i++) {
                    formData.append('editor' + (i + 1), tinymce.editors[i].getContent());
                }
            }
        }

        request(url, formData, function (result) {
            ajaxSubmit.prop('disabled', false).html(ajaxSubmitHtml);
            if (result.redirect) {
                window.setTimeout(function () {
                    window.location.href = result.redirect;
                }, ((result.after) ? result.after : 0));
            }

            if (result.modal && result.html) {
                commonModal.html(result.html).modal('toggle');
                return;
            }

            if (result.element && result.html) {
                $(result.element).html(result.html);
                return;
            }

            if (result.paginate) {
                $('.pagination-container .pagination-wrapper a:first').click();
            }

            if (result.closest && result.delete) {
                ajaxSubmit.closest(result.closest).remove();
            }

            if (result.element && result.delete) {
                $(result.element).remove();
            }

            if (result.reload) {
                location.reload(0);
                return;
            }
            if (result.notify == false) {
                return;
            }
            notify(result.status, result.title, result.msg, notification);
        }, function (request, error) {
            console.log(arguments);
            alert('Internal Server Error.');
        }, method);
    });
    /***************************************************************************
     * Modal View Modal
     **************************************************************************/

    $(document).on('click', '.btn-modal-view', function () {
        var $this = $(this);
        var url = $this.data('url');
        var data_lang = "lang=" + $this.data('lang');
        if ($this.find('.tiny-editor').length) {
            for (var i = 0; i < tinymce.editors.length; i++) {
                formData.append('editor' + (i + 1), tinymce.editors[i].getContent());
            }
        }

        var originalHtml = $this.html();
        //$this.prop('disabled', true).html('loading...');
        request(url, data_lang, function (data) {
            $this.prop('disabled', false).html(originalHtml);
            $('#common-modal').html(data).modal('toggle');
        }, function () {
            alert('Error');
        }, 'get');
    });

    $('.approveBTN').click(function (e) {
//         alert('ckdmcksc');
        // $('.approveBTN').html(loading);
        $.ajax({
            url: $(this).data('url'),
            data: {'id': $(this).data('id'), '_token': $(this).data('token')},
            method: 'POST',
            success: function (data) {
                location.reload();
            },
            error: function (data) {

            }
        });
    });

    //////////////////////////////////
    /***************************************************************************
     * Custom logging function
     * @param mixed data
     * @returns void
     **************************************************************************/
    function _(data) {
        console.log(data);
    }
    //////////////////// for send subscribtion messege //////////////////////////////
    $(document).on("submit", ".new-form", function (e) {
        e.preventDefault();
        // var $this = $(this);
//        $('#loadmodel').show();
        var url = $(this).attr('action');
        var ajaxSubmit = $(this).find('.new-submit');
        ajaxSubmit.html(loading);
        var ajaxSubmitHtml = ajaxSubmit.html();
        var altText = loading;
        var notification = 'm';
        if (ajaxSubmit.data('loading') !== undefined) {
            altText = ajaxSubmit.data('loading');
        }
        //ajaxSubmit.prop('disabled', true).html(altText);
        var formData = new FormData(this);
        if ($(this).find('.tiny-editor').length) {
            for (var i = 0; i < tinymce.editors.length; i++) {
                formData.append('editor' + (i + 1), tinymce.editors[i].getContent());
            }
        }
        if ($(this).data('url') !== undefined) {
            url = $(this).data('url');
        }
        if ($(this).data('notification') !== undefined) {
            notification = $(this).data('notification');
        }
        request(url, formData, function (result) {
            // altText.show();
            if (result.status) {
//                $('#loadmodel').show();
                swal({title: " Done", text: result.data, type: "success"}, function () {
                    location.reload(true);
                });
            } else {
//                $('#loadmodel').show();
                swal('Error.', result.data, 'error');
            }
        });
    });
    var AddModalBtn = $('.addBTN');
    // var modelName = $('.add').attr('href');
    AddModalBtn.on('click', function () {
        var AddModalForm = $(this).closest('form');
        var formData = new FormData(AddModalForm[0]);

        if (typeof tinymce !== "undefined" && tinymce.editors.length) {
            for (var i = 0; i < tinymce.editors.length; i++) {
                formData.append('desc' + (i + 1), tinymce.editors[i].getContent());
            }
        }
        request(AddModalForm.attr('action'), formData,
                // on request success handler
                        function (result) {
                            if (result.status) {
                                swal({title: "Done", text: result.data, type: "success"}, function () {
                                    location.reload(true);
                                });
                            } else {
                                swal('Error', result.data, 'error');
                            }
                        },
                        // on request failure handler
                                function () {
                                    alert('Internal Server Error.');
                                }, function (e) {

                            var videoProgress = $('.progress-bar');

                            var progress = Math.round(e.loaded / e.total * 100);
                            videoProgress.css('width', progress + '%');
                        });
                    });

            $('.btndelet').click(function (e) {

                var txt = $('#template-modal').html();
                var url = $(this).attr('data-url');
                txt = txt.replace(new RegExp('{url}', 'g'), url);
                $('#delete-modal .modal-dialog').html(txt);
                $('#delete-modal').modal('show');
                e.preventDefault()
            });

            /***************************************************************************
             * Search input events for filtered table
             **************************************************************************/
            var tableData = $('#ajax-table');
            $(document).on('click', '#ajax-table .pagination a', function (e) {
                var $this = $(this);
                tableData.html(loading);
                $.ajax({
                    url: $this.attr('href'),
                }).done(function (data) {
                    tableData.html(data);
                }).fail(function () {
                    alert('Internal Server Error.');
                });
                e.preventDefault();
            });
            var inputSearch = $('#input-search');
            $(document).on('click', '.btn-search', function () {
                var form = $(this).closest('form');
                var search = (inputSearch.val().length) ? "/" + inputSearch.val() : "";
                tableData.html(loading);
                request(form.attr('action') + "/search" + search, null, function (data) {
                    tableData.html(data);
                }, function () {
                    alert('Internal Server Error');
                }, 'get');
            });
            /**************************************************************************
             * Actions Of Filters Buttons
             ***************************************************************************/

            $(document).on('change', '.btn-filter', function () {
                var $this = $(this);
                var filter = $this.data('filter');
                tableData.html(loading);
                var form = $this.closest('form');
                request(form.attr('action') + "/filter/" + filter, null, function (data) {
                    tableData.html(data);
                }, function () {
                    alert('Internal Server Error.');
                }, 'get');
            });
            /**************************************************************************
             * Events Action Buttons for the tables
             **************************************************************************/

            $(document).on('click', '.btn-action', function (e) {
                var $this = $(this);
                var action = $this.data('action');
                var form = $this.closest('form');
                request(form.attr('action') + "/action/" + action, new FormData(form[0]), function (data) {
                    if (data.status === 'success') {
                        notify(data.status, data.title, data.msg, function () {
                            $('input[data-filter=all]').change();
                        });
                    } else {
                        notify(data.status, data.title, data.msg);
                    }
                }, function () {
                    alert('Internal Server Error.');
                });
                e.preventDefault();
            });

            /***************************************************************************
             * Check ALL Button For Table Rows
             ***************************************************************************/

            $(document).on('click', '#chk-all', function () {
                $('.chk-box').prop('checked', this.checked);
            });

            ///////////////////////////////////// End Admin Panel Ajax  ////////////////////////////////////////

            //////////////////////////////////////// Site Ajax  //////////////////////////////////////////////////


            /***************************************************************************
             * Custom Ajax request function
             * @param string url
             * @param mixed|FormData data
             * @param callable(data) completeHandler
             * @param callable errorHandler
             * @param callable progressHandler
             * @returns void
             **************************************************************************/
            function _(data) {
                console.log(data);
            }

            function request(url, data, completeHandler, errorHandler, progressHandler) {
                if (typeof progressHandler === 'string' || progressHandler instanceof String) {
                    method = progressHandler;
                } else {
                    method = "POST"
                }

                $.ajax({
                    url: url, //server script to process data
                    type: method,
                    xhr: function () {  // custom xhr
                        myXhr = $.ajaxSettings.xhr();
                        if (myXhr.upload && $.isFunction(progressHandler)) { // if upload property exists
                            myXhr.upload.addEventListener('progress', progressHandler, false); // progressbar
                        }
//                                console.log(myXhr);
                        return myXhr;
                    },
                    // Ajax events
                    success: completeHandler,
                    error: errorHandler,
                    // Form data
                    data: data,
                    // Options to tell jQuery not to process data or worry about the content-type
                    cache: false,
                    contentType: false,
                    processData: false
                }, 'json');
            }

            /***********************************************************************
             * Notify with a message in shape of fancy alert
             **********************************************************************/

            function notify(status, title, msg, type) {
                status = (status == 'error' ? 'danger' : status);
                var callable = null;
                var template = null;
                var icons = {
                    'danger': 'fa-ban',
                    'success': 'fa-check',
                    'info': 'fa-info',
                    'warning': 'fa-warning'
                };
                if ($.isFunction(type)) {
                    callable = type;
                    type = 'modal';
                }

                if (!type || type == 'm') {
                    type = 'modal';
                } else if (type == 'f') {
                    type = 'flash';
                }

                template = $("#alert-" + type).html();
                template = template.replace(new RegExp('{icon}', 'g'), icons[status]);
                template = template.replace(new RegExp('{status}', 'g'), status);
                template = template.replace(new RegExp('{title}', 'g'), title);
                template = template.replace(new RegExp('{msg}', 'g'), msg);
                switch (type) {
                    case 'modal':
                        var modal = $(template).modal('toggle');
                        if ($.isFunction(callable)) {
                            modal.on("hidden.bs.modal", callable);
                        }
                        return;
                    default:
                        $('#alert-box').html(template);
                }

            }
            /***************************************************************************
             * identify Tinymce
             **************************************************************************/
            if (typeof tinymce !== "undefined") {
                /*Text area Editors
                 =========================*/

                tinymce.init({
                    selector: '.tiny-editor',
                    height: 350,
                    theme: 'modern',
                    menubar: false,
                    plugins: [
                        'advlist autolink lists link image charmap print preview anchor',
                        'searchreplace visualblocks code fullscreen',
                        'insertdatetime media table contextmenu paste code'
                    ],
                    toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                    content_css: '//www.tinymce.com/css/codepen.min.css'
                });

            }
        })();