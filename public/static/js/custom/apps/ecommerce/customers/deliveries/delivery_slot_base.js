// Define the number of cities to display per page
const citiesPerPage = 10;
// Initialize the current page variable
let currentPage = 0;
const cities = document.querySelectorAll(".accordion");
// Function to show cities for the current page
function showCitiesForPage(page) {
    const cities = document.querySelectorAll(".accordion");
    cities.forEach((city, index) => {
        if (
            index >= page * citiesPerPage &&
            index < (page + 1) * citiesPerPage
        ) {
            city.style.display = "block";
        } else {
            city.style.display = "none";
        }
    });
}
// Initially, show cities for the first page
showCitiesForPage(currentPage);
// Event listener for "Next" button
document.getElementById("nextPage").addEventListener("click", () => {
    if (currentPage < Math.ceil(cities.length / citiesPerPage) - 1) {
        currentPage++;
        showCitiesForPage(currentPage);
    }
});

// Event listener for "Previous" button
document.getElementById("prevPage").addEventListener("click", () => {
    if (currentPage > 0) {
        currentPage--;
        showCitiesForPage(currentPage);
    }
});

$(document).ready(function () {
    // Get the input element
    var input = document.getElementById("myInput");
    // Add an event listener for input changes
    input.addEventListener("input", function () {
        var query = input.value.toLowerCase(); // Get the search query
        filterCities(query); // Call the filtering function
    });
    // Function to filter cities based on the query
    function filterCities(query) {
        // Get all accordion items (cities)
        var accordions = document.getElementsByClassName("accordion");
        // Loop through the accordion items
        for (var i = 0; i < accordions.length; i++) {
            var accordion = accordions[i];
            var cityName = accordion
                .getAttribute("id")
                .replace("accordion_", ""); // Extract city name from accordion id
            // Check if the city name matches the query
            if (cityName.toLowerCase().includes(query)) {
                accordion.style.display = ""; // Show the accordion
            } else {
                accordion.style.display = "none"; // Hide the accordion
            }
        }
    }
});
document.addEventListener("DOMContentLoaded", function () {
    const accordionHeaders = document.querySelectorAll(".accordion-header");
    accordionHeaders.forEach((header) => {
        header.addEventListener("click", function () {
            // Toggle the opened class when the button is clicked
            header.classList.toggle("accordion-opened");
        });
    });
});
