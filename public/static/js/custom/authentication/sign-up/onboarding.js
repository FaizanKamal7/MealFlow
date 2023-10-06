// import axios from 'axios';
// const { default: axios } = require("axios");

("use strict");
var KTCreateAccount = (function () {
    var e,
        t,
        i,
        o,
        s,
        r,
        a = [];
    return {
        init: function () {
            (e = document.querySelector("#kt_modal_create_account")) &&
                new bootstrap.Modal(e),
                (t = document.querySelector("#kt_create_account_stepper")),
                (i = t.querySelector("#kt_create_account_form")),
                (o = t.querySelector('[data-kt-stepper-action="submit"]')),
                (s = t.querySelector('[data-kt-stepper-action="next"]')),
                (r = new KTStepper(t)).on("kt.stepper.changed", function (e) {
                    4 === r.getCurrentStepIndex()
                        ? (o.classList.remove("d-none"),
                            o.classList.add("d-inline-block"),
                            s.classList.add("d-none"))
                        : 5 === r.getCurrentStepIndex()
                            ? (o.classList.add("d-none"), s.classList.add("d-none"))
                            : (o.classList.remove("d-inline-block"),
                                o.classList.remove("d-none"),
                                s.classList.remove("d-none"));
                }),
                r.on("kt.stepper.next", function (e) {
                    console.log("stepper.next");
                    var t = a[e.getCurrentStepIndex() - 1];
                    t
                        ? t.validate().then(function (t) {
                            console.log("validated!"),
                                "Valid" == t
                                    ? (e.goNext(), KTUtil.scrollTop())
                                    : Swal.fire({
                                        text: "Sorry, looks like there are some errors detected, please try again.",
                                        icon: "error",
                                        buttonsStyling: !1,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {
                                            confirmButton: "btn btn-light",
                                        },
                                    }).then(function () {
                                        KTUtil.scrollTop();
                                    });
                        })
                        : (e.goNext(), KTUtil.scrollTop());
                }),
                r.on("kt.stepper.previous", function (e) {
                    console.log("stepper.previous"),
                        e.goPrevious(),
                        KTUtil.scrollTop();
                }),
                a.push(
                    FormValidation.formValidation(i, {
                        fields: {
                            account_type: {
                                validators: {
                                    notEmpty: {
                                        message: "Account type is required",
                                    },
                                },
                            },
                            first_name: {
                                validators: {
                                    notEmpty: {
                                        message: "First name is required",
                                    },
                                    regexp: {
                                        regexp: /^[^\d]+$/,
                                        message:
                                            "First name should not contain digits",
                                    },
                                },
                            },
                            last_name: {
                                validators: {
                                    notEmpty: {
                                        message: "Last name is required",
                                    },
                                    regexp: {
                                        regexp: /^[^\d]+$/,
                                        message:
                                            "First name should not contain digits",
                                    },
                                },
                            },
                            buisness_name: {
                                validators: {
                                    notEmpty: {
                                        message: "Buisness name is required",
                                    },
                                    async: {
                                        url: "is-unique-vehicle",
                                        type: "get",
                                        data: {
                                            field: "registration_number",
                                            value: function () {
                                                return $(
                                                    '[name="registration_number"]'
                                                ).val();
                                            },
                                        },
                                        message:
                                            "Registration number already exists",
                                        delay: 500,
                                    },
                                },
                            },
                            email: {
                                validators: {
                                    notEmpty: {
                                        message: "Email Address is required",
                                    },
                                    emailAddress: {
                                        message:
                                            "The input is not a valid email address",
                                    },
                                },
                            },
                            password: {
                                validators: {
                                    notEmpty: {
                                        message: "Pasword is required",
                                    },
                                },
                            },
                            confirm_password: {
                                validators: {
                                    notEmpty: {
                                        message: "Confirm Password is required",
                                    },

                                    identical: {
                                        compare: function () {
                                            return $('[name="password"]').val();
                                        },
                                        message:
                                            "The password and its confirm must be the same",
                                    },
                                },
                            },
                        },
                        plugins: {
                            trigger: new FormValidation.plugins.Trigger(),
                            bootstrap: new FormValidation.plugins.Bootstrap5({
                                rowSelector: ".fv-row",
                                eleInvalidClass: "",
                                eleValidClass: "",
                            }),
                        },
                    })
                ),
                a.push(
                    FormValidation.formValidation(i, {
                        fields: {
                            logo: {
                                // validators: {
                                //     notEmpty: { message: "No File Choosen" },
                                // },
                            },
                            phone_no: {
                                // validators: {
                                //     notEmpty: {
                                //         message: "Phone Number is required",
                                //     },
                                // },
                            },
                            country: {
                                // validators: {
                                //     notEmpty: {
                                //         message: "Country Not Selected",
                                //     },
                                // },
                            },
                            city: {
                                // validators: {
                                //     notEmpty: {
                                //         message: "City Not Selected",
                                //     },
                                // },
                            },
                            state: {
                                // validators: {
                                //     notEmpty: {
                                //         message: "State Not Selected",
                                //     },
                                // },
                            },
                            contact_email: {
                                // validators: {
                                //     notEmpty: {
                                //         message: "Contact Email is Required",
                                //     },
                                // },
                            },
                        },
                        plugins: {
                            trigger: new FormValidation.plugins.Trigger(),
                            bootstrap: new FormValidation.plugins.Bootstrap5({
                                rowSelector: ".fv-row",
                                eleInvalidClass: "",
                                eleValidClass: "",
                            }),
                        },
                    })
                ),
                a.push(
                    FormValidation.formValidation(i, {
                        fields: {
                            category: {
                                validators: {
                                    notEmpty: {
                                        message: "Category is required",
                                    },
                                },
                            },
                        },
                        plugins: {
                            trigger: new FormValidation.plugins.Trigger(),
                            bootstrap: new FormValidation.plugins.Bootstrap5({
                                rowSelector: ".fv-row",
                                eleInvalidClass: "",
                                eleValidClass: "",
                            }),
                        },
                    })
                ),
                a.push(
                    FormValidation.formValidation(i, {
                        fields: {
                            card_name: {
                                validators: {
                                    notEmpty: {
                                        message: "Name on card is required",
                                    },
                                },
                            },
                            card_number: {
                                validators: {
                                    notEmpty: {
                                        message: "Card member is required",
                                    },
                                    creditCard: {
                                        message: "Card number is not valid",
                                    },
                                },
                            },
                            card_expiry_month: {
                                validators: {
                                    notEmpty: { message: "Month is required" },
                                },
                            },
                            card_expiry_year: {
                                validators: {
                                    notEmpty: { message: "Year is required" },
                                },
                            },
                            card_cvv: {
                                validators: {
                                    notEmpty: { message: "CVV is required" },
                                    digits: {
                                        message: "CVV must contain only digits",
                                    },
                                    stringLength: {
                                        min: 3,
                                        max: 4,
                                        message:
                                            "CVV must contain 3 to 4 digits only",
                                    },
                                },
                            },
                        },
                        plugins: {
                            trigger: new FormValidation.plugins.Trigger(),
                            bootstrap: new FormValidation.plugins.Bootstrap5({
                                rowSelector: ".fv-row",
                                eleInvalidClass: "",
                                eleValidClass: "",
                            }),
                        },
                    })
                ),
                o.addEventListener("click", function (e) {
                    a[3].validate().then(function (t) {
                        console.log("validated!"),
                            "Valid" == t
                                ? (e.preventDefault(),
                                    //   (o.disabled = !0),
                                    //   o.setAttribute("data-kt-indicator", "on"),
                                    //   setTimeout(function () {
                                    //         e.submit(),
                                    //       o.removeAttribute("data-kt-indicator"),
                                    //           (o.disabled = !1),
                                    //           r.goNext();
                                    //   }, 2e3))

                                    // Get the form element by its ID

                                    (o.disabled = true),
                                    o.setAttribute("data-kt-indicator", "on"),
                                    setTimeout(function () {
                                        // Submit the form programmatically
                                        var form = document.getElementById(
                                            "kt_create_account_form"
                                        );

                                        form.submit();

                                        o.removeAttribute("data-kt-indicator");
                                        o.disabled = false;
                                        r.goNext();
                                    }, 2e3))
                                : Swal.fire({
                                    text: "Sorry, looks like there are some errors detected, please try again.",
                                    icon: "error",
                                    buttonsStyling: !1,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn btn-light",
                                    },
                                }).then(function () {
                                    KTUtil.scrollTop();
                                });
                    });
                }),
                $(i.querySelector('[name="card_expiry_month"]')).on(
                    "change",
                    function () {
                        a[3].revalidateField("card_expiry_month");
                    }
                ),
                $(i.querySelector('[name="card_expiry_year"]')).on(
                    "change",
                    function () {
                        a[3].revalidateField("card_expiry_year");
                    }
                ),
                $(i.querySelector('[name="business_type"]')).on(
                    "change",
                    function () {
                        a[2].revalidateField("business_type");
                    }
                );
        },
    };
})();
KTUtil.onDOMContentLoaded(function () {
    KTCreateAccount.init();
});

var _token = $("input[name='_token']").val();
$("#email_address").keyup(function () {
    var email_address = $("#email_address").val();
    $.ajax({
        url: "{{ route('validate_email') }}",
        type: "POST",
        data: {
            _token: _token,
            email_address: email_address,
        },
        success: function (data) {
            if ($.isEmptyObject(data.error)) {
                console.log("unique");
                $("#kt_sign_up_submit").removeAttr("disabled");
                $("#email_alert").addClass("d-none");
            } else {
                console.log("duplicate");
                $("#kt_sign_up_submit").attr("disabled", "disabled");
                $("#email_alert").removeClass("d-none");
            }
        },
    });
});

// config.js


function fetchDeliverySlotsOfCity() {
    fetchAreasWithMultiSelectOption();
    var cityID = document.getElementById("city").value;
    var deliverySlotsDropdown = document.getElementById("delivery_slots");

    // Clear current options
    deliverySlotsDropdown.innerHTML = '<option value="">Select Slot</option>';

    // Make AJAX request to fetch area
    if (cityID) {
        var url = "/core/settings/delivery-slots/get-delivery-slots-of-city";

        $.ajax({
            url: url,
            method: "GET",
            dataType: "json",
            data: { city_id: cityID },
            success: function (response) {
                // Keep track of the iterations
                var iteration = 0;

                // Populate city dropdown
                // Loop through the response data and create an option element for each item
                response.forEach((item) => {
                    // If it's the first iteration, append the "Select All" option
                    if (iteration === 0) {
                        const allOption = document.createElement("option");
                        allOption.value = "all";
                        allOption.text = "Select All";
                        deliverySlotsDropdown.appendChild(allOption);
                    }
                    const option = document.createElement("option");
                    option.value = item.id; // Set the value attribute
                    option.text = item.start_time + " - " + item.end_time; // Set the displayed text
                    deliverySlotsDropdown.appendChild(option); // Add the option to the dropdown
                    iteration++; // Increase the counter
                });
            },
            error: function (error) {
                console.log(error);
            },
        });
    }
}

function fetchAreasWithMultiSelectOption() {
    var cityID = document.getElementById("city").value;
    var areaDropdown = document.getElementById("area");

    // Clear current options
    areaDropdown.innerHTML = '<option value="">Select area</option>';

    // Make AJAX request to fetch area
    if (cityID) {
        var url = "/core/settings/locations/get-areas";

        $.ajax({
            url: url,
            method: "GET",
            dataType: "json",
            data: { city_id: cityID },
            success: function (response) {
                // Keep track of the iterations
                var iteration = 0;

                // Populate city dropdown
                // Loop through the response data and create an option element for each item
                response.forEach((item) => {
                    // If it's the first iteration, append the "Select All" option
                    if (iteration === 0) {
                        const allOption = document.createElement("option");
                        allOption.value = "all";
                        allOption.text = "Select All";
                        areaDropdown.appendChild(allOption);
                    }
                    const option = document.createElement("option");
                    option.value = item.id; // Set the value attribute
                    option.text = item.name; // Set the displayed text
                    areaDropdown.appendChild(option); // Add the option to the dropdown
                    iteration++; // Increase the counter
                });
            },
            error: function (error) {
                console.log(error);
            },
        });
    }
}

function fetchAddressAreas() {

    var cityID = document.getElementById("address_city").value;

    var areaDropdown = document.getElementById("address_area");

    // Clear current options
    areaDropdown.innerHTML = '<option value="">Select area</option>';

    // Make AJAX request to fetch area
    if (cityID) {
        var url = "/core/settings/locations/get-areas";

        $.ajax({
            url: url,
            method: "GET",
            dataType: "json",
            data: { city_id: cityID },
            success: function (response) {
                var area = response;
                // Populate city dropdown
                // Loop through the response data and create an option element for each item
                area.forEach((item) => {
                    console.log(item);
                    const option = document.createElement("option");
                    option.value = item.id; // Set the value attribute
                    option.text = item.name; // Set the displayed text
                    areaDropdown.appendChild(option); // Add the option to the dropdown
                });
            },
            error: function (error) {
                console.log(error);
            },
        });
    }
}

function fetchAddressCities() {
    var stateID = document.getElementById("address_state").value;
    var cityDropdown = document.getElementById("address_city");
    // Clear current options
    cityDropdown.innerHTML = '<option value="">Select city</option>';

    // Make AJAX request to fetch city
    if (stateID) {
        var url = "/core/settings/locations/get-cities";

        $.ajax({
            url: url,
            method: "GET",
            dataType: "json",
            data: { state_id: stateID },
            success: function (response) {
                var city = response;
                // Populate city dropdown
                // Loop through the response data and create an option element for each item
                city.forEach((item) => {
                    console.log(item);
                    const option = document.createElement("option");
                    option.value = item.id; // Set the value attribute
                    option.text = item.name; // Set the displayed text
                    cityDropdown.appendChild(option); // Add the option to the dropdown
                });
            },
            error: function (error) {
                console.log(error);
            },
        });
    }
}

function fetchAddressStates() {
    var countryId = document.getElementById("address_country").value;
    var stateDropdown = document.getElementById("address_state");

    // Clear current options
    stateDropdown.innerHTML = '<option value="">Select state</option>';

    // Make AJAX request to fetch states
    if (countryId) {
        var url = "/core/settings/locations/get-states";

        $.ajax({
            url: url,
            method: "GET",
            dataType: "json",
            data: { country_id: countryId },
            success: function (response) {
                var states = response;
                console.log("states");
                console.log(states);
                // Populate states dropdown
                // Loop through the response data and create an option element for each item
                states.forEach((item) => {
                    console.log(item);
                    const option = document.createElement("option");
                    option.value = item.id; // Set the value attribute
                    option.text = item.name; // Set the displayed text
                    stateDropdown.appendChild(option); // Add the option to the dropdown
                });
            },
            error: function (error) {
                console.log(error);
            },
        });
    }
}
