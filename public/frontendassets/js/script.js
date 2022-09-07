"use strict";

$("#menu").slicknav();

$(".main-slider").owlCarousel({
    // animateOut: 'slideOutDown',
    // animateIn: 'slideOutFade',
    items: 1,
    dots: false,
    nav: true,
    loop: true,
    smartSpeed: 450,
    autoplay: true,
    autoplayTimeout: 3000,
    navText: [
        "<i class='fa fa-angle-left'></i>",
        "<i class='fa fa-angle-right'></i>",
    ],
});
$(".testimonials-slider").owlCarousel({
    items: 3,
    dots: true,
    nav: false,
    margin: 30,
    responsive: {
        0: {
            items: 1,
        },
        600: {
            items: 1,
        },
        1000: {
            items: 3,
        },
    },
});

$(".about__thumbnail").owlCarousel({
    items: 3,
    autoplay: true,
    autoplayTimeout: 3000,
    dots: true,
    loop: true,
    nav: false,
    margin: 30,
    responsive: {
        0: {
            items: 1,
        },
        600: {
            items: 1,
        },
        1000: {
            items: 3,
        },
    },
});

$(".fa-search").click(function (e) {
    $(".predictive__search--box").addClass("active");
});

$(".predictive__search--close__btn").click(function (e) {
    $(".predictive__search--box").hide(600);
});

$(".drop-child i").click(function (e) {
    $(".mega-menu-1").slideToggle(1000);
});

var bigimage = $("#big");
var thumbs = $("#thumbs");
//var totalslides = 10;
var syncedSecondary = true;

bigimage
    .owlCarousel({
        items: 1,
        slideSpeed: 2000,
        nav: true,
        autoplay: true,
        dots: false,
        loop: true,
        responsiveRefreshRate: 200,
        navText: [
            '<i class="fa fa-arrow-left" aria-hidden="true"></i>',
            '<i class="fa fa-arrow-right" aria-hidden="true"></i>',
        ],
    })
    .on("changed.owl.carousel", syncPosition);

thumbs
    .on("initialized.owl.carousel", function () {
        thumbs.find(".owl-item").eq(0).addClass("current");
    })
    .owlCarousel({
        items: 4,
        dots: true,
        nav: true,
        navText: [
            '<i class="fa fa-arrow-left" aria-hidden="true"></i>',
            '<i class="fa fa-arrow-right" aria-hidden="true"></i>',
        ],
        smartSpeed: 200,
        slideSpeed: 500,
        slideBy: 4,
        responsiveRefreshRate: 100,
    })
    .on("changed.owl.carousel", syncPosition2);

function syncPosition(el) {
    //if loop is set to false, then you have to uncomment the next line
    //var current = el.item.index;

    //to disable loop, comment this block
    var count = el.item.count - 1;
    var current = Math.round(el.item.index - el.item.count / 2 - 0.5);

    if (current < 0) {
        current = count;
    }
    if (current > count) {
        current = 0;
    }
    //to this
    thumbs
        .find(".owl-item")
        .removeClass("current")
        .eq(current)
        .addClass("current");
    var onscreen = thumbs.find(".owl-item.active").length - 1;
    var start = thumbs.find(".owl-item.active").first().index();
    var end = thumbs.find(".owl-item.active").last().index();

    if (current > end) {
        thumbs.data("owl.carousel").to(current, 100, true);
    }
    if (current < start) {
        thumbs.data("owl.carousel").to(current - onscreen, 100, true);
    }
}

function syncPosition2(el) {
    if (syncedSecondary) {
        var number = el.item.index;
        bigimage.data("owl.carousel").to(number, 100, true);
    }
}

thumbs.on("click", ".owl-item", function (e) {
    e.preventDefault();
    var number = $(this).index();
    bigimage.data("owl.carousel").to(number, 300, true);
});

$('[data-fancybox="gallery"]').fancybox({
    buttons: ["slideShow", "share", "zoom", "fullScreen", "close"],
    thumbs: {
        autoStart: true,
    },
});

$('[data-fancybox="gallery-images"]').fancybox({
    buttons: ["slideShow", "share", "zoom", "fullScreen", "close"],
    thumbs: {
        autoStart: true,
    },
});
$('[data-fancybox="productImage"]').fancybox({
    buttons: ["slideShow", "share", "zoom", "fullScreen", "close"],
    thumbs: {
        autoStart: true,
    },
});

$(".gallery.owl-carousel").owlCarousel({
    items: 7,
    loop: true,
    margin: 30,
    nav: true,
    smartSpeed: 900,
    autoplay: true,
    autoplayTimeout: 5000,
    navText: [
        "<i class='fa fa-chevron-left'></i>",
        "<i class='fa fa-chevron-right'></i>",
    ],
    responsive: {
        0: {
            items: 2,
            margin: 10,
        },
        767: {
            items: 2,
            margin: 10,
        },
        991: {
            items: 3,
            margin: 10,
        },
        1024: {
            items: 4,
            margin: 10,
        },
        1366: {
            items: 7,
            margin: 10,
        },
    },
});

$(".img_hover li").mouseover(function () {
    $(this).find(".imgMenu").addClass("active");
    $(this).siblings().find(".imgMenu").removeClass("active");
});

const openMenu = document.querySelector(".open-menu");
const closeMenu = document.querySelector(".close-menu");
const menuWrapper = document.querySelector(".menu-wrapper");
const hasCollapsible = document.querySelectorAll(".has-collapsible");

// Sidenav Toggle
// openMenu.addEventListener("click", function() {
//     menuWrapper.classList.add("off-canvas");
// });

// closeMenu.addEventListener("click", function() {
//     menuWrapper.classList.remove("off-canvas");
// });

// Collapsible Menu
hasCollapsible.forEach(function (collapsible) {
    collapsible.addEventListener("click", function () {
        collapsible.classList.toggle("active");

        // Close Other Collapsible
        hasCollapsible.forEach(function (otherCollapsible) {
            if (otherCollapsible !== collapsible) {
                otherCollapsible.classList.remove("active");
            }
        });
    });
});
// $(".dropdown-child li").hover(function () {
//   $(".show-img img").addClass("img__active");
// });

// });    // $(".dropdown-child li").hover(function () {
//   $(".show-img img").addClass("img__active");
// });

// });

$(".product-image").owlCarousel({
    items: 0,
    autoplay: false,
    autoplayTimeout: 3000,
    dots: true,
    loop: true,
    nav: true,
    margin: 30,
    responsive: {
        0: {
            items: 1,
        },
        600: {
            items: 1,
        },
        1000: {
            items: 1,
        },
    },
});

$(".product-thumbnail-item").owlCarousel({
    items: 1,
    autoplay: false,
    autoplayTimeout: 3000,
    dots: true,
    loop: true,
    nav: true,
    margin: 30,
    responsive: {
        0: {
            items: 1,
        },
        600: {
            items: 1,
        },
        1000: {
            items: 4,
        },
    },
});

$(".dimg-slider").owlCarousel({
    // animateOut: 'slideOutDown',
    // animateIn: 'slideOutFade',
    items: 1,
    dots: false,
    nav: true,
    loop: true,
    smartSpeed: 450,
    autoplay: false,
    autoplayTimeout: 3000,
    navText: [
        "<i class='fa fa-angle-left'></i>",
        "<i class='fa fa-angle-right'></i>",
    ],
});

$(".pro-page-slider").owlCarousel({
    loop: true,
    margin: 15,
    nav: false,
    dots: false,
    responsive: {
        0: {
            items: 3,
        },
        600: {
            items: 4,
        },
        1000: {
            items: 4,
        },
    },
});

var tooltipTriggerList = [].slice.call(
    document.querySelectorAll('[data-bs-toggle="tooltip"]')
);
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
});

// **************************************** cart page********************************************

/* ========================================== 
  Minus and Plus Btn Height
  ========================================== */

$(".minus-btn,.minus-btn-1").on("click", function (e) {
    e.preventDefault();
    var $this = $(this);
    var $input = $this.closest("div").find("input");
    var value = parseInt($input.val(), 10);
    if ($input.attr("name") == "pro_cart_qty") {
        if (value > 1) {
            value = value - 1;
        } else {
            value = 1;
        }
    } else {
        if (value > 1) {
            value = value - 1;
        } else {
            value = 0;
        }
    }

    $input.val(value);
    $input.trigger("change");
});

$(".plus-btn,.plus-btn-1").on("click", function (e) {
    e.preventDefault();
    var $this = $(this);
    var $input = $this.closest("div").find("input");
    var value = parseInt($input.val(), 10);
    if ($input.attr("name") == "pro_cart_qty") {
        if (value < 5) {
            value = value + 1;
        } else {
            value = 5;
        }
    } else {
        if (value < 100) {
            value = value + 1;
        } else {
            value = 100;
        }
    }

    $input.val(value);
    $input.trigger("change");

});

$(document).ready(function () {
    $("#accordion li > h4").click(function () {
        if ($(this).next().is(":visible")) {
            $(this).next().slideUp(300);
            $(this).children(".plusminus").text("+");
        } else {
            $(this).next("#accordion ul").slideDown(300);
            $(this).children(".plusminus").text("-");
        }
    });
});

$(".product_details").owlCarousel({
    // animateOut: 'slideOutDown',
    // animateIn: 'slideOutFade',
    items: 1,
    dots: false,
    nav: true,
    loop: true,
    smartSpeed: 450,
    autoplay: true,
    autoplayTimeout: 3000,
    navText: [
        "<i class='fa fa-angle-left'></i>",
        "<i class='fa fa-angle-right'></i>",
    ],
});

//==========modal owlCarousel==========//

$(document).ready(function () {
    var sync1 = $("#sync1");
    var sync2 = $("#sync2");
    var slidesPerPage = 4; //globaly define number of elements per page
    var syncedSecondary = true;

    sync1
        .owlCarousel({
            items: 1,
            slideSpeed: 2000,
            nav: false,
            autoplay: false,
            dots: false,
            loop: true,
            responsiveRefreshRate: 200,
            navText: [
                "<i class='fa fa-angle-left'></i>",
                "<i class='fa fa-angle-right'></i>",
            ],
        })
        .on("changed.owl.carousel", syncPosition);

    sync2
        .on("initialized.owl.carousel", function () {
            sync2.find(".owl-item").eq(0).addClass("current");
        })
        .owlCarousel({
            items: slidesPerPage,
            dots: true,
            nav: true,
            smartSpeed: 200,
            slideSpeed: 500,
            slideBy: slidesPerPage, //alternatively you can slide by 1, this way the active slide will stick to the first item in the second carousel
            responsiveRefreshRate: 100,
            navText: [
                "<i class='fa fa-angle-left'></i>",
                "<i class='fa fa-angle-right'></i>",
            ],
        })
        .on("changed.owl.carousel", syncPosition2);

    function syncPosition(el) {
        //if you set loop to false, you have to restore this next line
        //var current = el.item.index;

        //if you disable loop you have to comment this block
        var count = el.item.count - 1;
        var current = Math.round(el.item.index - el.item.count / 2 - 0.5);

        if (current < 0) {
            current = count;
        }
        if (current > count) {
            current = 0;
        }

        //end block

        sync2
            .find(".owl-item")
            .removeClass("current")
            .eq(current)
            .addClass("current");
        var onscreen = sync2.find(".owl-item.active").length - 1;
        var start = sync2.find(".owl-item.active").first().index();
        var end = sync2.find(".owl-item.active").last().index();

        if (current > end) {
            sync2.data("owl.carousel").to(current, 100, true);
        }
        if (current < start) {
            sync2.data("owl.carousel").to(current - onscreen, 100, true);
        }
    }

    function syncPosition2(el) {
        if (syncedSecondary) {
            var number = el.item.index;
            sync1.data("owl.carousel").to(number, 100, true);
        }
    }

    sync2.on("click", ".owl-item", function (e) {
        e.preventDefault();
        var number = $(this).index();
        sync1.data("owl.carousel").to(number, 300, true);
    });
});

$(".pimgimage-img").owlCarousel({
    // animateOut: 'slideOutDown',
    // animateIn: 'slideOutFade',
    items: 1,
    dots: false,
    nav: true,
    loop: true,
    smartSpeed: 450,
    autoplay: false,
    autoplayTimeout: 3000,
    // navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"]
});

//======thum salider======

$(document).ready(function () {
    var bicimage = $("#bicimg");
    var bcthumb = $("#bcthumb");
    //var totalslides = 10;
    var syncedSecondary = true;

    bicimage
        .owlCarousel({
            items: 1,
            slideSpeed: 2000,
            nav: false,
            autoplay: false,
            dots: false,
            loop: true,
            responsiveRefreshRate: 200,
            // navText: [
            //     '<i class="fa fa-arrow-left" aria-hidden="true"></i>',
            //     '<i class="fa fa-arrow-right" aria-hidden="true"></i>'
            // ]
        })
        .on("changed.owl.carousel", syncPosition);

    bcthumb
        .on("initialized.owl.carousel", function () {
            bcthumb.find(".owl-item").eq(0).addClass("current");
        })
        .owlCarousel({
            items: 4,
            dots: false,
            nav: false,
            // navText: [
            //     '<i class="fa fa-arrow-left" aria-hidden="true"></i>',
            //     '<i class="fa fa-arrow-right" aria-hidden="true"></i>'
            // ],
            smartSpeed: 200,
            slideSpeed: 500,
            slideBy: 4,
            responsiveRefreshRate: 100,
        })
        .on("changed.owl.carousel", syncPosition2);

    function syncPosition(el) {
        //if loop is set to false, then you have to uncomment the next line
        //var current = el.item.index;

        //to disable loop, comment this block
        var count = el.item.count - 1;
        var current = Math.round(el.item.index - el.item.count / 2 - 0.5);

        if (current < 0) {
            current = count;
        }
        if (current > count) {
            current = 0;
        }
        //to this
        bcthumb
            .find(".owl-item")
            .removeClass("current")
            .eq(current)
            .addClass("current");
        var onscreen = bcthumb.find(".owl-item.active").length - 1;
        var start = bcthumb.find(".owl-item.active").first().index();
        var end = bcthumb.find(".owl-item.active").last().index();

        if (current > end) {
            bcthumb.data("owl.carousel").to(current, 100, true);
        }
        if (current < start) {
            bcthumb.data("owl.carousel").to(current - onscreen, 100, true);
        }
    }

    function syncPosition2(el) {
        if (syncedSecondary) {
            var number = el.item.index;
            bicimage.data("owl.carousel").to(number, 100, true);
        }
    }

    bcthumb.on("click", ".owl-item", function (e) {
        e.preventDefault();
        var number = $(this).index();
        bicimage.data("owl.carousel").to(number, 300, true);
    });
});
