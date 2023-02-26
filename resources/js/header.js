jQuery(document).ready(function ($) {
    $(".ta-get_started").click(function () {
        if (
            $(".ta-drop-getting_invovled").hasClass(
                "ta-drop-getting_invovled-open"
            )
        ) {
            $(".ta-drop-getting_invovled").removeClass(
                "ta-drop-getting_invovled-open"
            );
        } else {
            $(".ta-drop-getting_invovled").addClass(
                "ta-drop-getting_invovled-open"
            );
        }
    });
    $(".ta-adventures").click(function () {
        if ($(".ta-drop-adventures").hasClass("ta-drop-adventures-open")) {
            $(".ta-drop-adventures").removeClass("ta-drop-adventures-open");
        } else {
            $(".ta-drop-adventures").addClass("ta-drop-adventures-open");
        }
    });
    $(".ta-domore").click(function () {
        if ($(".ta-drop-domore").hasClass("ta-drop-domore-open")) {
            $(".ta-drop-domore").removeClass("ta-drop-domore-open");
        } else {
            $(".ta-drop-domore").addClass("ta-drop-domore-open");
        }
    });
    $(".ta-help").click(function () {
        if ($(".ta-drop-help").hasClass("ta-drop-help-open")) {
            $(".ta-drop-help").removeClass("ta-drop-help-open");
        } else {
            $(".ta-drop-help").addClass("ta-drop-help-open");
        }
    });
    $(".ta-about").click(function () {
        if ($(".ta-drop-about").hasClass("ta-drop-about-open")) {
            $(".ta-drop-about").removeClass("ta-drop-about-open");
        } else {
            $(".ta-drop-about").addClass("ta-drop-about-open");
        }
    });
    $(".ta-shop").click(function () {
        if ($(".ta-drop-shop").hasClass("ta-drop-shop-open")) {
            $(".ta-drop-shop").removeClass("ta-drop-shop-open");
        } else {
            $(".ta-drop-shop").addClass("ta-drop-shop-open");
        }
    });
    $(".ta-account").click(function () {
        if ($(".ta-drop-account").hasClass("ta-drop-account-open")) {
            $(".ta-drop-account").removeClass("ta-drop-account-open");
        } else {
            $(".ta-drop-account").addClass("ta-drop-account-open");
        }
    });
    $(document).click(function (event) {
        var $target = $(event.target);
        if (
            !$target.closest(".ta-drop-getting_invovled").length &&
            !$target.closest(".ta-get_started").length &&
            $(".ta-drop-getting_invovled").hasClass(
                "ta-drop-getting_invovled-open"
            )
        ) {
            $(".ta-drop-getting_invovled").removeClass(
                "ta-drop-getting_invovled-open"
            );
        }
    });
    $(document).click(function (event) {
        var $target = $(event.target);
        if (
            !$target.closest(".ta-drop-adventures").length &&
            !$target.closest(".ta-adventures").length &&
            $(".ta-drop-adventures").hasClass("ta-drop-adventures-open")
        ) {
            $(".ta-drop-adventures").removeClass("ta-drop-adventures-open");
        }
    });
    $(document).click(function (event) {
        var $target = $(event.target);
        if (
            !$target.closest(".ta-drop-domore").length &&
            !$target.closest(".ta-domore").length &&
            $(".ta-drop-domore").hasClass("ta-drop-domore-open")
        ) {
            $(".ta-drop-domore").removeClass("ta-drop-domore-open");
        }
    });
    $(document).click(function (event) {
        var $target = $(event.target);
        if (
            !$target.closest(".ta-drop-help").length &&
            !$target.closest(".ta-help").length &&
            $(".ta-drop-help").hasClass("ta-drop-help-open")
        ) {
            $(".ta-drop-help").removeClass("ta-drop-help-open");
        }
    });
    $(document).click(function (event) {
        var $target = $(event.target);
        if (
            !$target.closest(".ta-drop-about").length &&
            !$target.closest(".ta-about").length &&
            $(".ta-drop-about").hasClass("ta-drop-about-open")
        ) {
            $(".ta-drop-about").removeClass("ta-drop-about-open");
        }
    });
    $(document).click(function (event) {
        var $target = $(event.target);
        if (
            !$target.closest(".ta-drop-shop").length &&
            !$target.closest(".ta-shop").length &&
            $(".ta-drop-shop").hasClass("ta-drop-shop-open")
        ) {
            $(".ta-drop-shop").removeClass("ta-drop-shop-open");
        }
    });
    $(document).click(function (event) {
        var $target = $(event.target);
        if (
            !$target.closest(".ta-drop-account").length &&
            !$target.closest(".ta-account").length &&
            $(".ta-drop-account").hasClass("ta-drop-account-open")
        ) {
            $(".ta-drop-account").removeClass("ta-drop-account-open");
        }
    });

    let timeout;
    $(".booking-info .woocommerce").on("change", "input.qty", function () {
        if (timeout !== undefined) {
            clearTimeout(timeout);
        }
        console.log("quantity updated");
        timeout = setTimeout(function () {
            console.log("trigger update");
            $("[name='update_cart']").trigger("click"); // trigger cart update
        }, 500); // 1 second delay, half a second (500) seems comfortable too
    });

    $(".location-carousel").slick({
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 3,
        dots: false,
        arrows: false,
        autoplay: true,
        autoplaySpeed: 4000,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                },
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                },
            },
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ],
    });
    $(".dates-carousel").slick({
        infinite: false,
        slidesToShow: 3,
        slidesToScroll: 3,
        dots: true,
        arrows: true,
        nextArrow: '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 cursor-pointer next-arrow"> <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" /> </svg>',
        prevArrow: '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 cursor-pointer prev-arrow"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7 5" /> </svg>',
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                },
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                },
            },
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ],
    });


    $('.mobile-header-btn').on('click', function(e) {
        $('.mobile-menu').removeClass('hidden');
    })
    $('.close-menu').on('click', function(e) {
        $('.mobile-menu').addClass('hidden');
    })

});
