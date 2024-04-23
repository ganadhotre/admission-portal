<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admission Portal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <link rel="stylesheet" href="styles.css">
    
</head>
<body>
    <header>
        <div class="top-bar">
            <span class="contact-info">
                <i class="fa fa-phone"></i> +91-8745-258789
                <i class="fa fa-envelope"></i> GD@education.com
                <span class="auth-links">
                    <a href="register.html">REGISTER</a> | <a href="login.html">LOGIN</a>
                </span>
                
            </span>
            <div class="social-media-icons">
                <a href="https://www.facebook.com" target="_blank"><i class="fab fa-facebook-f"></i></a>
                <a href="https://www.twitter.com" target="_blank"><i class="fab fa-twitter"></i></a>
                <a href="https://www.linkedin.com" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                <a href="https://www.pinterest.com" target="_blank"><i class="fab fa-pinterest-p"></i></a>
            </div>
            
        </div>
        <nav class="main-nav">
            <div class="logo">
                <img src="logo.png" alt="Education Logo">
                <span style="font-family: Georgia; font-size: 24px;">Admission portal</span>


            </div>
            <ul>
                <li><a href="#">HOME</a></li>
                <li><a href="#">COURSES</a></li>
                <li><a href="#">FEATURES</a></li>
                <li><a href="#">GALLERY</a></li>
                <li><a href="#">BLOG</a></li>
                <li><a href="contact.html">CONTACT</a></li>
            </ul>
            <div class="cta-button">
                <a href="#">Admission Open</a>
            </div>
        </nav>
    </header>
    <div class="search-container">
        <h2>Search Top College</h2>
        <form id="search-form" method="get" class="search-form" action="filter_colleges.php">
            <select id="country" name="country">
                <option value="">Select Country</option>
                <option value="India">India</option>
                <option value="USA">USA</option>
                <!-- Add more countries as needed -->
            </select>
            
            <select id="state" name="state">
                <option value="">Select State</option>
                <option value="Maharashtra">Maharashtra</option>
                <!-- Add more states as needed -->
            </select>
            
            <select id="city" name="city">
                <option value="">Select City</option>
                <option value="Mumbai">Mumbai</option>
                <option value="Pune">Pune</option>
                <!-- Add more cities in Maharashtra as needed -->
            </select>
            
            <select id="collegeType" name="collegeType">
                <option value="">Select College Type</option>
                <option value="medical">Medical College</option>
                <option value="engineering">Engineering College</option>
                <option value="pharmacy">Pharmacy College</option>
            </select>
            <div class="search-field">
                <input type="text" name="search" placeholder="Search for colleges..." class="search-input">
                <button type="submit" class="search-button"><i class="fa fa-search"></i></button>
            </div>
        </form>
    </div>
    
    <section class="hero-section">
        <div class="hero-content">
            <h1>More Than 25K+ Edu Courses Online</h1>
            <p>Choose from over 250,000 online video courses with new additions published every month, high quality courses.</p>
            <a href="#" class="hero-button">Read More</a>
        </div>
    </section>
    


    

    <section class="college-section">
    <h2 class="section-title">Top Colleges</h2>
    <div class="card-container">
        <!-- Cards will be dynamically inserted here -->
    </div>
    <button id="see-more-btn" onclick="seeMore()">See More</button>
</section>


   

    



<footer class="site-footer">
    <div class="footer-content">
        <p>&copy; 2024 Top Colleges. All rights reserved.</p>
        <!-- You can add additional footer content here such as links, contact information, social media icons, etc. -->
    </div>
</footer>


<script>
document.addEventListener("DOMContentLoaded", function() {
    loadColleges(0, 3); // Initially load 3 colleges
});

function loadColleges(start, count) {
    fetch(`load_colleges.php?start=${start}&count=${count}`)
    .then(response => response.json())
    .then(data => {
        const container = document.querySelector('.card-container');
        data.forEach(college => {
            const card = document.createElement('div');
            card.className = 'card';
            card.innerHTML = `<img src="${college.imgSrc}" alt="${college.name}"><h3>${college.name}</h3>`;
            container.appendChild(card);
        });
    });
}

function seeMore() {
    const allCards = document.querySelectorAll('.card').length;
    loadColleges(allCards, 3); // Load 3 more colleges each time
}
</script>


</body>
</html>
