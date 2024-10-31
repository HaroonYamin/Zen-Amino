jQuery(document).ready(function ($) {
    $(".add-to-cart-button").on("click", function (e) {
        e.preventDefault();

        var productId = $(this).data("product-id");
        var productName = $(this).closest(".product_card").find(".product_card-title").text(); // Fetch the product name

        $.ajax({
            type: "POST",
            url: woo_ajax_obj.ajax_url,
            data: {
                action: "add_to_cart_action",
                product_id: productId,
            },
            success: function (response) {
                if (response === "success") {
                    // Update the toast body with the product name
                    $("#cart-toast .toast-body").text(" Item Added: " + productName);
                    $("#cart-toast").toast("show"); // Show the toast
                }
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
            },
        });
    });
});

// Displaying number of items in cart
jQuery(document).ready(function ($) {
    var initialCartCount = parseInt($("#cart-count").text());

    function updateCartCount() {
        $.ajax({
            url: woo_ajax_obj.ajax_url,
            type: "POST",
            data: {
                action: "update_cart_count",
            },
            success: function (response) {
                var currentCartCount = parseInt(response);
                $("#cart-count").text(response);
            },
        });
    }

    // Call updateCartCount when the page loads
    updateCartCount();

    // Update the cart count periodically (every X seconds)
    setInterval(updateCartCount, 1000); // Adjust the interval as needed (e.g., 10000 ms = 10 seconds)
});

// Displaying Cart
jQuery(document).ready(function ($) {
    // Function to load cart contents
    function loadCartContents() {
        $.ajax({
            url: woo_ajax_obj.ajax_url,
            type: "POST",
            data: {
                action: "load_cart_contents",
            },
            success: function (response) {
                if (response.success) {
                    $("#offcanvas-cart-content").html(response.data.cart_contents);
                }
            },
        });
    }

    // Function to update cart quantity and price
    function updateCartQuantity(product_key, quantity) {
        $.ajax({
            url: woo_ajax_obj.ajax_url,
            type: "POST",
            data: {
                action: "update_cart_quantity",
                product_key: product_key,
                quantity: quantity,
            },
            success: function (response) {
                if (response.success) {
                    // Reload cart contents after updating quantity
                    loadCartContents();
                }
            },
        });
    }

    // Load cart contents when the off-canvas is opened
    $('[data-bs-target="#cart-canvas"]').on("click", function () {
        loadCartContents();
    });

    // Close offcanvas
    $('[data-bs-dismiss="offcanvas"]').on("click", function () {
        $(".offcanvas").offcanvas("hide");
    });

    // Example of how to trigger cart update (e.g., after adding/removing item)
    $("body").on("added_to_cart removed_from_cart", function () {
        loadCartContents();
    });

    // Example of updating cart quantity on quantity change event
    $("body").on("change", ".cart-quantity-input", function () {
        var product_key = $(this).data("product-key");
        var quantity = $(this).val();
        updateCartQuantity(product_key, quantity);
    });

    // Example of removing item from cart
    $("body").on("click", ".remove-item", function (e) {
        e.preventDefault(); // Prevent the default action
        e.stopPropagation(); // Stop event propagation

        var product_key = $(this).data("product-key");
        $.ajax({
            url: woo_ajax_obj.ajax_url,
            type: "POST",
            data: {
                action: "remove_cart_item",
                product_key: product_key,
            },
            success: function (response) {
                if (response.success) {
                    // Reload cart contents after removing item
                    loadCartContents();
                }
            },
        });
    });
});

// Blogs Sidebar Search
jQuery(document).ready(function ($) {
    $('input[type="search"]').on("input", function () {
        var searchQuery = $(this).val();

        $.ajax({
            url: woo_ajax_obj.ajax_url,
            type: "POST",
            data: {
                action: "filter_categories",
                search_query: searchQuery,
            },
            success: function (response) {
                $(".archive_categories ul").html(response);
            },
        });
    });
});

// Header Search
jQuery(document).ready(function ($) {
    function handleSearch(searchValue) {
        console.log("handling start");
        // AJAX request to search products
        $.ajax({
            url: woo_ajax_obj.ajax_url,
            type: "POST",
            data: {
                action: "search_products", // PHP function to handle this action
                search: searchValue,
            },
            success: function (response) {
                console.log("success");
                $("#searched-products-container").html(response); // Update products container with AJAX response
            },
        });

        // AJAX request to search tags
        $.ajax({
            url: woo_ajax_obj.ajax_url,
            type: "POST",
            data: {
                action: "search_tags", // PHP function to handle this action
                search: searchValue,
            },
            success: function (response) {
                $(".header_search-drop_tags").html(response); // Update tags container with AJAX response
            },
        });
    }

    $("#search").keyup(function () {
        var searchValue = $(this).val();
        handleSearch(searchValue);
    });

    $(".header_mobile-search_drop-input").keyup(function () {
        var searchValue = $(this).val();
        handleSearch(searchValue);
    });
});
