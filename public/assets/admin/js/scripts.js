$(document).ready(function() {
    "use strict";

    /* ===============================================
    INITIALLING DATATABLE
    ================================================== */
    if ($(".datatable").length > 0) {
        $('.datatable').DataTable();
    }

    /* ===============================================
    FUNCTION TO HIDE THE ALERT MESSAGE
    ================================================== */
    if ($(".alert.alert-message").length > 0) {
        window.setTimeout(function() {
            $("#alert_message").fadeTo(500, 0).slideUp(500, function() {
                $(this).remove();
            });
        }, 3000);
    }

    /* ===============================================
    FUNCTION FOR THE FORM TO ADD A SLIDER
    ================================================== */
    if ($("form.slider-new").length > 0) {
        $('#slider_overlay_type').on("change", function() {
            var option = $(this).children("option:selected").val();
            if (option == 'gradient') {
                $('form.slider-new').find('.overlay-color-2-options').removeClass('d-none');
                $('form.slider-new').find('.overlay-color-2-options').removeClass('d-none');
            } else {
                $('form.slider-new').find('.overlay-color-2-options').addClass('d-none');
                $('form.slider-new').find('.overlay-color-2-options').addClass('d-none');
            }
        });
        $('#slider_video_type').on("change", function() {
            var option = $(this).children("option:selected").val();
            if (option == 'server') {
                $('form.slider-new').find('.video-server').removeClass('d-none');
                $('form.slider-new').find('.video-url').addClass('d-none');
            } else {
                $('form.slider-new').find('.video-server').addClass('d-none');
                $('form.slider-new').find('.video-url').removeClass('d-none');
            }
        });
        $('#slider_text_rotator').on("change", function() {
            if ($(this).prop("checked") == true) {
                $('form.slider-new').find('.slider-text-rotator').removeClass('d-none');
            } else {
                $('form.slider-new').find('.slider-text-rotator').addClass('d-none');
            }
        });
        $('#submitSliderBtn').on("click", function(e) {
            $("form.slider-new").find('.invalid-feedback').addClass('d-none');
            $("form.slider-new").find('.is-invalid').removeClass('is-invalid');
            if (!$.trim($("#slider_text").val())) {
                $("#slider_text").addClass('is-invalid');
                $(".slider-text").find('.invalid-feedback ').removeClass('d-none');
            } else if (
                ($("#slider_type :selected").val() == 'video') &&
                ($("#slider_video_type :selected").val() != 'server') &&
                !$.trim($("#slider_url_video").val())) {
                $("#slider_url_video").addClass('is-invalid');
                $(".video-url").find('.invalid-feedback ').removeClass('d-none');
            } else if (
                ($("#slider_type :selected").val() == 'video') &&
                ($("#slider_video_type :selected").val() == 'server') &&
                ($(".slider-video").hasClass('slider-video-check')) &&
                ($("#slider_server_video")[0].files.length == 0)) {
                $("#slider_server_video").addClass('is-invalid');
                $(".video-server").find('.invalid-feedback ').removeClass('d-none');
            } else {
                $('form.slider-new').submit();
            }
            e.preventDefault();
        });
    }

    /* ===============================================
    FUNCTION TO ADD A NEW INFO VALUE
    ================================================== */
    if ($(".info-content").length > 0) {
        $('.addInfo').on("click", function() {

            var target = $(this).attr('data-target'),
                info_label = $('#info_label_' + target).val(),
                info_value = $('#info_value_' + target).val();

            if ((info_label.search('<') == -1) &&
                (info_label.search('>') == -1) &&
                (info_label.search('"') == -1) &&
                (info_value.search('<') == -1) &&
                (info_value.search('>') == -1) &&
                (info_value.search('"') == -1)) {

                if ($('#info_label_' + target).hasClass('select-social') == true) {
                    var textIcon = '<span class="' + info_label + '"></span>';
                } else {
                    var textIcon = info_label;
                }

                $('.table-' + target).append('<tr><td class="fw-bold">' + textIcon + '</td><td>' + info_value + '</td><td class="text-right"><button type="button" class="btn btn-outline-danger btn-sm rounded-circle deleteInfo" data-info="' + info_label + '" data-value="' + info_value + '"><i class="fas fa-times"></i></button></tr>');

                if ($("#" + target).val() != '') {
                    var listInfo = JSON.parse($("#" + target).val());
                } else {
                    var listInfo = [];
                }
                listInfo.push({
                    "title": info_label,
                    "text": info_value,
                });
                $("#" + target).val(JSON.stringify(listInfo));
            } else {
                $('.invalid-' + target).removeClass("d-none");
                setTimeout(function() {
                    $('.invalid-' + target).addClass("d-none");
                }, 2500);
            }
            $('#info_label_' + target).val('');
            $('#info_value_' + target).val('');

        });
    }

    /* ===============================================
    DELETE INFO VALUE
    ================================================== */
    $('.table-elements').on('click', 'button.deleteInfo', function() {
        var target = $(this).parent().parent().parent().parent().attr('data-target'),
            listInfo = JSON.parse($("#" + target).val()),
            title = $(this).attr('data-info'),
            text = $(this).attr('data-value');
        console.log(target);
        for (var i = 0; i < listInfo.length; i++) {
            if (title == listInfo[i]["title"] && text == listInfo[i]["text"]) {
                listInfo.splice(i, 1);
                $(this).parent().parent().remove();
                $("#" + target).val(JSON.stringify(listInfo));
            }
        }
    });

    /* ===============================================
    PREVIEW TEMPORARY IMAGES
    ================================================== */
    $('.previewImage ').on("change", function() {
        var image = this.files[0],
            type = $(this).attr("name");
        // VALIDATE IF IT'S JPEG, JPG OR PNG FORMAT
        if (image["type"] == "image/jpeg" || image["type"] == "image/jpg" || image["type"] == "image/png") {
            var dataImage = new FileReader();
            dataImage.readAsDataURL(image);
            $(dataImage).on("load", function(event) {
                var routeImage = event.target.result;
                $(".previewImage_" + type).attr("src", routeImage);
            });
        }
    });

    /* ===============================================
    CUSTOM SELECT FOR ICONS
    ================================================== */
    if ($(".selectpicker").length > 0) {
        $('.selectpicker').selectpicker();
        $('.bootstrap-select .dropdown-menu ul li').on('click', function() {
            var icon = $(this).find('a span:first').attr('class');
            $('input[name="icon"]').val(icon);
        });

    }

    /* ===============================================
    OPEN MODAL DIV WHEN THERE IS A VALIDATION ERROR
    ================================================== */
    if ($(".openModal").length > 0) {
        var idModal = $(".openModal").attr('data-id'),
            myModal = new bootstrap.Modal(document.getElementById(idModal), {});
        myModal.show();
    }

    /* ==================================================
    FUNCTION FOR CHECK THE NUMBER OF COLUMNS ON FOOTER
    ===================================================== */
    if ($(".select-footer-columns").length > 0) {
        $('.select-footer-columns').on("change", function() {
            var option = $(this).children("option:selected").val();
            if (option == '0') {
                $('.column_1_2').removeClass('d-none').addClass('d-none');
                $('.column_3').removeClass('d-none').addClass('d-none');
                $('.column_4').removeClass('d-none').addClass('d-none');
            } else if (option == '2') {
                $('.column_1_2').removeClass('d-none');
                $('.column_3').removeClass('d-none').addClass('d-none');
                $('.column_4').removeClass('d-none').addClass('d-none');
            } else if (option == '3') {
                $('.column_1_2').removeClass('d-none');
                $('.column_3').removeClass('d-none');
                $('.column_4').removeClass('d-none').addClass('d-none');
            } else {
                $('.column_1_2').removeClass('d-none');
                $('.column_3').removeClass('d-none');
                $('.column_4').removeClass('d-none');
            }
        });
    }

    /* ====================================================
    VISIBILITY FUNCTION FOR SEVERAL DIVS - PAGE SECTIONS
    ======================================================= */
    if ($("form.form-visibility").length > 0) {
        $('.form-check-input').on("change", function() {
            var target = $(this).attr('data-visibility');
            if (target != null) {
                if ($(this).prop("checked") == true) {
                    $('.' + target).removeClass('d-none');
                } else {
                    $('.' + target).addClass('d-none');
                }
            }
        });
    }

    /* ==================================================
    FUNCTION FOR CHECK THE NUMBER OF COLUMNS ON FOOTER
    ===================================================== */
    if ($(".form-select-visibility").length > 0) {
        $('.form-select-visibility').on("change", function() {
            var visibility = $(this).children("option:selected").attr('data-visibility');
            $('.row-visibility').addClass('d-none');
            if (visibility != null) {
                $('.' + visibility).removeClass('d-none');
            }
        });
    }

    /* ==================================================
    INITIALIZE TOOLTIP FUNCTION
    ===================================================== */
    $('[data-bs-toggle="tooltip"]').tooltip();

    /* ==================================================
    FUNCTION TO START SUMMERNOTE EDITOR
    ===================================================== */
    $(".summernote").each(function() {
        var $this = $(this),
            name = $this.attr('name'),
            folder = $this.attr('data-folder'),
            route = $this.attr('data-route'),
            code = $this.attr('data-code');
        $(this).summernote({
            height: 300,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture']],
                ['view', ['fullscreen', 'codeview', 'help']],
            ],
            callbacks: {
                onImageUpload: function(files) {
                    for (var i = 0; i < files.length; i++) {
                        upload(files[i], name, folder, route, code);
                    }
                }
            }
        });
        $('.note-codable').on('focusout', function(e) {
            $(this).val(DOMPurify.sanitize($(this).val()));
        });
        $('.check-summernote').on('click', function(e) {
            e.preventDefault();
            var html = $('.note-editor .note-editable ').html();
            html = html.replace('</blockquote>', '</p>');
            html = html.replace('<blockquote', '<p');
            $('.summernote').val(html);
            $('form').trigger('submit');
            $('.summernote').summernote('codeview.toggle');
        });
    });
    $(".summernote-simple").each(function() {
        $(".summernote-simple").summernote({
            height: 200,
            toolbar: [
                ['font', ['bold', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['view', ['fullscreen', 'codeview', 'help']],
            ]
        });
        $('.note-codable').on('focusout', function(e) {
            $(this).val(DOMPurify.sanitize($(this).val()));
        });
        $('.check-summernote').on('click', function() {
            $('.summernote-simple').summernote('codeview.toggle');
        });
    });

    /* ==================================================
    SUMMERNOTE - UPLOAD AN IMAGE TO THE SERVER
    ===================================================== */
    function upload(file, name, folder, route, code) {
        var data = new FormData();
        data.append('file', file, file.name);
        data.append('route', route);
        data.append("folder", folder);
        data.append("code", code);
        $.ajax({
            url: route + "/assets/admin/ajax/upload.php",
            method: "POST",
            data: data,
            contentType: false,
            cache: false,
            processData: false,
            success: function(response) {
                $("[name='" + name + "']").summernote("insertImage", response, function() {});
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error(textStatus + "" + errorThrown);
            }
        });
    }

    /* ==================================================
    SUMMERNOTE - DROPDOWNS
    ===================================================== */
    $('.dropdown-toggle').dropdown();

    /* ==================================================
    FUNCTION TO CHANGE THE TYPE OF THE PASSWORD INPUTS
    ===================================================== */
    if ($(".form-password").length > 0) {
        $('.form-password i.password-visible').on("click", function() {
            $(this).parent().find('input').get(0).type = 'text';
            $(this).addClass('d-none');
            $(this).parent().find('.password-hidden').removeClass('d-none');
        });
        $('.form-password i.password-hidden').on("click", function() {
            $(this).parent().find('input').get(0).type = 'password';
            $(this).addClass('d-none');
            $(this).parent().find('.password-visible').removeClass('d-none');
        });
    }

    /* ==================================================
    REMOVE IMAGE UPLOADED
    ===================================================== */
    if ($(".remove-image").length > 0) {
        $('.remove-image').on("click", function() {
            var target = $(this).attr('data-target'),
                url = $(this).attr('data-url');
            console.log(target);
            $('input[name="' + target + '_current"]').val(null);
            $('input[name="' + target + '"]').val(null);
            $(".previewImage_" + target).attr("src", url + "uploads/img/image_default.png");
        });
    }

});

/* ===============================================
IMAGE POPUP
================================================== */
if ($(".popup-image").length > 0) {
    $('.popup-image').magnificPopup({
        type: 'image',
        removalDelay: 500, //delay removal by X to allow out-animation
        callbacks: {
            beforeOpen: function() {
                this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
                this.st.mainClass = 'mfp-zoom-in';
            }
        },
        closeOnContentClick: true,
        fixedContentPos: false
    });
}


/* ===============================================
VIDEO POPUP
================================================== */
if ($(".popup-video").length > 0) {
    $('.popup-video').magnificPopup({
        disableOn: 700,
        type: 'iframe',
        mainClass: 'mfp-fade',
        removalDelay: 160,
        preloader: false,
        fixedContentPos: false
    });
}