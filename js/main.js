(function ($) {
    "use strict";

    /*jQuery MeanMenu-- */
    jQuery('nav#mobile-nav').meanmenu();

    /*wow js active-- */
    new WOW().init();

    /*owl active-- */
    $(".MainSlider").owlCarousel({
        autoplay: true,
        smartSpeed: 3000,
        pagination: false,
        navigation: true,
        items: 1,
        loop : true,
        dots : false,
        navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
    });
    
    $(".ProductSlider").owlCarousel({
        autoplay: true,
        smartSpeed: 3000,
        pagination: false,
        navigation: true,
        margin : 30,
        items: 4,
        loop : true,
        navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
    });
    
    $(".PaymentSlider").owlCarousel({
        autoplay: true,
        slideSpeed: 2000,
        pagination: false,
        navigation: true,
        items: 4,
        navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
    });
    
    
    $(".RelatedProduct").owlCarousel({
        autoPlay: true,
        slideSpeed: 2000,
        pagination: false,
        navigation: true,
        items: 4,
        loop : true,
        margin : 20,
        navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        
    });
    
    $("#trending-owl").owlCarousel({
        autoPlay: false,
        slideSpeed: 2000,
        pagination: false,
        navigation: true,
        items: 4,
        navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        itemsDesktop: [1199, 4],
        itemsDesktopSmall: [980, 3],
        itemsTablet: [768, 2],
        itemsMobile: [479, 1],
    });
    
    $(".ourclient-owl").owlCarousel({
        autoPlay: false,
        slideSpeed: 2000,
        pagination: false,
        navigation: false,
        items: 6,
        navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        itemsDesktop: [1199, 6],
        itemsDesktopSmall: [980, 3],
        itemsTablet: [768, 2],
        itemsMobile: [479, 1],
    });
    
    $(".popularcollection-owl").owlCarousel({
        autoPlay: false,
        slideSpeed: 2000,
        pagination: false,
        navigation: true,
        items: 1,
        navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        itemsDesktop: [1199, 1],
        itemsDesktopSmall: [980, 1],
        itemsTablet: [768, 1],
        itemsMobile: [479, 1],
    });
    
    $(".featured-two-owl").owlCarousel({
        autoPlay: false,
        slideSpeed: 2000,
        pagination: false,
        navigation: true,
        items: 4,
        navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        itemsDesktop: [1199, 4],
        itemsDesktopSmall: [980, 3],
        itemsTablet: [768, 2],
        itemsMobile: [479, 1],
    });

    /*CHECKOUT Page*/
    $('.panel-heading a').on('click', function () {
        $('.panel-default').removeClass('actives');
        $(this).parents('.panel-default').addClass('actives');
    });

    /* price-slider active*/
    $("#slider-range").slider({
        range: true,
        min: 0,
        max: 10000,
        values: [0, 10000],
        slide: function (event, ui) {
            $("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
        }
    });
    $("#amount").val("$" + $("#slider-range").slider("values", 0) +
        " - $" + $("#slider-range").slider("values", 1));

    /*About Us page Accrodian */
    $('.collapse').on('shown.bs.collapse', function () {
        $(this).parent().find(".fa-plus-circle").removeClass("fa-plus-circle").addClass("fa-minus-circle");
    }).on('hidden.bs.collapse', function () {
        $(this).parent().find(".fa-minus-circle").removeClass("fa-minus-circle").addClass("fa-plus-circle");
    });
    
    /*scrollUp*/
    $.scrollUp({
        scrollText: '<i class="fa fa-angle-up"></i>',
        easingType: 'linear',
        scrollSpeed: 900,
        animation: 'fade'
    });
    $('[data-toggle="tooltip"]').tooltip();
})(jQuery);