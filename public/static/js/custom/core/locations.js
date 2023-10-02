function fetchStates(...parameters) {
    var countryId = "";
    var stateDropdown = "";
    var stateDropdown = document.getElementById("state");

    if (parameters.length >= 1) {
        var selectElement = parameters[0];
        // Find the parent repeater item to get its index
        var repeaterItem = $(selectElement).closest('[data-repeater-item]');
        var index = repeaterItem.index();

        // Generate the unique ID for the country dropdown using the index
        var countryDropdownId = 'country_' + index;

        // Get the selected value of the country dropdown
        var countryId = $(selectElement).val();

        // Get the ID of the state dropdown using the generated ID
        var stateDropdownId = 'state_' + index;
        var selectedStateValue = $('#' + stateDropdownId).val();

        // Now you can use the generated IDs and selected values for whatever you need
        console.log('Generated ID for country dropdown:', countryDropdownId);
        console.log('Selected country value:', countryId);
        console.log('Generated ID for state dropdown:', stateDropdownId);
        console.log('Selected state value:', selectedStateValue);

    } else {
        var countryId = document.getElementById("country").value;
        var stateDropdown = document.getElementById("state");
        console.log("Inside IF " + countryId.value + " " + stateDropdown);

    }


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


function fetchStatesWithMultiSelectOption() {
    var countryId = document.getElementById("country").value;
    var stateDropdown = document.getElementById("state");

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
                        stateDropdown.appendChild(allOption);
                    }
                    const option = document.createElement("option");
                    option.value = item.id; // Set the value attribute
                    option.text = item.name; // Set the displayed text
                    stateDropdown.appendChild(option); // Add the option to the dropdown
                    iteration++; // Increase the counter
                });
            },
            error: function (error) {
                console.log(error);
            },
        });
    }
}

function fetchCities() {
    var stateID = document.getElementById("state").value;
    var cityDropdown = document.getElementById("city");

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


function fetchCitiesWithMultiSelectOption() {
    var stateID = document.getElementById("state").value;
    var cityDropdown = document.getElementById("city");
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
                        cityDropdown.appendChild(allOption);
                    }
                    const option = document.createElement("option");
                    option.value = item.id; // Set the value attribute
                    option.text = item.name; // Set the displayed text
                    cityDropdown.appendChild(option); // Add the option to the dropdown
                    iteration++; // Increase the counter
                });
            },
            error: function (error) {
                console.log(error);
            },
        });
    }
}

function fetchAreas() {
    console.log('here in location')
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
                console.log('area', response)
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



$(document).ready(function () {
    // Make an AJAX request to the Laravel route that returns the config values
    $.get("/api/config", function (data) {
        // Access the Google API key and use it in your JavaScript logic
        var googleApiKey = data.google_key;

        // Now you can use the googleApiKey in your JavaScript code
        // For example, you can use it in your Google Maps API calls
        // Here's a basic example:

        var address_map = new google.maps.Map(
            document.getElementById("address_map"),
            {
                center: { lat: -34.397, lng: 150.644 },
                zoom: 8,
            }
        );

    });
});

((g) => {
    var h,
        a,
        k,
        p = "The Google Maps JavaScript API",
        c = "google",
        l = "importLibrary",
        q = "__ib__",
        m = document,
        b = window;
    b = b[c] || (b[c] = {});
    var d = b.maps || (b.maps = {}),
        r = new Set(),
        e = new URLSearchParams(),
        u = () =>
            h ||
            (h = new Promise(async (f, n) => {
                await (a = m.createElement("script"));
                e.set("libraries", [...r] + "");
                for (k in g)
                    e.set(
                        k.replace(/[A-Z]/g, (t) => "_" + t[0].toLowerCase()),
                        g[k]
                    );
                e.set("callback", c + ".maps." + q);
                a.src = `https://maps.${c}apis.com/maps/api/js?` + e; // Removed the API key from here
                d[q] = f;
                a.onerror = () => (h = n(Error(p + " could not load.")));
                a.nonce = m.querySelector("script[nonce]")?.nonce || "";
                m.head.append(a);
            }));
    d[l]
        ? console.warn(p + " only loads once. Ignoring:", g)
        : (d[l] = (f, ...n) => r.add(f) && u().then(() => d[l](f, ...n)));
})({
    key: "AIzaSyC45M9bSvmoPH_wfAcwmxCAWCavsUURp3w",
    libraries: "places",
    v: "weekly",
});

var address_map;
var marker;
var searchBox;
var searchInput = document.getElementById("search-location");

async function initMap() {
    const { Map } = await google.maps.importLibrary("maps");

    address_map = new Map(document.getElementById("address_map"), {
        center: { lat: -34.397, lng: 150.644 },
        zoom: 8,
    });

    searchBox = new google.maps.places.SearchBox(searchInput);

    searchBox.addListener("places_changed", function () {
        var places = searchBox.getPlaces();
        if (places.length === 0) {
            return;
        }

        var bounds = new google.maps.LatLngBounds();
        places.forEach(function (place) {
            if (!place.geometry) {
                return;
            }

            if (place.geometry.viewport) {
                bounds.union(place.geometry.viewport);
            } else {
                bounds.extend(place.geometry.location);
            }

            // Clear previous marker if any
            if (marker) {
                marker.setMap(null);
            }

            // Add a new marker at the searched location
            marker = new google.maps.Marker({
                position: place.geometry.location,
                map: address_map, // Fix the property name here
                icon: {
                    url: "http://maps.google.com/mapfiles/ms/icons/red-dot.png",
                    scaledSize: new google.maps.Size(40, 40),
                },
                draggable: true, // Make the marker draggable
            });

            // Update the position input with the new marker position
            document.getElementById("latitude").value =
                place.geometry.location.lat();
            document.getElementById("longitude").value =
                place.geometry.location.lng();

            // Update position when marker is moved
            marker.addListener("dragend", function (event) {
                document.getElementById("latitude").value = event.latLng.lat();
                document.getElementById("longitude").value = event.latLng.lng();

                // Get the address of the new marker position and update search input
                var geocoder = new google.maps.Geocoder();
                geocoder.geocode(
                    { location: event.latLng },
                    function (results, status) {
                        if (status === "OK") {
                            if (results[0]) {
                                searchInput.value =
                                    results[0].formatted_address;
                            }
                        }
                    }
                );
            });
        });

        address_map.fitBounds(bounds);
    });
}


initMap();

function showMap() {
    var address_map = document.getElementById("address_map");
    address_map.style.display = "block";
}

function toggleLocationDiv() {
    var googleMapDiv = document.getElementById("google_map_address_selection");
    var dropdownDiv = document.getElementById("dropdown_address_selection");

    if (googleMapDiv.style.display === "none") {
        // Map view open
        googleMapDiv.style.display = "block";
        dropdownDiv.style.display = "none";
        console.log("inside googleMapDiv.style.display === none");

    } else {
        // drop down view open
        googleMapDiv.style.display = "none";
        dropdownDiv.style.display = "block";

        document.getElementById("latitude").value = 0;
        document.getElementById("longitude").value = 0;
    }
}