/*
Template: Fitsense - Gym and Fitness HTML Template
Author: peacefulqode.com
Version: 1.0
Design and Developed by: PeacefulQode

*/

/*================================================
[  Table of contents  ]
==================================================

==> Page Loader
==> Search Button
==> Accordion
==> Sidebar Toggle
==> Sticky Header
==> Owl Carousel
==> Back To Top
==> Isotope
==> Counter
==> WOW
==> Map
==> Simplebar

==================================================
[ End table content ]
================================================*/


(function (jQuery) {
    "use strict";
    jQuery(window).on('load', function (e) {


        /*==================================================
        [ Page Loader ]
        ==================================================*/
        jQuery("#pq-loading").fadeOut();
        jQuery("#pq-loading").delay(0).fadeOut("slow");

        var Scrollbar = window.Scrollbar;


        /*==================================================
        [ Search Button ]
        ==================================================*/
        jQuery('#pq-seacrh-btn').on('click', function () {
            jQuery('.pq-search-form').slideToggle();
            jQuery('.pq-search-form').toggleClass('pq-form-show');
            if (jQuery('.pq-search-form').hasClass("pq-form-show")) {
                jQuery(this).html('<i class="ti-close"></i>');
            } else {
                jQuery(this).html('<i class="ti-search"></i>');
            }
        });


        /*==================================================
        [ Accordion ]
        ==================================================*/
        jQuery('.pq-accordion-block .pq-accordion-box .pq-accordion-details').hide();
        jQuery('.pq-accordion-block .pq-accordion-box:first').addClass('pq-active').children().slideDown('slow');
        jQuery('.pq-accordion-block .pq-accordion-box').on("click", function () {
            if (jQuery(this).children('div.pq-accordion-details').is(':hidden')) {
                jQuery('.pq-accordion-block .pq-accordion-box').removeClass('pq-active').children('div.pq-accordion-details').slideUp('slow');
                jQuery(this).toggleClass('pq-active').children('div.pq-accordion-details').slideDown('slow');
            }
        });


        /*==================================================
        [ Sidebar Toggle ]
        ==================================================*/
        jQuery("#pq-toggle-btn").on('click', function () {
            jQuery('#pq-sidebar-menu-contain').toggleClass("active");
        });
        jQuery('.pq-toggle-btn').click(function () {
            jQuery('body').addClass('pq-siderbar-open');
        });
        jQuery('.pq-close').click(function () {
            jQuery('body').removeClass('pq-siderbar-open');
        });


        /*==================================================
        [ Sticky Header ]
        ==================================================*/
        var view_width = jQuery(window).width();
        if (jQuery('header').hasClass('pq-has-sticky')) {
            var height = jQuery('header').height();
            jQuery('.pq-breadcrumb').css('padding-top', height * 2);
        }
        if (jQuery('header').hasClass('pq-has-sticky')) {
            jQuery(window).scroll(function () {
                var scrollTop = jQuery(window).scrollTop();
                if (scrollTop > height) {
                    jQuery('.pq-bottom-header').addClass('pq-header-sticky animated fadeInDown animate__faster');
                } else {
                    jQuery('.pq-bottom-header').removeClass('pq-header-sticky animated fadeInDown animate__faster');
                }
            });
        }

        /*==================================================
        [ Center Owl Carousel ]
        ==================================================*/

        jQuery('.center-owl-carousel .owl-carousel').each(function () {
            var app_slider = jQuery(this);
            var rtl = false;
            var prev = 'ion-ios-arrow-left';
            var next = 'ion-ios-arrow-right';
            var prev_text = 'Prev';
            var next_text = 'Next';

            if (app_slider.data('prev_text') && app_slider.data('prev_text') != '') {
                prev_text = app_slider.data('prev_text');
            }
            if (app_slider.data('next_text') && app_slider.data('next_text') != '') {
                next_text = app_slider.data('next_text');
            }
            app_slider.owlCarousel({
                //center: true,
                items: app_slider.data("desk_num"),
                loop: app_slider.data("loop"),
                nav: app_slider.data("nav"),
                dots: app_slider.data("dots"),
                margin: app_slider.data("margin"),
                autoplay: app_slider.data("autoplay"),
                autoplayHoverPause: true,
                autoplayTimeout: app_slider.data("autoplay-timeout"),
                navText: ["<i class='" + prev + "'></i>", "<i class='" + next + "'></i>"],
                responsiveClass: true,
                responsive: {

                    0: {
                        items: app_slider.data("mob_sm"),
                        // nav: true,
                        dots: false
                    },
                    // breakpoint from 480 up
                    480: {
                        items: app_slider.data("mob_num"),
                        // nav: true,
                        dots: false
                    },
                    // breakpoint from 786 up
                    786: {
                        items: app_slider.data("tab_num")
                    },
                    // breakpoint from 1023 up
                    1023: {

                        items: app_slider.data("lap_num")
                    },
                    1199: {
                        center: true,
                        items: app_slider.data("desk_num")
                    }
                }
            });
        });

        /*==================================================
        [ Owl Carousel ]
        ==================================================*/
        jQuery('.owl-carousel').each(function () {
            var app_slider = jQuery(this);
            app_slider.owlCarousel({
                items: app_slider.data("desk_num"),
                loop: app_slider.data("loop"),
                margin: app_slider.data("margin"),
                nav: app_slider.data("nav"),
                dots: app_slider.data("dots"),
                autoplay: app_slider.data("autoplay"),
                autoplayTimeout: app_slider.data("autoplay-timeout"),
                navText: ["<i class='ion-ios-arrow-back'></i><span></span>", "<span></span><i class='ion-ios-arrow-forward'></i>"],
                responsiveClass: true,
                responsive: {
                    // breakpoint from 0 up
                    0: {
                        items: app_slider.data("mob_sm"),
                        nav: false
                    },
                    // breakpoint from 480 up
                    480: {
                        items: app_slider.data("mob_num"),
                        nav: false
                    },
                    // breakpoint from 786 up
                    786: {
                        items: app_slider.data("tab_num")
                    },
                    // breakpoint from 1023 up
                    1024: {
                        items: app_slider.data("lap_num")
                    },
                    1199: {
                        items: app_slider.data("desk_num")
                    }
                }
            });
        });

        /*==================================================
        [ Progressbar ]
        ==================================================*/

        jQuery(".pq-progressbar-content .show-progress").each(function () {
            jQuery(this).animate({
                width: jQuery(this).attr("data-width") + "%",
            },
                2000
            );
        });
    });

    /*==================================================
    [ Back To Top ]
    ==================================================*/
    jQuery('#back-to-top').fadeOut();
    jQuery(window).on("scroll", function () {
        if (jQuery(this).scrollTop() > 250) {
            jQuery('#back-to-top').fadeIn(1400);
        } else {
            jQuery('#back-to-top').fadeOut(400);
        }
    });
    jQuery('#top').on('click', function () {
        jQuery('top').tooltip('hide');
        jQuery('body,html').animate({
            scrollTop: 0
        }, 100);
        return false;
    });



    /*==================================================
    [ Isotope ]
    ==================================================*/

    jQuery('.pq-masonry').isotope({
        itemSelector: '.pq-masonry-item',
        masonry: {
            columnWidth: '.grid-sizer',
            // gutter: 0
        }
    });
    jQuery('.pq-grid').isotope({
        itemSelector: '.pq-grid-item',
    });
    jQuery('.pq-filter-button-group').on('click', '.pq-filter-btn', function () {
        var filterValue = jQuery(this).attr('data-filter');
        console.log(filterValue);
        jQuery('.pq-masonry').isotope({ filter: filterValue });
        jQuery('.pq-grid').isotope({ filter: filterValue });
        jQuery('.pq-filter-button-group .pq-filter-btn').removeClass('active');
        jQuery(this).addClass('active');
        updateFilterCounts();
    });
    var initial_items = 5;
    var next_items = 3;
    if (jQuery('.pq-masonry').length > 0) {
        var initial_items = jQuery('.pq-masonry').data('initial_items');
        var next_items = jQuery('.pq-masonry').data('next_items');
    }
    if (jQuery('.pq-grid').length > 0) {
        var initial_items = jQuery('.pq-grid').data('initial_items');
        var next_items = jQuery('.pq-grid').data('next_items');
    }
    function showNextItems(pagination) {
        var itemsMax = jQuery('.visible_item').length;
        var itemsCount = 0;
        jQuery('.visible_item').each(function () {
            if (itemsCount < pagination) {
                jQuery(this).removeClass('visible_item');
                itemsCount++;
            }
        });
        if (itemsCount >= itemsMax) {
            jQuery('#showMore').hide();
        }
        if (jQuery('.pq-masonry').length > 0) {
            jQuery('.pq-masonry').isotope('layout');
        }
        if (jQuery('.pq-grid').length > 0) {
            jQuery('.pq-grid').isotope('layout');
        }
    }
    // function that hides items when page is loaded
    function hideItems(pagination) {
        var itemsMax = jQuery('.pq-filter-items').length;
        // console.log(itemsMax);
        var itemsCount = 0;
        jQuery('.pq-filter-items').each(function () {
            if (itemsCount >= pagination) {
                jQuery(this).addClass('visible_item');
            }
            itemsCount++;
        });
        if (itemsCount < itemsMax || initial_items >= itemsMax) {
            jQuery('#showMore').hide();
        }
        if (jQuery('.pq-masonry').length > 0) {
            jQuery('.pq-masonry').isotope('layout');
        }
        if (jQuery('.pq-grid').length > 0) {
            jQuery('.pq-grid').isotope('layout');
        }
    }
    jQuery('#showMore').on('click', function (e) {
        e.preventDefault();
        showNextItems(next_items);
    });
    hideItems(initial_items);
    function updateFilterCounts() {
        // get filtered item elements
        if (jQuery('.pq-masonry').length > 0) {
            var itemElems = jQuery('.pq-masonry').isotope('getFilteredItemElements');
        }
        if (jQuery('.pq-grid').length > 0) {
            var itemElems = jQuery('.pq-grid').isotope('getFilteredItemElements');
        }
        var count_items = jQuery(itemElems).length;
        // console.log(count_items);
        if (count_items > initial_items) {
            jQuery('#showMore').show();
        } else {
            jQuery('#showMore').hide();
        }
        if (jQuery('.pq-filter-items').hasClass('visible_item')) {
            jQuery('.pq-filter-items').removeClass('visible_item');
        }
        var index = 0;
        jQuery(itemElems).each(function () {
            if (index >= initial_items) {
                jQuery(this).addClass('visible_item');
            }
            index++;
        });
        if (jQuery('.pq-masonry').length > 0) {
            jQuery('.pq-masonry').isotope('layout');
        }
        if (jQuery('.pq-grid').length > 0) {
            jQuery('.pq-grid').isotope('layout');
        }
    }

    /*==================================================
    [ counter ]
    ==================================================*/
    jQuery('.timer').countTo();

    /*==================================================
    [ wow ]
    ==================================================*/

    new WOW().init();


    /*==================================================
    [ Magnific Popup ]
    ==================================================*/
    jQuery(document).ready(function () {
        jQuery('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
            disableOn: 700,
            type: 'iframe',
            mainClass: 'mfp-fade',
            removalDelay: 160,
            preloader: false,
            fixedContentPos: false
        });

        jQuery('.gallery').each(function () { // the containers for all your galleries
            jQuery(this).magnificPopup({
                delegate: 'a', // the selector for gallery item
                type: 'image',
                gallery: {
                    enabled: true
                }
            });
        });

        jQuery('.pq-popup-video-block').mousefollower({
            followerSelector: ".pq-video-icon"
        });
    });


    /*==================================================
    [ Servicebox Hover ]
    ==================================================*/

    jQuery(".pq-service-box.pq-style-3").hover(
        function () {
            jQuery(".pq-service-box.pq-style-3").removeClass("active");
            jQuery(this).addClass("active");
        }
    );

    /*==================================================
    [ BMI Calculator ]
    ==================================================*/

    jQuery('#pq-result').hide();
    if (jQuery('a').hasClass('submitButton')) {
        var submitButton = document.querySelector(".submitButton");
        function run() {
            // Crating Variables
            var heightInFeet = Number(document.querySelector("#heightInFeet").value);
            var weight = Number(document.querySelector("#weight").value);
            var age = Number(document.querySelector("#age").value);
            var mgender = false, fgender = false, bmr;
            var gender = document.querySelector("#gender");
            var result = document.querySelector("#pq-result");
            var status = '';
            if (heightInFeet == '') {
                jQuery('#pq-result').html('<div class="col-lg-12"><p class="pq-result-display">Please Enter Height</p></div>');
                jQuery('#pq-result').fadeIn('slow');
                return;
            }
            if (age == '') {
                jQuery('#pq-result').html('<div class="col-lg-12"><p class="pq-result-display">Please Enter Age</p></div>');
                jQuery('#pq-result').fadeIn('slow');
                return;
            }
            if (gender.value == "male") {
                mgender = true;
            }
            if (gender.value == "female") {
                fgender = true;
            }
            if (!mgender && !fgender) {
                jQuery('#pq-result').html('<div class="col-lg-12"><p class="pq-result-display">Please Select Gender</p></div>');
                jQuery('#pq-result').fadeIn('slow');
                return;
            }
            var height = ((heightInFeet * 12));
            var heightInMetre = (height / 39.37);
            var heightInCm = (heightInMetre * 100);
            var bmi = (weight * 703) / (heightInFeet * heightInFeet);
            var hnweight = Number.parseFloat(24.9 * (heightInMetre * heightInMetre)).toFixed(2);
            var lnweight = Number.parseFloat(18.5 * (heightInMetre * heightInMetre)).toFixed(2);
            if (bmi < 18.5) {
                status = "Under Weight";
            }
            else if (bmi <= 24.9) {
                status = "Healthy";
            }
            else if (bmi <= 29.9) {
                status = "Over Weight";
            }
            else if (bmi <= 34.9) {
                status = "Class I obesity";
            }
            else if (bmi <= 39.9) {
                status = "Class II obesity";
            }
            else if (bmi >= 40) {
                status = "Class III obesity";
            }
            // Calculating BMR
            bmi = bmi.toFixed(2);
            // nweightDisplay.innerHTML = `${lnweight} KG to ${hnweight} KG`;
            //nweightDisplay.innerHTML = lnweight + " KG to " + hnweight + " KG";
            if (fgender && age != "") {
                var bmrf = (665 + (9.6 * weight) + (1.8 * heightInCm) - (4.7 * age));
                bmr = bmrf.toFixed(2);
            }
            else if (mgender && age != "") {
                var bmrm = (66 + (13.7 * weight) + (5 * heightInCm) - (6.8 * age));
                bmr = bmrm.toFixed(2);
            }
            jQuery('#pq-result').html('<div class="col-lg-12"><p class="pq-result-display">BMI: ' + bmi + ' / BMR: ' + bmr + ' / Status: ' + status + ' / Normal Weight ' + lnweight + '+ KG to ' + hnweight + ' KG</p></div>');
            jQuery('#pq-result').fadeIn('slow');
        }
        submitButton.addEventListener("click", run);
    }

    /*==================================================
    [ Hover Effect ]
    ==================================================*/

    jQuery(".pq_background_list_wrapper").each(function () {
        var parentDiv = jQuery(this);
        parentDiv.children('.pq_background_list_column').hover(function () {
            parentDiv.find('.pq_background_list_column').removeClass('hover');
            parentDiv.find('.pq_background_list_overlay').removeClass('hover');
            jQuery(this).next('.pq_background_list_overlay').addClass('hover');
            jQuery(this).addClass('hover');
        });
    });

    /*==================================================
    [ Simplebar ]
    ==================================================*/

    // var SimpleBar = jQuery('.mCustomScrollbar');
    
})(jQuery);

