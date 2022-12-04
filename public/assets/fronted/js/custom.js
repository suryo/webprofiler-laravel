//jQuery(document).on("ready", function() {
$(document).ready(function() {
    "use strict";

    /* ==============================================
    /*	FUNCTION TO START THE PAGE
    =============================================== */
    function startPage() {
        if ($('.messages').length > 0) {
            var $messages = $('.messages'),
                textRotator = $messages.attr('data-textrotator'),
                number = $messages.attr('data-number'),
                animationIn = $messages.attr('data-animationin');
            if (textRotator == 1 && number == 1) {
                text_rotate();
            }
        }
        if ($('.testimonials-messages').length > 0) {
            if ($('.testimonials-messages').attr('data-autoplay') == 1) {
                testimonials_rotate();
            }
        }
        if ($(".cookies-message").length > 0) {
            setTimeout(function() {
                var hiddenCookies = Cookies.get('hide_cookies_message');
                if (hiddenCookies == null) {
                    $('.cookies-message').addClass('show');
                }
            }, 500);
        }
        var color_scheme_first = $('.pt-wrapper .pt-page').first().attr('data-colorScheme');
        if ($('body.blog_active').length > 0) {
            var color_scheme = $('#blogButton').attr("data-style");
        } else {
            var color_scheme = color_scheme_first;
        }
        $('#mainNav, .mobile-nav').addClass(color_scheme);
        $('.navbar-brand').attr('data-style', color_scheme_first);
        $('#mainNav').css("top", '0px');
    }

    /* ==============================================
    /*	LOADER
    =============================================== */
    if ($('body.preloader').length > 0) {
        var emptyFillColor = $('#loader-circle').attr('data-emptyFill');
        var colorValue = $('#loader-circle').attr('data-color');
        $('#loader-circle').circleProgress({
            startAngle: Math.PI * 1.5,
            thickness: 3,
            emptyFill: emptyFillColor,
            value: 1,
            size: 163,
            fill: {
                color: colorValue
            }
        });
        $('#loader-circle').on('circle-animation-end', function(event) {
            $("#loader-circle").hide("puff", 400);
            $('.loader').fadeOut();
            $(".loader-logo").hide("puff", 400, function() {
                var images = $(this).attr('data-images');
                if (images == true) {
                    api.playToggle();
                }
            });
            startPage();
        });
    } else {
        startPage();
    }

    /* ==============================================
    /*	PAGE TRANSITIONS FUNCTION
    =============================================== */
    PageTransitions.init();

    /* ==============================================
    /*	MESSAGE ROTATION IN THE HOMEPAGE
    =============================================== */
    var $this = $(".messages"),
        intervalTime = $this.attr('data-interval'),
        messageArray = $this.children(),
        messageMax = messageArray.length - 1,
        animationIn = $this.attr('data-animationin'),
        animationOut = $this.attr('data-animationout');

    $(messageArray[0]).removeClass().fadeIn();

    function text_rotate() {
        messageRotate(1);
    }

    function messageRotate(index) {
        var prev = ((index == 0) ? (messageMax) : (index - 1));
        var next = ((index == messageMax) ? 0 : (index + 1));

        setTimeout(function() {
            $(messageArray[prev]).removeClass().addClass('animate__animated ' + animationOut).fadeOut();
            setTimeout(function() {
                $(messageArray[index]).removeClass().fadeIn().addClass('animate__animated ' + animationIn);
                setTimeout(function() {
                    messageRotate(next);
                }, intervalTime / 2);
            }, (intervalTime / 2));
        }, intervalTime);
    }

    /* ==============================================
    /*	TESTIMONIALS ROTATION
    =============================================== */
    if ($('.testimonials-messages').length > 0) {
        var $this = $(".testimonials-messages"),
            intervalTimeTestimonials = $this.attr('data-interval'),
            testimonialsImageArray = $this.find('.testimonial-images').children(),
            testimonialsTextArray = $this.find('.testimonial-texts').children(),
            testimonialsTextMax = testimonialsTextArray.length - 1,
            height = 0;
        testimonialsTextArray.each(function(index) {
            if ($(this).height() > height) {
                height = $(this).height();
            }
            $(this).fadeOut();
        });
        if ($('.testimonials-messages').attr('data-autoplay') == 0) {
            height = height + 40;
        }
        $(".testimonials-messages").find('.testimonial-texts').css('height', height);
        testimonialsImageArray.each(function(index) {
            $(this).fadeOut();
        });
        $(testimonialsImageArray[0]).fadeIn();
        $(testimonialsTextArray[0]).fadeIn();
    }

    function testimonials_rotate() {
        setTimeout(function() {
            testimonialsRotate(1);
        }, intervalTimeTestimonials);
    }

    function testimonialsRotate(index) {
        var prev = ((index == 0) ? (testimonialsTextMax) : (index - 1));
        var next = ((index == testimonialsTextMax) ? 0 : (index + 1));

        setTimeout(function() {
            $(testimonialsImageArray[prev]).fadeOut();
            $(testimonialsTextArray[prev]).fadeOut();
            setTimeout(function() {
                $(testimonialsImageArray[index]).fadeIn();
                $(testimonialsTextArray[index]).fadeIn();
                setTimeout(function() {
                    testimonialsRotate(next);
                }, intervalTimeTestimonials);
            }, (intervalTimeTestimonials / 2));
        }, intervalTimeTestimonials);
    }

    function testimonialsRotateButton(index) {
        if (index != -1) {
            var next = ((index > testimonialsTextMax) ? 0 : index);
        } else {
            var next = testimonialsTextMax;
        }

        testimonialsTextArray.each(function() {
            $(this).fadeOut();
        });
        testimonialsImageArray.each(function() {
            $(this).fadeOut();
        });
        setTimeout(function() {
            $(testimonialsImageArray[next]).fadeIn();
            $(testimonialsTextArray[next]).fadeIn();
        }, (intervalTimeTestimonials / 2));
    }

    $('.comments-arrows .left-arrow').on('click', function() {
        testimonialsRotateButton($(this).attr("data-index"), 1);
    });
    $('.comments-arrows .right-arrow').on('click', function() {
        testimonialsRotateButton($(this).attr("data-index"), 0);
    });

    /* ==============================================
    /*	NAVIGATION BAR
    =============================================== */
    $('.pt-page').on('scroll', function() {
        if ($(this).scrollTop() > 50) {
            $('#mainNav').addClass('navTop');
        } else {
            $('#mainNav').removeClass('navTop');
        }
    });

    /* ==============================================
    /* CODE TO DUPLICATE THE FOOTER
    ================================================== */
    if ($('.aboutme').length > 0) {
        $('#main-footer > footer').clone().appendTo(".aboutme");
        $('.aboutme footer').removeClass('hide').addClass($('.aboutme').attr('data-colorScheme'));
    }
    if ($('.work').length > 0) {
        $('#main-footer > footer').clone().appendTo(".work");
        $('.work footer').removeClass('hide').addClass($('.work').attr('data-colorScheme'));
    }
    if ($('.blog').length > 0) {
        $('#main-footer > footer').clone().appendTo(".blog");
        $('.blog footer').removeClass('hide').addClass($('.blog').attr('data-colorScheme'));
    }
    if ($('.contact').length > 0) {
        $('#main-footer > footer').clone().appendTo(".contact");
        $('.contact footer').removeClass('hide').addClass($('.contact').attr('data-colorScheme'));
    }

    /* ==============================================
    /* BUTTON - BACK TO TOP
    ================================================== */
    $('.toTop').on('click', function() {
        $('.pt-page').animate({ scrollTop: 0 });
    });

    /* ==============================================
    /* TOOLTIPS
    ================================================== */
    $('[data-bs-toggle="tooltip"]').tooltip();

    /* ========================================================
    /* FUNCTION TO LOAD THE BACKGROUND IMAGES OF THE SECTIONS
    ============================================================ */
    function hexToRgb(hex) {
        var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
        return result ? {
            r: parseInt(result[1], 16),
            g: parseInt(result[2], 16),
            b: parseInt(result[3], 16)
        } : null;
    }

    if ($('.homepage').length > 0) {
        var $this = $(".homepage"),
            overlay = $this.attr('data-overlayColor'),
            type = $this.attr('data-overlayType'),
            color_1 = $this.attr('data-overlayColor1'),
            color_2 = $this.attr('data-overlayColor2'),
            gradient = $this.attr('data-overlayGradient');

        if (overlay == 1) {
            if (type == "solid") {
                var a = hexToRgb(color_1);
                $this.css("background", "rgba(" + a["r"] + "," + a["g"] + "," + a["b"] + ",.5)");
            } else {
                var a = hexToRgb(color_1),
                    b = hexToRgb(color_2),
                    deg = '';
                switch (gradient) {
                    case '0':
                        deg = '90deg';
                        break;
                    case '45':
                        deg = '45deg';
                        break;
                    case '90':
                        deg = '0deg';
                        break;
                    case '-45':
                        deg = '135deg';
                        break;
                    case 'radial':
                        deg = 'circle';
                        break;
                }
                //console.log("Deg: " + deg);
                if (deg != 'circle') {
                    $this.css("background", "linear-gradient(" + deg + ", rgba(" + a["r"] + "," + a["g"] + "," + a["b"] + ",.5) 0%, rgba(" + b["r"] + "," + b["g"] + "," + b["b"] + ",.5) 100%)");
                } else {
                    $this.css("background", "radial-gradient(" + deg + ", rgba(" + a["r"] + "," + a["g"] + "," + a["b"] + ",.5) 0%, rgba(" + b["r"] + "," + b["g"] + "," + b["b"] + ",.5) 100%)");
                }
            }
        } else {
            //console.log("11111");
            $this.css("background", "transparent");
        }
    }

    /* ========================================================
    /* FUNCTION TO LOAD THE BACKGROUND IMAGES OF THE SECTIONS
    ============================================================ */
    if ($('.back-image').length > 0) {
        $(".back-image").each(function() {
            var image = $(this).attr('data-image');
            if (image != 'null') {
                $(this).css('background-image', 'url(' + image + ')');
            }
        });
    }

    /* ========================================================
    /* FUNCTION FOR THE PROGRESS BAR DESIGN SKILLS
    ============================================================ */
    if ($('.skills-design-content').length > 0) {
        $(".skills-design-content .bar").each(function() {
            var percentage = $(this).attr('data-percentage');
            $(this).find('.percent-layer').css('width', percentage + '%');
        });
    }

    /* ===================================================
    /* HIDE MENU WHEN IT'S OPEN A POST OR SINGLE WORK
    ====================================================== */
    $('.menu-hide').on('click', function() {
        $('#mainNav').hide();
    });

    $('.menu-show').on('click', function() {
        $('#mainNav').show("slow");
        $('.hide-element').fadeOut();
    });

    /* ==============================================
    /* EASY PIE CHART
    =============================================== */
    function initPieCharts() {
        var pieChartClass = 'pie-chart',
            pieChartAnimationTime = 3000,
            pieChartLoadedClass = 'pie-chart-loaded',
            chart = $('.' + pieChartClass),
            windowWidth = $(window).width(),
            chartWidth = (windowWidth < 1024) ? 130 : 156;

        chart.each(function() {
            var $this = $(this),
                chartSize = ($this.data('chartsize')) ? $this.data('chartsize') : chartWidth,
                chartLineWidth = ($this.data('linewidth')) ? $this.data('linewidth') : 7,
                chartLineCap = ($this.data('linecap')) ? $this.data('linecap') : 7,
                chartBarColor = ($this.data('barcolor')) ? $this.data('barcolor') : "#eeeeee",
                chartTrackColor = ($this.data('trackcolor')) ? $this.data('trackcolor') : "#5e3aee";

            if (!$this.hasClass(pieChartLoadedClass)) {
                $this.easyPieChart({
                    animate: pieChartAnimationTime,
                    barColor: chartBarColor,
                    trackColor: chartTrackColor,
                    size: chartSize,
                    lineWidth: chartLineWidth,
                    lineCap: chartLineCap,
                    scaleColor: false
                }).addClass(pieChartLoadedClass);
            }
        });
    }
    if ($('.skills-dev-content').length > 0) {
        initPieCharts();
    }

    /* ===============================================
    /* FUNCTION TO ASSIGN NUMBER FOR THE MENU POINTS
    ================================================== */
    if ($('.blog-menu').length > 0) {
        var number = $('.blog-menu').data('goto');
        $(".post-call").each(function() {
            $(this).attr({ 'data-goto': number + 1 });
        });
        $(".post-hide").attr({ 'data-goto': number });
    }
    if ($('.work-menu').length > 0) {
        var number = $('.work-menu').data('goto');
        $(".project-call").each(function() {
            $(this).attr({ 'data-goto': number + 1 });
        });
        $(".project-hide").attr({ 'data-goto': number });
    }

    /* =========================================================
    /* FUNCTION TO LOAD BLOG SECTION WHEN COME BACK FROM A POST
    ============================================================ */
    if ($('body.blog_active').length > 0) {
        $('#blogButton').click();
    }

    /* ===============================================
    /* WORKS - PROJECTS
    ================================================== */
    if ($('.projects-content').length > 0) {
        var $container = $('#gallery').imagesLoaded(function() {
            var $this = $('.projects-content'),
                style = $this.attr('data-style'),
                width = [],
                height = [];
            switch (style) {
                case '1':
                    height = [450, 575, 450, 575, 575, 450];
                    break;
                case '2':
                    width = ['w2', '', '', 'w2'];
                    height = [525, 525];
                    break;
                case '3':
                    width = ['w3', 'w2'];
                    height = [525];
                    break;
            }
            if ($(window).width() > 992) {
                $(".projects-content .item a").each(function(i) {
                    if (typeof width[i] !== 'undefined') {
                        $(this).parent().addClass(width[i]);
                    }
                    if (typeof height[i] !== 'undefined') {
                        $(this).parent().css('height', height[i]);
                    }
                });
                $container.isotope({
                    itemSelector: '.item',
                    masonry: {
                        columnWidth: '.grid-sizer'
                    }
                });
            }
        });
        $('#filters').on('click', 'button', function() {
            var filterValue = $(this).attr('data-filter');
            $container.isotope({ filter: filterValue });
            $('#filters').find('.checked').removeClass('checked');
            $(this).addClass('checked');
        });

    }

    /* ===============================================
    /* FUNCTION TO LOAD CONTENT OF A SINGLE PROJECT
    ================================================== */
    $('.project-call').on('click', function(e) {
        e.preventDefault();
        var route = $('.projects-content').attr('data-route'),
            id = $(this).attr('data-id');
        $.ajax({
            url: route + '/project/' + id,
            type: "GET",
            success: function(response) {
                console.log(response);
                $('.work-project .project-title-container .project-title').show().html(response.title);
                if (response.description != '') {
                    $('.work-project .project-content').show().html(response.description);
                } else {
                    $('.work-project .project-content').hide();
                }
                $('.work-project .project-information').empty();
                if (response.info != '') {
                    var info = JSON.parse(response.info),
                        infoContent = '';
                    infoContent += '<div class="project-information-list p-4 p-lg-5">';
                    for (var i = 0; i < info.length; i++) {
                        var classElementInfo = (i == info.length - 1) ? 'm-0' : 'mb-3 mb-lg-4';
                        infoContent += '<h4>' + info[i]['title'] + '</h4><p class="' + classElementInfo + '">' + info[i]['text'] + '</p>';
                    }
                    infoContent += '</div>';
                    $('.work-project .project-information').append(infoContent);
                }
                var classes1 = (response.image_more_1 != '' || response.image_more_2 != '') ? 'col-12 col-lg-8' : 'col-12',
                    classes2 = (response.image_more_1 != '' && response.image_more_2 != '') ? '' : 'image-more-alone',
                    media = '';
                switch (response.type) {
                    case 'standard':
                    case 'gallery':
                        media += ' <div class="' + classes1 + ' image-main"><a href = "' + route + '/' + response.image + '" class="w-100 popup-image" ><img src="' + response.image + '" alt="' + response.title + '"/><i class="fas fa-search"></i></a></div>';
                        break;
                    case 'video':
                        var media = '<div class="' + classes1 + '"><div class="project-video">' + response.video + '</div></div>';
                        classes2 += 'images-more-video';
                        break;

                }
                if (response.image_more_1 != '' || response.image_more_2 != '') {
                    media += '<div class="col-12 col-lg-4 image-more ' + classes2 + '">';
                }
                if (response.image_more_1 != '') {
                    media += '<a href="' + route + '/' + response.image_more_1 + '" class="w-100 popup-image" ><img src="' + response.image_more_1 + '" alt="' + response.title + '"/><i class="fas fa-search"></i></a>';
                }
                if (response.image_more_2 != '') {
                    media += '<a href="' + route + '/' + response.image_more_2 + '" class="w-100 popup-image" ><img src="' + response.image_more_2 + '" alt="' + response.title + '"/><i class="fas fa-search"></i></a>';
                }
                if (response.image_more_1 != '' || response.image_more_2 != '') {
                    media += '</div>';
                }
                media += '</div>';

                var js_script_image = "<script>$('.popup-image').magnificPopup({type: 'image',removalDelay: 500,callbacks: {beforeOpen: function() {this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');this.st.mainClass = 'mfp-zoom-in';}},closeOnContentClick: true,fixedContentPos: false});</script>";

                var galleryContent = '';
                if (response.type == 'gallery') {
                    //if (response.hasOwnProperty('gallery_images')) {
                    galleryContent += '<div class="col-12"><h3 class="mb-4">' + $('.project-gallery').attr('data-title') + '</h3></div>';
                    var images = response.gallery_images;
                    for (var i = 0; i < response.gallery_image_number; i++) {
                        galleryContent += '<div class="col-12 col-md-6 col-lg-4"><a href="' + route + '/' + images[i + 1] + '" class="p-0 w-100" ><img src="' + images[i + 1] + '" class="d-block w-100" alt="' + response.title + '" /><i class="fas fa-search"></i></a></div></div>';
                    }
                    var js_script_gallery = "<script>$('.project-gallery').magnificPopup({delegate: 'a',type: 'image',mainClass: 'mfp-img-mobile',gallery: {enabled: true,navigateByImgClick: true,preload: [0, 1]},});</script>";
                }

                $('.work-project .project-media').html(media);
                $('.work-project .project-gallery').html(galleryContent);
                $('.work-project .work-script').html(js_script_image);
                if (response.type == 'gallery') {
                    $('.work-project .work-script').html(js_script_gallery);
                }
                $('.work-project .hide-element').fadeIn();
                if (response.type != 'gallery') { $('.project-gallery ').fadeOut(); }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, +' ' + errorThrown);
            }
        });
    });

    /* ===============================================
    /* FUNCTION TO LOAD THE LEAFLET MAP
    ================================================== */
    if ($("#map").length > 0) {

        var $this = $("#map"),
            coordX = $this.attr('data-latitude'),
            coordY = $this.attr('data-longitude'),
            zoomValue = $this.attr('data-zoom'),
            iconUrlValue = $this.attr('data-iconimage'),
            style = $this.attr('data-style'),
            keyValue = $this.attr('data-key'),
            popup = $this.attr('data-text');
        var map = L.map('map', {
            center: [coordX, coordY],
            zoom: zoomValue,
            scrollWheelZoom: false
        });
        var iconMap = L.icon({
            iconUrl: iconUrlValue,
            iconSize: [48, 48],
            iconAnchor: [coordX, coordY],
            popupAnchor: [-20, 0]
        });

        switch (style) {
            case 'default':
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);
                break;
            case 'lightgrey':
                L.tileLayer('https://tiles.stadiamaps.com/tiles/alidade_smooth/{z}/{x}/{y}{r}.png?api_key=' + keyValue, {
                    attribution: '&copy; <a href="https://stadiamaps.com/">Stadia Maps</a>, &copy; <a href="https://openmaptiles.org/">OpenMapTiles</a> &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors'
                }).addTo(map);
                break;
            case 'darkgrey':
                L.tileLayer('https://tiles.stadiamaps.com/tiles/alidade_smooth_dark/{z}/{x}/{y}{r}.png?api_key=' + keyValue, {
                    attribution: '&copy; <a href="https://stadiamaps.com/">Stadia Maps</a>, &copy; <a href="https://openmaptiles.org/">OpenMapTiles</a> &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors'
                }).addTo(map);
                break;
            case 'vintage':
                L.tileLayer('https://tiles.stadiamaps.com/tiles/osm_bright/{z}/{x}/{y}{r}.png?api_key=' + keyValue, {
                    attribution: '&copy; <a href="https://stadiamaps.com/">Stadia Maps</a>, &copy; <a href="https://openmaptiles.org/">OpenMapTiles</a> &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors'
                }).addTo(map);
                break;
        }
        L.marker([coordX, coordY], { icon: iconMap }).addTo(map).bindPopup(popup);

    }

    /* ===============================================
    /* SERVICES - CAROUSEL
    ================================================== */
    if ($(".services-content").length > 0) {
        var owl = $('.services-carousel'),
            columns = $('.services-content').attr('data-columns');
        owl.owlCarousel({
            loop: true,
            margin: 4,
            responsiveClass: true,
            nav: false,
            dots: false,
            responsive: {
                0: {
                    items: 2,
                },
                768: {
                    items: 3,
                },
                992: {
                    items: columns,
                }
            }
        });
        $('.carousel-nav .right-nav').on('click', function() {
            owl.trigger('next.owl.carousel');
        });
        $('.carousel-nav .left-nav').on('click', function() {
            owl.trigger('prev.owl.carousel');
        });

        var servicesCarousel = $(".services-carousel").find('.owl-stage').children(),
            widthScreen = $(window).width,
            height = 0;
        servicesCarousel.each(function() {
            if ($(this).height() > height) {
                height = $(this).height();
            }
        });
        var heightAdded = (widthScreen < 768) ? 0 : 20;
        $(".services-carousel").find('.item').css('height', height + heightAdded);
    }

    /* ===============================================
    /* FUNCTION TO LOAD THE MENU MOBILE
    ================================================== */
    $('#mobile-menu-open').on('click', function(e) {
        $('.mobile-nav').addClass('is-open');
    });

    $('#mobile-menu-close').on('click', function(e) {
        $('.mobile-nav').removeClass('is-open');
    });

    /* ==============================================
    /*	COOKIES MESSAGE
    =============================================== */
    if ($(".cookies-message").length > 0) {
        $('.cookies-close').click(function(e) {
            e.preventDefault();
            Cookies.set('hide_cookies_message', 1, 30);
            $('.cookies-message').hide();
        });
    }

    /* ==============================================
    /*	CONTACT FORM
    =============================================== */
    $('#contactform').on('submit', function(e) {
        e.preventDefault();
        var $this = jQuery('#contactform'),
            route = $this.attr('data-route'),
            postdata = $this.serialize();
        $('#contactform button').fadeOut();
        setTimeout(function() {
            $('#contactform .button-loader').fadeIn();
        }, 250);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: route + '/sendemail',
            data: postdata,
            dataType: 'json',
            success: function(resp) {
                //console.log(resp);
                if (resp.valid == 0) {
                    $('.field-email').addClass('is-invalid');
                    $('.field-email-valid').fadeIn('150').delay(3000).fadeOut();
                    $('#contactform button').fadeIn();
                    setTimeout(function() {
                        $('#contactform .button-loader').fadeOut();
                    }, 100);
                } else {
                    setTimeout(function() {
                        $('#contactform').fadeOut().delay(3000).fadeIn();
                    }, 250);
                    setTimeout(function() {
                        $('.form-message-ok').fadeIn().delay(2500).fadeOut();
                        $('#contactform input, #contactform textarea').val('');
                        $('#contactform button').fadeIn();
                        $('#contactform .button-loader').fadeOut();
                    }, 500);
                    setTimeout(function() {
                        $('.field-email').removeClass('is-invalid');
                    }, 1500);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                if (jqXHR.status === 0) {
                    console.log('Not connect: Verify Network.');
                } else if (jqXHR.status == 404) {
                    console.log('Requested page not found [404]');
                } else if (jqXHR.status == 500) {
                    console.log('Internal Server Error [500].');
                } else if (textStatus === 'parsererror') {
                    console.log('Requested JSON parse failed.');
                } else if (textStatus === 'timeout') {
                    console.log('Time out error.');
                } else if (textStatus === 'abort') {
                    console.log('Ajax request aborted.');
                } else {
                    console.log('Uncaught Error: ' + jqXHR.responseText);
                }
            }
        });
    });

});