<?php
session_start();
include("database.php");  // Database connection
?>
<?php
    include("header.php");
?>

<!-- Image Scrolling (Carousel) Section -->
<div class="carousel">
    <div class="carousel-track-container">
        <ul class="carousel-track">
            <li class="carousel-slide current-slide">
                <img src="Images/support1.png" alt="Support 1">
            </li>
            <li class="carousel-slide">
                <img src="Images/support2.png" alt="Support 2">
            </li>
            <li class="carousel-slide">
                <img src="Images/support3.png" alt="Support 3">
            </li>
        </ul>
    </div>
    <button class="carousel-button carousel-button-left">&#9664;</button>
    <button class="carousel-button carousel-button-right">&#9654;</button>
</div>

<script>
    const track = document.querySelector('.carousel-track');
    const slides = Array.from(track.children);
    const nextButton = document.querySelector('.carousel-button-right');
    const prevButton = document.querySelector('.carousel-button-left');
    const slideIntervalTime = 3000; // Time in milliseconds (3 seconds)

    const setSlidePosition = (slide, index) => {
        slide.style.left = `${index * 100}%`; // Position slides based on index
    };

    slides.forEach(setSlidePosition);

    const moveToSlide = (track, currentSlide, targetSlide) => {
        track.style.transform = 'translateX(-' + targetSlide.style.left + ')';
        currentSlide.classList.remove('current-slide');
        targetSlide.classList.add('current-slide');
    };

    const moveToNextSlide = () => {
        const currentSlide = track.querySelector('.current-slide');
        const nextSlide = currentSlide.nextElementSibling || slides[0]; // Loop to first slide
        moveToSlide(track, currentSlide, nextSlide);
    };

    nextButton.addEventListener('click', moveToNextSlide);
    
    prevButton.addEventListener('click', () => {
        const currentSlide = track.querySelector('.current-slide');
        const prevSlide = currentSlide.previousElementSibling || slides[slides.length - 1]; // Loop to last slide
        moveToSlide(track, currentSlide, prevSlide);
    });

    // Auto-slide functionality
    let autoSlide = setInterval(moveToNextSlide, slideIntervalTime);

    // Pause auto-slide on button hover
    nextButton.addEventListener('mouseover', () => clearInterval(autoSlide));
    prevButton.addEventListener('mouseover', () => clearInterval(autoSlide));
    
    // Resume auto-slide after mouse leaves buttons
    nextButton.addEventListener('mouseout', () => {
        autoSlide = setInterval(moveToNextSlide, slideIntervalTime);
    });
    prevButton.addEventListener('mouseout', () => {
        autoSlide = setInterval(moveToNextSlide, slideIntervalTime);
    });
</script>




<!--Support Services Section -->
<section class="services" id="services">
    <br>
    <h2>Support Services</h2>
    <div class="support-items">
        <div class="support-item1">
            <h3>Academic Support</h3>
            <p>Help with course materials, study resources, and academic counseling to enhance student performance.</p>
            <button class="academic_appointment" onclick="window.location.href='ap2_academic.php'">Book an Appointment</button>
            <button class="academic_appointment" onclick="window.location.href='ap2_display.php'">Your Appointments</button>
        </div>
        <div class="support-item2">
            <h3>Mental Health Support</h3>
            <p>Access to counselors and wellness programs to ensure students' mental well-being.</p>
            <button class="counseling_appointment" onclick="window.location.href='ap1_appointment.php'">Book an Appointment</button>
            <button class="counseling_appointment" onclick="window.location.href='ap1_display.php'">Your Appointments</button>
        </div>
        <div class="support-item3">
            <h3>Technical Support</h3>
            <p>Assistance with technical issues such as system login, software installation, and hardware troubleshooting.</p>
        </div>
    </div>
</section>

<!-- Information and Resources Section -->
<section class="resources" id="resources">
    <br>
    <h2>Information and Resources</h2>
    <div class="resource-items">
        <div class="resource-item1">
            <h3>Study Resources</h3>
            <p>Access to course materials, lecture notes, reading lists, tutoring services, academic workshops, and guides on study techniques and time management is available.</p>
        </div>
        <div class="resource-item2">
            <h3>Campus Life & Events</h3>
            <p>Information about campus life is available, including events, activities, student organizations, and updates on clubs and societies to enhance the university experience.</p>
        </div>
        <div class="resource-item3">
            <h3>Career Guidance</h3>
            <p>Career guidance services are available, including internship and job opportunities, resume writing assistance, interview preparation, and resources for networking and professional development.</p>
        </div>
    </div>
</section>

<!-- Facilities Section -->
<section class="facilities" id="facilities">
    <br>
    <h2>Facilities</h2>
    <div class="facility-item1">
        <h3>Parking</h3>
        <p>Parking spots are available for students and staff on campus with a valid permit.</p>
    </div>
    <div class="facility-item2">
        <h3>Library</h3>
        <p>Our library provides quiet study spaces and a range of academic materials for research and learning.</p>
    </div>
    <div class="facility-item3">
        <h3>Hostel Services</h3>
        <p>We offer secure and comfortable hostel services for students who require accommodation.</p>
    </div>
</section>


<section class="ticket" id="ticket">
    <br>
    <h2>Your tickets</h2>
    <p>Check your tickets' status</p>
    <button class="ticket_status" onclick="window.location.href='ticket_status.php'">Your Tickets</button>
</section>


<section class="feedback" id="feedback">
    <br>
    <h2>We Value Your Feedback</h2>
    <p>Let us know how we can improve our services and your experience. </p>
    <button class="feedback_btn" onclick="window.location.href='feedback_form.php'">Provide Your Feedback Here</button><br>
    <button class="feedback_btn" onclick="window.location.href='feedback_display.php'">Your Feedbacks</button>
</section>


<?php
    include("footer.php");
?>

<script>
    const track = document.querySelector('.carousel-track');
    const slides = Array.from(track.children);
    const nextButton = document.querySelector('.carousel-button-right');
    const prevButton = document.querySelector('.carousel-button-left');
    const slideWidth = slides[0].getBoundingClientRect().width;

   
    const setSlidePosition = (slide, index) => {
        slide.style.left = slideWidth * index + 'px';
    };
    slides.forEach(setSlidePosition);

    const moveToSlide = (track, currentSlide, targetSlide) => {
        track.style.transition = 'transform 0.5s ease-in'; 
        track.style.transform = 'translateX(-' + targetSlide.style.left + ')';
        currentSlide.classList.remove('current-slide');
        targetSlide.classList.add('current-slide');
    };

   
    nextButton.addEventListener('click', e => {
        const currentSlide = track.querySelector('.current-slide');
        const nextSlide = currentSlide.nextElementSibling || slides[0]; 
        moveToSlide(track, currentSlide, nextSlide);
    });

    
    prevButton.addEventListener('click', e => {
        const currentSlide = track.querySelector('.current-slide');
        const prevSlide = currentSlide.previousElementSibling || slides[slides.length - 1]; 
        moveToSlide(track, currentSlide, prevSlide);
    });


    let startX;
    let endX;

    track.addEventListener('touchstart', (e) => {
        startX = e.touches[0].clientX; 
    });

    track.addEventListener('touchmove', (e) => {
        endX = e.touches[0].clientX; 
    });

    track.addEventListener('touchend', () => {
        const distance = startX - endX; 
        if (distance > 50) {
            
            const currentSlide = track.querySelector('.current-slide');
            const nextSlide = currentSlide.nextElementSibling || slides[0]; 
            moveToSlide(track, currentSlide, nextSlide);
        } else if (distance < -50) {
           
            const currentSlide = track.querySelector('.current-slide');
            const prevSlide = currentSlide.previousElementSibling || slides[slides.length - 1];
            moveToSlide(track, currentSlide, prevSlide);
        }
    });
</script>
