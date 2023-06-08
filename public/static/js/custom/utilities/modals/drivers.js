"use strict";
var KTModalNewAddress = (function () {
    var t, e, n, o, i, r;
    return {
        init: function () {
            (r = document.querySelector("#nixus_add_new_driver")) &&
                ((i = new bootstrap.Modal(r)),
                (o = document.querySelector("#nixus_add_new_driver_form")),
                (t = document.getElementById("nixus_add_new_driver_submit")),
                (e = document.getElementById("nixus_add_new_driver_cancel")),



                (n = FormValidation.formValidation(o, {
                    fields: {
                        Employee1: {
                            validators: {
                                notEmpty: { message: "Employee  is required" },
                            },
                        },


                        Licence: {
                            validators: {
                                notEmpty: { message: " Licence Number is required" },
                            },
                        },
                        Licence_Document: {
                            validators: {
                                notEmpty: { message: "Licence Document  is required" },
                            },
                        },
                        licence_Date: {
                            validators: {
                                notEmpty: { message: "Licence Date  is required" },
                            },
                        },
                        Experience: {
                            validators: {
                                notEmpty: { message: "Experience is required" },
                            },
                        },
                        Available: {
                            validators: {
                                notEmpty: { message: "Please Checked The Driver Availibility" },
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
                })),
                t.addEventListener("click", function (e) {
                    e.preventDefault(),
                        n &&
                            n.validate().then(function (e) {
                                console.log("validated!"),
                                    "Valid" == e
                                        ? (t.setAttribute(
                                              "data-kt-indicator",
                                              "on"
                                          ),
                                          (t.disabled = !0),
                                          setTimeout(function () {
                                              t.removeAttribute(
                                                  "data-kt-indicator"
                                              ),
                                                  (t.disabled = !1),
                                                  Swal.fire({
                                                      text: "Form has been successfully submitted!",
                                                      icon: "success",
                                                      buttonsStyling: !1,
                                                      confirmButtonText:
                                                          "Ok, got it!",
                                                      customClass: {
                                                          confirmButton:
                                                              "btn btn-primary",
                                                      },
                                                  }).then(function (t) {
                                                      t.isConfirmed && i.hide();
                                                  });
                                          }, 2e3))
                                        : Swal.fire({
                                              text: "Sorry, looks like there are some errors detected, please try again.",
                                              icon: "error",
                                              buttonsStyling: !1,
                                              confirmButtonText: "Ok, got it!",
                                              customClass: {
                                                  confirmButton:
                                                      "btn btn-primary",
                                              },
                                          });
                            });
                }),
                e.addEventListener("click", function (t) {
                    t.preventDefault(),
                        Swal.fire({
                            text: "Are you sure you would like to cancel?",
                            icon: "warning",
                            showCancelButton: !0,
                            buttonsStyling: !1,
                            confirmButtonText: "Yes, cancel it!",
                            cancelButtonText: "No, return",
                            customClass: {
                                confirmButton: "btn btn-primary",
                                cancelButton: "btn btn-active-light",
                            },
                        }).then(function (t) {
                            t.value
                                ? (o.reset(), i.hide())
                                : "cancel" === t.dismiss &&
                                  Swal.fire({
                                      text: "Your form has not been cancelled!.",
                                      icon: "error",
                                      buttonsStyling: !1,
                                      confirmButtonText: "Ok, got it!",
                                      customClass: {
                                          confirmButton: "btn btn-primary",
                                      },
                                  });
                        });
                }));
                $("#employee").change(function () {
                    // Revalidate the field when an option is chosen
                    n.revalidateField('Employee1');
                });
        },
    };
})();
KTUtil.onDOMContentLoaded(function () {
    KTModalNewAddress.init();
});



const optionFormat = (item) => {
    if (!item.id) {
        return item.text;
    }

    var span = document.createElement('span');
    var template = '';

    template += '<div class="d-flex align-items-center">';
    template += '<img src="' + item.element.getAttribute('data-kt-rich-content-icon') + '" class="rounded-circle h-40px me-3" alt="' + item.text + '"/>';
    template += '<div class="d-flex flex-column">'
    template += '<span class="fs-4 fw-bolder lh-1">' + item.text + '</span>';
    template += '<span class="text-muted fs-5">' + item.element.getAttribute('data-kt-rich-content-subcontent') + '</span>';
    template += '</div>';
    template += '</div>';

    span.innerHTML = template;

    return $(span);
}

// Init Select2 --- more info: https://select2.org/
$('#employee').select2({
    placeholder: "Select an option",
    minimumResultsForSearch: Infinity,
    templateSelection: optionFormat,
    templateResult: optionFormat
});

