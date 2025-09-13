<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Health Navigation Management System</title>
  <link rel="stylesheet" href="../assets/css/landingpage.css">
</head>
<body>

  <!-- Header -->
  <?php include "../view/header.php";?>

  <!-- Hero Section -->
  <section class="hero scroll-reveal">
    <h2>Welcome to Health Navigation System (HNMS)</h2>
    <p>
      Our Health Navigation Management System (HNMS) offers an all-in-one solution for managing your healthcare needs effortlessly. From booking doctor appointments, ordering medicines online, and scheduling diagnostic tests, to tracking your health report, HNMS ensures you stay informed and in control of your health.
    </p>
    <button>Get Started</button>
  </section>

  <!-- Features Section -->
  <section class="features scroll-reveal">
  <button class="card" data-target="#section1">Doctor Booking</button>
  <button class="card" data-target="#section2">Comprehensive Health Services</button>
  <button class="card" data-target="#section3">Buy Medicine</button>
  <button class="card" data-target="#section4">Diagnostic Services</button>
  <button class="card" data-target="#section5">Blood Donation</button>
  <button class="card" data-target="#section6">Ambulance Services</button>
</section>


  <!-- Section 1: Doctors -->
  <section class="section scroll-reveal" id="section1">
    <div class="container">
      <div class="image">
        <img src="https://embed.widencdn.net/img/csdam/s2pfkdj7ub/668x568px/Photo_IRU_Wheelchair_Patient_EsfahaniRezaMD_072.jpg" alt="Doctor Image">
      </div>
      <div class="content">
        <h2>Our Experienced Doctors</h2>
        <p>
          Our team of certified doctors are highly experienced in providing top-notch healthcare services.
          You can search and book your preferred doctor with ease. We ensure personalized care and timely support 
          for every patient.
        </p>
        <button>Find Doctor</button>
      </div>
    </div>
  </section>

  <!-- Section 2: Health Services -->
  <section class="section scroll-reveal" id="section2">
    <div class="container">
      <div class="content">
        <h2>Comprehensive Health Services</h2>
        <p>
          We provide a wide range of health services to keep you and your family healthy. From routine check-ups to specialized treatments, our platform ensures you get timely, reliable, and professional care whenever you need it.
        </p>
        <button>Explore Services</button>
      </div>
            <div class="image">
        <img src="https://shombhob.com/images/prescription.png" alt="Health Services Image">
      </div>
    </div>
  </section>

  <!-- Section 3: Medicines -->
  <section class="section scroll-reveal" id="section3">
    <div class="container">
      <div class="image">
        <img src="https://png.pngtree.com/png-clipart/20240619/original/pngtree-drug-capsule-pill-from-prescription-in-drugstore-pharmacy-for-treatment-health-png-image_15366552.png" alt="Medicines Image">
      </div>
      <div class="content">
        <h2>Our Medicine Services</h2>
        <p>
          Access a wide range of medicines from certified pharmacies online. Order your prescribed medicines easily and have them delivered quickly to your doorstep, ensuring your health needs are met without hassle.
        </p>
        <button>Explore Medicines</button>
      </div>
    </div>
  </section>

  <!-- Section 4: Diagnostics -->
  <section class="section scroll-reveal" id="section4">
    <div class="container">
      <div class="content">
        <h2>Diagnostic Services</h2>
        <p>
          Schedule lab tests and diagnostic services with ease. Get accurate results on time and keep track of your health through our online portal, making monitoring and managing your health simpler than ever.
        </p>
        <button>Book Diagnostic</button>
      </div>
      <div class="image">
        <img src="https://static.wixstatic.com/media/f02d5f_9807dc1cc512469aa0f733271d6c49ca~mv2.jpeg/v1/fill/w_640,h_424,al_c,q_80,usm_0.66_1.00_0.01,enc_avif,quality_auto/f02d5f_9807dc1cc512469aa0f733271d6c49ca~mv2.jpeg" alt="Diagnostic Image">
      </div>
    </div>
  </section>

  <!-- Section 5: Blood Donation -->
  <section class="section scroll-reveal" id="section5">
    <div class="container">
      <div class="image">
        <img src="https://static.vecteezy.com/system/resources/previews/008/190/897/non_2x/human-blood-donate-on-white-background-free-vector.jpg" alt="Blood Donation Image">
      </div>
      <div class="content">
        <h2>Blood Donation</h2>
        <p>
          Join our blood donation program and save lives. Find donation centers nearby and contribute to the community by giving blood regularly. Your donation can make a real difference.
        </p>
        <button>Donate Blood</button>
      </div>
    </div>
  </section>

  <!-- Section 6: Ambulance -->
  <section class="section scroll-reveal" id="sectin6">
    <div class="container">
      <div class="content">
        <h2>Ambulance Services</h2>
        <p>
          Reliable and fast ambulance services available 24/7. Reach medical facilities safely and quickly in case of emergencies, ensuring prompt care when every second counts.
        </p>
        <button>Call Ambulance</button>
      </div>
      <div class="image">
        <img src="https://www.ambulance.nsw.gov.au/__data/assets/image/0006/552264/Calling-an-Ambulance.jpg" alt="Ambulance Image">
      </div>
    </div>
  </section>


  <section class="testimonials" id="testimonials">
            <div class="container">
                <h2>What Our Clients Say</h2>
                <div class="testimonials-grid">
                    <div class="testimonial">
                        <p>"Booking doctor appointments has never been this easy. The personalized recommendations really help me choose the right doctor."</p>
                        <h4>- Miyoko M., Software Engineer</h4>
                    </div>
                    <div class="testimonial">
                        <p>"I love how I can order medicines online and track my health reports in one place. It saves so much time!"</p>
                        <h4>- Salman F., Student</h4>
                    </div>
                    <div class="testimonial">
                        <p>"The ambulance service and blood donation program are fantastic. This platform truly cares about patients' well-being."</p>
                        <h4>- Sizan S., Student</h4>
                    </div>
                    <div class="testimonial">
                        <p>"The diagnostic services are quick and reliable. I always get my test results on time and can monitor my health easily."</p>
                        <h4>- Raihan A., Teacher</h4>
                    </div>
                </div>
            </div>
        </section>


  <!-- Footer -->
  <?php include "../view/footer.php";?>

  <script src="../assets/js/landingpage.js"></script>
</body>
</html>

