jQuery(document).ready(function ($) {
    function validateStep1() {
        var isValid = true;
        var errorMessage = "";

        // Validate first name
        var firstName = $("#billing_first_name").val();
        if (!firstName) {
            isValid = false;
            errorMessage += "First name is required.<br>";
        }

        // Validate last name
        var lastName = $("#billing_last_name").val();
        if (!lastName) {
            isValid = false;
            errorMessage += "Last name is required.<br>";
        }

        // Validate country
        var country = $("#billing_country").val();
        if (!country) {
            isValid = false;
            errorMessage += "Country is required.<br>";
        }

        // Validate address
        var address = $("#billing_address_1").val();
        if (!address) {
            isValid = false;
            errorMessage += "Street address is required.<br>";
        }

        // Validate city
        var city = $("#billing_city").val();
        if (!city) {
            isValid = false;
            errorMessage += "City is required.<br>";
        }

        // Validate state
        var state = $("#billing_state").val();
        if (!state) {
            isValid = false;
            errorMessage += "State is required.<br>";
        }

        // Validate postcode
        var postcode = $("#billing_postcode").val();
        if (!postcode) {
            isValid = false;
            errorMessage += "Postcode is required.<br>";
        }

        // Validate phone
        var phone = $("#billing_phone").val();
        if (!phone) {
            isValid = false;
            errorMessage += "Phone is required.<br>";
        }

        // Validate email
        var email = $("#billing_email").val();
        if (!email) {
            isValid = false;
            errorMessage += "Email is required.<br>";
        } else if (!validateEmail(email)) {
            isValid = false;
            errorMessage += "Email is not valid.<br>";
        }

        if (!isValid) {
            $("#step-1 .button_error").html(errorMessage);
        } else {
            $("#step-1 .button_error").html(""); // Clear error message if validation is successful
        }

        return isValid;
    }

    function validateStep2() {
        var isValid = true;
        var errorMessage = "";

        if ($("#ship-to-different-address-checkbox").is(":checked")) {
            // Validate shipping first name
            var shippingFirstName = $("#shipping_first_name").val();
            if (!shippingFirstName) {
                isValid = false;
                errorMessage += "Shipping first name is required.<br>";
            }

            // Validate shipping last name
            var shippingLastName = $("#shipping_last_name").val();
            if (!shippingLastName) {
                isValid = false;
                errorMessage += "Shipping last name is required.<br>";
            }

            // Validate shipping address
            var shippingAddress = $("#shipping_address_1").val();
            if (!shippingAddress) {
                isValid = false;
                errorMessage += "Shipping address is required.<br>";
            }

            // Validate shipping city
            var shippingCity = $("#shipping_city").val();
            if (!shippingCity) {
                isValid = false;
                errorMessage += "Shipping city is required.<br>";
            }

            // Validate shipping state
            var shippingState = $("#shipping_state").val();
            if (!shippingState) {
                isValid = false;
                errorMessage += "Shipping state is required.<br>";
            }

            // Validate shipping postcode
            var shippingPostcode = $("#shipping_postcode").val();
            if (!shippingPostcode) {
                isValid = false;
                errorMessage += "Shipping postcode is required.<br>";
            }
        }

        if (!isValid) {
            $("#step-2 .button_error").html(errorMessage);
        } else {
            $("#step-2 .button_error").html(""); // Clear error message if validation is successful
        }

        return isValid;
    }

    function validateEmail(email) {
        var re =
            /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@(([^<>()[\]\.,;:\s@"]+\.)+[^<>()[\]\.,;:\s@"]{2,})$/i;
        return re.test(String(email).toLowerCase());
    }

    // Handle next button click
    $(".next-step").on("click", function () {
        var currentStep = $(this).closest(".checkout-step");
        var nextStep = currentStep.next(".checkout-step");

        if (currentStep.attr("id") === "step-1" && validateStep1()) {
            currentStep.hide();
            nextStep.show();
            $(".h_1").addClass("pass");
            $(".check_1 span").addClass("pass");
            $("#step-1 .button_error").html(""); // Clear error message
        } else if (currentStep.attr("id") === "step-2" && validateStep2()) {
            currentStep.hide();
            nextStep.show();
            $(".h_2").addClass("pass");
            $(".check_2 span").addClass("pass");
            $("#step-2 .button_error").html(""); // Clear error message
        }
    });

    // Handle back button click
    $(".prev-step").on("click", function () {
        var currentStep = $(this).closest(".checkout-step");
        var prevStep = currentStep.prev(".checkout-step");

        currentStep.hide();
        prevStep.show();

        if (currentStep.attr("id") === "step-2") {
            $(".h_1").removeClass("pass");
            $(".check_1 span").removeClass("pass");
            $("#step-1 .button_error").html(""); // Clear error message
        } else if (currentStep.attr("id") === "step-3") {
            $(".h_2").removeClass("pass");
            $(".check_2 span").removeClass("pass");
            $("#step-2 .button_error").html(""); // Clear error message
        }
    });

    $("#ship-to-different-address-checkbox").on("change", function () {
        $(this).toggleClass("active");
    });
});

document.addEventListener("DOMContentLoaded", function () {
    function setPlaceholder(selector, content) {
        var element = document.querySelector(selector);
        if (element) {
            element.placeholder = content;
        } else {
            console.error("Element with selector '" + selector + "' not found.");
        }
    }

    if (document.querySelector(".woocommerce-billing-fields__field-wrapper")) {
        setPlaceholder("#billing_first_name", "First Name");
        setPlaceholder("#billing_last_name", "Last Name");
        setPlaceholder("#billing_company", "Company Name");
        setPlaceholder("#billing_city", "City");
        setPlaceholder("#billing_postcode", "Post Code");
        setPlaceholder("#billing_phone", "Phone");
        setPlaceholder("#billing_email", "Email Address");
    }
    if (document.querySelector(".woocommerce-shipping-fields__field-wrapper")) {
        setPlaceholder("#shipping_first_name", "First Name");
        setPlaceholder("#shipping_last_name", "Last Name");
        setPlaceholder("#shipping_company", "Company Name");
        setPlaceholder("#shipping_city", "City");
        setPlaceholder("#shipping_postcode", "Post Code");
    }
});
