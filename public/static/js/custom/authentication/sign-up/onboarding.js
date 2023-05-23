"use strict";
var KTCreateAccount = function() {
    var e, t, i, o, s, r, a = [];
    return {
        init: function() {
            (e = document.querySelector("#kt_modal_create_account")) && new bootstrap.Modal(e), t = document.querySelector("#kt_create_account_stepper"), i = t.querySelector("#kt_create_account_form"), o = t.querySelector('[data-kt-stepper-action="submit"]'), s = t.querySelector('[data-kt-stepper-action="next"]'), (r = new KTStepper(t)).on("kt.stepper.changed", (function(e) {
                4 === r.getCurrentStepIndex() ? (o.classList.remove("d-none"), o.classList.add("d-inline-block"), s.classList.add("d-none")) : 5 === r.getCurrentStepIndex() ? (o.classList.add("d-none"), s.classList.add("d-none")) : (o.classList.remove("d-inline-block"), o.classList.remove("d-none"), s.classList.remove("d-none"))
            })), r.on("kt.stepper.next", (function(e) {
                console.log("stepper.next");
                var t = a[e.getCurrentStepIndex() - 1];
                t ? t.validate().then((function(t) {
                    console.log("validated!"), "Valid" == t ? (e.goNext(), KTUtil.scrollTop()) : Swal.fire({
                        text: "Sorry, looks like there are some errors detected, please try again.",
                        icon: "error",
                        buttonsStyling: !1,
                        confirmButtonText: "Ok, got it!",
                        customClass: { confirmButton: "btn btn-light" }
                    }).then((function() {
                        KTUtil.scrollTop()
                    }))
                })) : (e.goNext(), KTUtil.scrollTop())
            })), r.on("kt.stepper.previous", (function(e) {
                console.log("stepper.previous"), e.goPrevious(), KTUtil.scrollTop()
            })), a.push(FormValidation.formValidation(i, {
                fields: {
                    account_type: { validators: { notEmpty: { message: "Account type is required" } } },
                    first_name: { validators: { notvalidatorsEmpty: { message: "first name is required" } } },
                    last_name: { validators: { notEmpty: { message: "last name is required" } } },
                    buisness_name: { validators: { notEmpty: { message: "Buisness name is required" } } },
                    email: { validators: { notEmpty: { message: "Email Adress is required" } } },
                    password: { validators: { notEmpty: { message: "Pasword is required" } } },
                    confirm_password: { validators: { notEmpty: { message: "" } } }

                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger,
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: ".fv-row",
                        eleInvalidClass: "",
                        eleValidClass: ""
                    })
                }
            })), a.push(FormValidation.formValidation(i, {
                fields: {
                    logo: { validators: { notEmpty: { message: "No File Choosen" } } },
                    phone_no: { validators: { notEmpty: { message: "Phone Number is required" } } },
                    country: { validators: { notEmpty: { message: "Country Not Selected" } } },
                    city: { validators: { notEmpty: { message: "Country Not Selected" } } },
                    state: { validators: { notEmpty: { message: "Country Not Selected" } } },
                    contact_email: { validators: { notEmpty: { message: "Contact Email is Required" } } },
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger,
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: ".fv-row",
                        eleInvalidClass: "",
                        eleValidClass: ""
                    })
                }
            })), a.push(FormValidation.formValidation(i, {
                fields: {
                    category: { validators: { notEmpty: { message: "Category is required" } } },


                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger,
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: ".fv-row",
                        eleInvalidClass: "",
                        eleValidClass: ""
                    })
                }
            })), a.push(FormValidation.formValidation(i, {
                fields: {
                    card_name: { validators: { notEmpty: { message: "Name on card is required" } } },
                    card_number: {
                        validators: {
                            notEmpty: { message: "Card member is required" },
                            creditCard: { message: "Card number is not valid" }
                        }
                    },
                    card_expiry_month: { validators: { notEmpty: { message: "Month is required" } } },
                    card_expiry_year: { validators: { notEmpty: { message: "Year is required" } } },
                    card_cvv: {
                        validators: {
                            notEmpty: { message: "CVV is required" },
                            digits: { message: "CVV must contain only digits" },
                            stringLength: { min: 3, max: 4, message: "CVV must contain 3 to 4 digits only" }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger,
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: ".fv-row",
                        eleInvalidClass: "",
                        eleValidClass: ""
                    })
                }
            })), o.addEventListener("click", (function(e) {
                a[3].validate().then((function(t) {
                    console.log("validated!"), "Valid" == t ? (e.preventDefault(), o.disabled = !0, o.setAttribute("data-kt-indicator", "on"), setTimeout((function() {
                        o.removeAttribute("data-kt-indicator"), o.disabled = !1, r.goNext()
                    }), 2e3)) : Swal.fire({
                        text: "Sorry, looks like there are some errors detected, please try again.",
                        icon: "error",
                        buttonsStyling: !1,
                        confirmButtonText: "Ok, got it!",
                        customClass: { confirmButton: "btn btn-light" }
                    }).then((function() {
                        KTUtil.scrollTop()
                    }))
                }))
            })), $(i.querySelector('[name="card_expiry_month"]')).on("change", (function() {
                a[3].revalidateField("card_expiry_month")
            })), $(i.querySelector('[name="card_expiry_year"]')).on("change", (function() {
                a[3].revalidateField("card_expiry_year")
            })), $(i.querySelector('[name="business_type"]')).on("change", (function() {
                a[2].revalidateField("business_type")
            }))
        }
    }
}();
KTUtil.onDOMContentLoaded((function() {
    KTCreateAccount.init()
}));


var _token = $("input[name='_token']").val();
$("#email_address").keyup(function() {
    var email_address = $("#email_address").val();
    $.ajax({
        url: "{{ route('validate_email') }}",
        type: "POST",
        data: {
            _token: _token,
            email_address: email_address
        },
        success: function(data) {
            if ($.isEmptyObject(data.error)) {
                console.log("unique");
                $("#kt_sign_up_submit").removeAttr("disabled");
                $("#email_alert").addClass("d-none");
            } else {
                console.log("duplicate")
                $("#kt_sign_up_submit").attr("disabled", "disabled");
                $("#email_alert").removeClass("d-none");
            }
        }
    });
})


function ajaxCall() {
    this.send = function(data, url, method, success, type) {
        type = 'json';
        var successRes = function(data) {
            success(data);
        }
        var errorRes = function(xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
        jQuery.ajax({
            url: url,
            type: method,
            data: data,
            success: successRes,
            error: errorRes,
            dataType: type,
            timeout: 60000
        });
    }
}

function locationInfo() {
    var rootUrl = "https://geodata.phplift.net/api/index.php";
    var call = new ajaxCall();
    this.getCities = function(id) {
        jQuery(".cities option:gt(0)").remove();
        var url = rootUrl + '?type=getCities&countryId=' + '&stateId=' + id;
        var method = "post";
        var data = {};
        jQuery('.cities').find("option:eq(0)").html("Please wait..");
        call.send(data, url, method, function(data) {
            jQuery('.cities').find("option:eq(0)").html("Select City");
            var listlen = Object.keys(data['result']).length;
            if (listlen > 0) {
                jQuery.each(data['result'], function(key, val) {
                    var option = jQuery('');
                    option.attr('value', val.name).text(val.name);
                    jQuery('.cities').append(option);
                });
            }
            jQuery(".cities").prop("disabled", false);
        });
    };

    this.getStates = function(id) {
        jQuery(".states option:gt(0)").remove();
        jQuery(".cities option:gt(0)").remove();
        var stateClasses = jQuery('#stateId').attr('class');


        var url = rootUrl + '?type=getStates&countryId=' + id;
        var method = "post";
        var data = {};
        jQuery('.states').find("option:eq(0)").html("Please wait..");
        call.send(data, url, method, function(data) {
            jQuery('.states').find("option:eq(0)").html("Select State");

            jQuery.each(data['result'], function(key, val) {
                var option = jQuery('');
                option.attr('value', val.name).text(val.name);
                option.attr('stateid', val.id);
                jQuery('.states').append(option);
            });
            jQuery(".states").prop("disabled", false);

        });
    };

    this.getCountries = function() {
        var url = rootUrl + '?type=getCountries';
        var method = "post";
        var data = {};
        jQuery('.countries').find("option:eq(0)").html("Please wait..");
        call.send(data, url, method, function(data) {
            jQuery('.countries').find("option:eq(0)").html("Select Country");

            jQuery.each(data['result'], function(key, val) {
                var option = jQuery('');

                option.attr('value', val.name).text(val.name);
                option.attr('countryid', val.id);

                jQuery('.countries').append(option);
            });
            // jQuery(".countries").prop("disabled",false);

        });
    };

}

jQuery(function() {
    var loc = new locationInfo();
    loc.getCountries();
    jQuery(".countries").on("change", function(ev) {
        var countryId = jQuery("option:selected", this).attr('countryid');
        if (countryId != '') {
            loc.getStates(countryId);
        } else {
            jQuery(".states option:gt(0)").remove();
        }
    });
    jQuery(".states").on("change", function(ev) {
        var stateId = jQuery("option:selected", this).attr('stateid');
        if (stateId != '') {
            loc.getCities(stateId);
        } else {
            jQuery(".cities option:gt(0)").remove();
        }
    });
});