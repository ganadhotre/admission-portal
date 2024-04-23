let currentCardsDisplayed = 3;
let allColleges = [];

function createCard(imageSrc, collegeName) {
    // Ensure imageSrc includes the correct path
    const imagePath = imageSrc ? `http://localhost/admision/${imageSrc}` : 'path/to/default-placeholder-image.jpg';
    return `
        <div class="card">
            <img src="${imagePath}" alt="${collegeName}">
            <div class="card-content">
                <h3>${collegeName}</h3>
            </div>
        </div>
    `;
}

function displayInitialCards() {
    const cardContainer = document.querySelector('.card-container');
    cardContainer.innerHTML = ''; // Clear previous cards
    allColleges.slice(0, currentCardsDisplayed).forEach(college => {
        console.log(createCard(college.imageUrl, college.collegeName)); // Log the HTML being set
        cardContainer.innerHTML += createCard(college.imageUrl, college.collegeName);
    });
}


function seeMore() {
    currentCardsDisplayed = allColleges.length; // Show all cards
    displayInitialCards();
}

function fetchColleges() {
    fetch('get_colleges.php')
        .then(response => response.json()) // Converts the response to JSON
        .then(data => {
            console.log(data); // Check what the actual data is
            allColleges = data;
            displayInitialCards();
        })
        .catch(error => console.error('Error fetching colleges:', error));
}

document.addEventListener('DOMContentLoaded', fetchColleges);
