<?php
require_once("link.php");
include_once("header.php");
include("connection.php");

//include_once("leftpane.php");


?>

<style>
        .principal-frame {
            text-align: center;
            padding: 20px;
           
            margin-top:100px;
        }

        .principal-image {
            max-width: 100%;
            max-height: 200%; /* Adjust the maximum height as needed */
            border-radius: 0px;
        }
    </style>


<br><br><br>
    <!-- About Section -->
    <section id="about" class="about">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-xl-12">
                    <marquee><h3>Hi there! Welcome to our School's Website.</h3></marquee>
                    <!-- Existing content remains the same -->
                </div>
            </div>
                  </div>
    </section><!-- End About Section -->

    <section id="features" class="features">
    <div class="container">
    <div class="row no-gutters">
        <div class="col-xl-12">
            <div class="principal-frame">
                <h2>Principal Image</h2>
                <img src="images_517_copy_1.png" alt="Principal" class="principal-image">
            </div>
        </div>
    </div>
</div>
    </section>
<!-- ======= Features Section ======= -->
<section id="features" class="features" data-aos="fade-up">
    <div class="container">

        <div class="section-title">
            <h2>Features</h2>
            <p>Explore the unique features that set our school apart.</p>
        </div>

        <div class="row content">
            <div class="col-md-5" data-aos="fade-right" data-aos-delay="100">
            <img src="assets/img/classroom.jpg.jpg" class="img-fluid" alt="Classroom Image">            
            </div>
            <div class="col-md-7 pt-4" data-aos="fade-left" data-aos-delay="100">
                <h3>Modern Classrooms for Enhanced Learning</h3>
                <p class="fst-italic">
                    Our classrooms provide a conducive environment for effective learning experiences.
                </p>
                <ul>
                    <li><i class="bi bi-check"></i> Well-equipped classrooms for interactive learning.</li>
                    <li><i class="bi bi-check"></i> Dedicated and experienced faculty members.</li>
                    <li><i class="bi bi-check"></i> Engaging educational programs and activities.</li>
                </ul>
            </div>
        </div>

        <!-- Continue with similar content for other features -->
        <!-- You can replace the placeholder images and content with your school's actual information -->

    </div>
</section><!-- End Features Section -->

    <!-- Contact Section -->
    <section id="contact" class="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="info-box" data-aos="fade-up">
                        <i class="bx bx-map"></i>
                        <h3>Our Address</h3>
                        <p>Your School Address, City, Country</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="info-box" data-aos="fade-up" data-aos-delay="100">
                        <i class="bx bx-envelope"></i>
                        <h3>Email Us</h3>
                        <p>vishalthakurrana7890@gmail.com</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="info-box" data-aos="fade-up" data-aos-delay="200">
                        <i class="bx bx-phone-call"></i>
                        <h3>Call Us</h3>
                        <p>7018592095</p>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="info-box" data-aos="fade-up" data-aos-delay="300">
                        <i class="bx bx-time"></i>
                        <h3>Office Hours</h3>
                        <p>Mon - Fri: 9 AM to 5 PM</p>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End Contact Section -->

    <?php
    echo "<br><br><br>";
    include("footer.php");
    ?>
</main>


<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script>
    $(document).ready(function () {
        $('#example').DataTable();
    });
</script>
