jQuery(document).ready(function ($) {
    // Cart Text
    function ensureCartText() {
        var $div = $(".header_upper .fkcart-mini-toggler");
        if (!$div.text().includes("My Cart")) {
            $div.append(" My Cart");
        }
    }
    ensureCartText();
    setInterval(ensureCartText, 500);

    // Header Search
    $(".header_search-input").on("focus", function () {
        $(".header_search-drop").fadeIn();
    });

    $(".fkcart-toggler").on("click", function () {
        $(".header_search-drop").fadeOut();
    });

    $("#header").on("click", function (event) {
        // Check if the click was outside .header_search-drop and .header_search-input
        if (
            !$(event.target).closest(".header_search-drop").length &&
            !$(event.target).closest(".header_search-input").length
        ) {
            $(".header_search-drop").fadeOut();
        }
    });

    $(document).on("click", ".header_search-drop", function (event) {
        if ($(event.target).hasClass("header_search-drop")) {
            $(".header_search-drop").fadeOut();
        }
    });

    // product quantity selector
    const quantity_input = $(".quantity input");
    $(".remove_quantity").click(function () {
        let currentValue = parseInt(quantity_input.val(), 10);
        if (!isNaN(currentValue) && currentValue > 0) {
            quantity_input.val(currentValue - 1);
        }
    });
    $(".add_quantity").click(function () {
        let currentValue = parseInt(quantity_input.val(), 10);
        if (!isNaN(currentValue)) {
            quantity_input.val(currentValue + 1);
        }
    });

    var toastElement = document.getElementById("cart-toast");
    var toast = new bootstrap.Toast(toastElement);

    // Account text changing
    function updateButtonText() {
        var activeText = $(".account_mobile-list li.is-active a").text();
        if (activeText) {
            $(".account_mobile-btn").text(activeText);
        }
    }
    updateButtonText();

    $(".account_mobile-list li a").on("click", function () {
        $(".account_mobile-list li").removeClass("is-active");
        $(this).parent().addClass("is-active");
        updateButtonText();
    });

    // Remove class in toggler
    if ($(window).width() < 992) {
        $("#mobile_summary-content").removeClass("show");
    } else {
        $("#mobile_summary-content").addClass("show");
    }

    // Remove class in toggler
    $(document).ready(function () {
        if ($(window).width() < 992) {
            $(".archive_left-filter").removeClass("show");
        }
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const productElement = document.getElementById("product");
    if (productElement) {
        new Splide("#product", {
            type: "slide",
            perPage: 4,
            perMove: 1,
            pagination: false,
            arrows: true,
            breakpoints: {
                1024: {
                    perPage: 3,
                },
                576: {
                    perPage: 2,
                },
            },
        }).mount();
    }
});
