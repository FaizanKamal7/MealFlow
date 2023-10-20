$(document).ready(function () {
    const table = $("#unassigned_table").DataTable({
        dom: '<"top"f>t<"bottom"lip>',
        // Other DataTables options...
    });

    // Add an event listener to detect changes in the "Partner" dropdown
    $("#partnerSelect").on("change", function () {
        const selectedPartner = $(this).val();
        // Use DataTables' global search to filter rows based on the selected partner
        table.search(selectedPartner).draw();
    });

    // Add an event listener to detect changes in the "Emirate" dropdown
    $("#emirateSelect").on("change", function () {
        const selectedEmirate = $(this).val();
        // Use DataTables' global search to filter rows based on the selected emirate
        table.search(selectedEmirate).draw();
    });

    // Add an event listener to detect changes in the "Time Slot" dropdown
    $("#timeSlotSelect").on("change", function () {
        const selectedTimeSlot = $(this).val();
        // Use DataTables' global search to filter rows based on the selected time slot
        table.search(selectedTimeSlot).draw();
    });
});

//select partner function
// function changePartner() {
//     const selectedPartner = document.getElementById('partnerSelect').value;
//     const tableRows = document.querySelectorAll('#unassigned_table tbody tr');
//     tableRows.forEach(function(row) {
//         const partnerColumn = row.querySelector('.w-150px.partner');
//         if (partnerColumn) {
//             const partnerValue = partnerColumn.textContent.trim();
//             // Check if the partnerValue matches the selectedPartner
//             if (selectedPartner === '' || partnerValue === selectedPartner) {
//                 row.style.display = 'table-row';
//             } else {
//                 row.style.display = 'none';
//             }
//         }
//     });
// }

function printSelectedLabels() {
    // Get all checkboxes
    const checkboxes = document.querySelectorAll(
        'input.form-check-input[type="checkbox"]'
    );
    // Initialize an array to store selected values
    const selectedDeliveryIds = [];
    // Loop through checkboxes and add the selected values to the array
    checkboxes.forEach((checkbox) => {
        if (checkbox.checked) {
            selectedDeliveryIds.push(checkbox.value);
        }
    });
    console.log('checkboxes', checkboxes)
    // Create the URL for the new view with selected_delivery_ids as a query parameter
    const url = `/admin/deliveries/print-label?selected_deliveries=${selectedDeliveryIds.join(
        ","
    )}`;
    // Open the new view in a new window or tab
    window.open(url, "_blank");
}

// assign button
document.addEventListener("DOMContentLoaded", function () {
    // Get references to the "Assign" button and the driver selection dropdown
    const assignButton = document.getElementById("assignButton");
    const driverSelect = document.getElementById("driverSelect");
    // Add a click event listener to the "Assign" button
    assignButton.addEventListener("click", function () {
        // Get all the checked checkboxes
        const checkboxes = document.querySelectorAll(
            "input.form-check-input:checked"
        );
        // Get the selected driver's information
        const selectedDriverId = driverSelect.value;
        const selectedDriverName =
            driverSelect.options[driverSelect.selectedIndex].text;
        // Create an array to store the selected row data with the driver information
        const selectedRowsData = [];
        // Iterate through the checked checkboxes
        checkboxes.forEach(function (checkbox) {
            // Get the closest <tr> element (the parent row) for each checked checkbox
            const row = checkbox.closest("tr");
            // Collect the data from the row's cells (td elements)
            const rowData = Array.from(row.querySelectorAll("td")).map(
                function (cell) {
                    return cell.textContent.trim();
                }
            );
            // Add the driver information to the row's data
            rowData.push({
                driverId: selectedDriverId,
                driverName: selectedDriverName,
            });
            // Add the rowData array to the selectedRowsData array
            selectedRowsData.push(rowData);
        });
        // Prepare the data to be sent to the backend (you can customize this as needed)
        const dataToSend = {
            selectedRows: selectedRowsData,
            // Add other details here as needed
        };
        console.log('data', dataToSend)
        console.log("hehe", dataToSend);
        // Send an AJAX request to the backend (you need to specify the backend endpoint)
    });
});

function handleDriverSelection() {
    // Get the selected driver value
    const selectedDriverValue = document.getElementById("driverSelect").value;
    const assignButton = document.getElementById("assignButton");
    if (driverSelect.value !== "") {
        // Remove the "disabled" class from the "Assign" button
        assignButton.classList.remove("disabled");
        // Enable the button for interaction by removing the style attribute
        assignButton.removeAttribute("style");
    } else {
        // Add the "disabled" class to the "Assign" button if no driver is selected
        assignButton.classList.add("disabled");
        // Disable the button for interaction by setting the style attribute
        assignButton.style.pointerEvents = "none";
    }
}

// auto assign button
document.addEventListener("DOMContentLoaded", function () {
    // Get a reference to the "Auto Assign" button
    const autoAssignButton = document.getElementById("autoAssignButton");
    // Add a click event listener to the button
    autoAssignButton.addEventListener("click", function () {
        // Get all the checked checkboxes
        const checkboxes = document.querySelectorAll(
            "input.form-check-input:checked"
        );
        // Create an array to store the selected checkbox values
        const selectedRowData = [];
        // Iterate through the checked checkboxes
        checkboxes.forEach(function (checkbox) {
            // Get the closest tr > element(the parent row) for each checked checkbox
            const row = checkbox.closest("tr");
            // Collect the data from the row's cells (td elements)
            const rowData = Array.from(row.querySelectorAll("td")).map(
                function (cell) {
                    return cell.textContent.trim();
                }
            );
            // Add the rowData array to the selectedRowData array
            selectedRowData.push(rowData);
        });
        // Prepare the data to be sent to the backend (you can customize this as needed)
        const dataToSend = {
            selectedRows: selectedRowData,
            // Add other details here as needed
        };
        console.log("Selected Rows Data", dataToSend);

        // Send an AJAX request to the backend (you need to specify the backend endpoint)
        // You can use libraries like Axios or the native fetch API for this
        // Example using fetch:
        // fetch('/your-backend-endpoint', {
        // method: 'POST',
        // headers: {
        // 'Content-Type': 'application/json',
        // },
        // body: JSON.stringify(dataToSend),
        // })
        // .then(response => {
        // if (response.ok) {
        // // Handle success, e.g., show a success message
        // alert("Selected checkboxes have been sent to the backend.");
        // } else {
        // // Handle errors, e.g., display an error message
        // alert("An error occurred while sending data to the backend.");
        // }
        // })
        // .catch(error => {
        // // Handle network errors
        // console.error("Network error:", error);
        // });
    });
});

$(document).ready(function () {
    $("#kt_datepicker_7").flatpickr({
        altInput: true,
        altFormat: "j M Y", // Use "j M Y" for the format "12 Sept 2023"
        dateFormat: "Y-m-d",
        mode: "range",
    });

    // Get the table headers and populate the dropdown
    const tableHeaders = document.querySelectorAll(
        "#unassigned_table thead th"
    );
    const columnVisibilityDropdown =
        document.getElementById("columnVisibility");

    tableHeaders.forEach((header, index) => {
        const columnHeader = header.textContent.trim();
        const option = document.createElement("option");
        option.value = index;
        option.textContent = columnHeader;
        columnVisibilityDropdown.appendChild(option);
    });
    handleCheckboxSelection();
});

// Handle column visibility
$("#columnVisibility").change(function () {
    const selectedColumns = $(this).val();
    if (Array.isArray(selectedColumns)) {
        // Show all columns
        $("#unassigned_table th, #unassigned_table td").show();

        // Hide selected columns
        selectedColumns.forEach(function (index) {
            $(
                `#unassigned_table th:nth-child(${parseInt(index) + 1
                }), #unassigned_table td:nth-child(${parseInt(index) + 1})`
            ).hide();
        });
    } else {
        // Handle the case where selectedColumns is not an array
        console.error("selectedColumns is not an array.");
    }
});

function handleCheckboxSelection() {
    const checkboxes = document.querySelectorAll(".form-check-input");
    const selectOptionDiv = document.querySelector(".select-option-div");

    checkboxes.forEach((checkbox) => {
        checkbox.addEventListener("change", function () {
            const selectedCheckboxes = Array.from(checkboxes).filter(
                (cb) => cb.checked
            );
            if (selectedCheckboxes.length > 0) {
                selectOptionDiv.style.display = "flex"; // Show the select-option-div
            } else {
                selectOptionDiv.style.display = "none"; // Hide the select-option-div
            }
        });
    });
}

function uncheckAllCheckboxes() {
    const checkboxes = document.querySelectorAll(
        "input.form-check-input:checked"
    );
    checkboxes.forEach(function (checkbox) {
        checkbox.checked = false;
    });
    //hiding div
    const selectOptionDiv = document.querySelector(".select-option-div");
    selectOptionDiv.style.display = "none";
}

// Add an event listener for form submission
document.querySelector("form").addEventListener("submit", function (e) {
    e.preventDefault(); // Prevent the default form submission

    // Get all checked checkboxes
    const checkboxes = document.querySelectorAll(
        'input[name="delivery_ids[]"]:checked'
    );

    // Create an array to store the selected delivery IDs
    const selectedDeliveryIds = Array.from(checkboxes).map(
        (checkbox) => checkbox.value
    );

    // Add the selected delivery IDs as a hidden field in the form
    const hiddenField = document.createElement("input");
    hiddenField.type = "hidden";
    hiddenField.name = "selected_delivery_ids";
    hiddenField.value = selectedDeliveryIds.join(",");

    // Append the hidden field to the form
    this.appendChild(hiddenField);

    // Now, you can submit the form with the selected delivery IDs
    this.submit();
});


function assignDeliveries() {
    // Get all checkboxes
    const checkboxes = document.querySelectorAll('input.form-check-input[type="checkbox"]');
    // Initialize an array to store selected values
    const selectedDeliveryIds = [];
    // Loop through checkboxes and add the selected values to the array
    checkboxes.forEach((checkbox) => {
        if (checkbox.checked) {
            selectedDeliveryIds.push(checkbox.value);
        }
    });
    const driver_id = document.getElementById("driverSelect").value;

    var url = "/admin/deliveries/assigning_process/";

    $.ajax({
        url: url,
        type: "POST",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'), // Use the meta tag value
        },
        data: { selected_delivery_ids: selectedDeliveryIds, driver_id: driver_id },
        success: function (response) {
            console.log("Below is success");
            console.log(response.success);
            if (response.success) {
                // Show the success message right away
                toastr.success(response.success);

                // Now do the redirect
                window.location.href = response.redirect_url;
            }
        },
        error: function (error) {
            console.log("Below is error");
            console.log(error);
        }
    });

}

