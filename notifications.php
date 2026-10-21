<?php
require_once __DIR__ . '/config.php';
$legacyNotifs = [
    ['href'=>'/notifications','img'=>'/images/notifications/rbi-grade-b.png','tag'=>'RBI','title'=>'RBI Grade B 2026 Official Notification OUT'],
    ['href'=>'/notifications','img'=>'/images/notifications/sbi-sco.jpg','tag'=>'SBI','title'=>'SBI SCO Recruitment 2026 Out – Apply Online for 12 Specialist Cadre Officer Posts'],
    ['href'=>'/notifications','img'=>'/images/notifications/rbi-assistant.jpg','tag'=>'RBI','title'=>'RBI Assistant Notification 2026 – Apply Online for 650 Vacancies'],
    ['href'=>'/notifications','img'=>'/images/notifications/rrb-ntpc-ug.jpg','tag'=>'Railway','title'=>'RRB NTPC 10+2 (Undergraduate) Recruitment 2026 — 3050 Posts'],
    ['href'=>'/notifications','img'=>'/images/notifications/rrb-ntpc-grad.jpg','tag'=>'Railway','title'=>'RRB NTPC Graduate Recruitment 2026 — Notification Out'],
    ['href'=>'/notifications','img'=>'/images/notifications/rrb-group-d.jpg','tag'=>'Railway','title'=>'RRB Group D Recruitment 2026 — 22,195 Level-1 Posts'],
    ['href'=>'/notifications','img'=>'/images/notifications/rrb-group-d-2.jpg','tag'=>'Railway','title'=>'RRB Group D Eligibility, Salary & Exam Pattern 2026'],
    ['href'=>'/notifications','img'=>'/images/notifications/rrb-je-date.jpg','tag'=>'Railway','title'=>'RRB JE Exam Date 2026 Announced — Complete CBT Schedule'],
    ['href'=>'/notifications','img'=>'/images/notifications/pnb-office-assistant.jpg','tag'=>'Banking','title'=>'PNB Bank Haryana Office Assistant Vacancy 2026 — Apply Offline Now'],
    ['href'=>'/notifications','img'=>'/images/notifications/ibps-rrb.jpg','tag'=>'Banking','title'=>'IBPS RRB 2026 Notification — Apply for Officer & Office Assistant Posts'],
    ['href'=>'/notifications','img'=>'/images/notifications/ssc-calendar.jpg','tag'=>'SSC','title'=>'SSC Exam Calendar 2026-27 Released — Check Dates & Pattern'],
    ['href'=>'/notifications','img'=>'/images/notifications/cds-1.jpg','tag'=>'Defence','title'=>'CDS 1 Notification 2026 Out: Exam Date, Eligibility & Vacancies'],
    ['href'=>'/notifications','img'=>'/images/notifications/nda-1.jpg','tag'=>'Defence','title'=>'NDA 1 Notification 2026 Out — 394 Vacancies, Apply Now'],
    ['href'=>'/notifications','img'=>'/images/notifications/mh-cet-law.jpg','tag'=>'Law','title'=>'MH CET Law 2026 Registration: Dates, Eligibility & Updates'],
    ['href'=>'/notifications','img'=>'/images/notifications/clat-2026.png','tag'=>'Law','title'=>'CLAT 2026 Exam Date, Application Form, Pattern & Preparation'],
    ['href'=>'/notifications','img'=>'/images/notifications/cat-2025.jpg','tag'=>'MBA','title'=>'CAT 2026 Notification — Registration, Exam Date & Pattern'],
];
$notifs = [];
foreach (latestNotifications() as $p) { $notifs[] = notifFromPost($p); }
foreach ($notifs ? [] : $legacyNotifs as $n) {
    $n['href'] = '#'; $n['img'] = e($n['img']); $n['href'] = e($n['href']);
    $notifs[] = $n;
}
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Exam Notifications | GICE Academy</title>
<meta name="description" content="Latest government exam notifications — RBI, SBI, IBPS, SSC, Railway, NDA, CDS, CLAT and more.">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" href="logos/favicon.png">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Exo:wght@400;500;600;700;800&family=Open+Sans:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="css/style.css">
</head>
<body>
    
    <!-- ====== Header Start ====== -->
<header class="header-area">
    <div class="header-top">
        <div class="container">
            <div class="header-top-wrapper">
                <div class="header-top-left">
                    <ul class="header-meta">
                        <li><i class="fas fa-envelope"></i><a href="mailto:giceacademy@gmail.com">giceacademy@gmail.com</a></li>
                        <li><i class="fas fa-phone"></i><a href="tel:+918879085440">+91 8879085440</a></li>
                    </ul>
                </div>

                <div class="header-top-right">
                    <div class="header-social">
                        <a href="https://www.facebook.com/share/1DgyEaHiro/"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://www.linkedin.com/company/gice-academy/"><i class="fab fa-linkedin"></i></a>
                        <a href="https://www.youtube.com/@giceacademy493"><i class="fab fa-youtube"></i></a>
                        <a href="https://www.instagram.com/giceacademy?stkn=MWNubWpmc3lvNXExdg%3D%3D"><i class="fab fa-instagram"></i></a>
                        <a href="https://t.me/+vC4GH7hnIsw2YmU1" target="_blank" rel="noopener"><i class="fab fa-telegram"></i></a>
                    </div>

                    <div class="header-link">
                        <a class="pay-fees" href="https://razorpay.me/@giceacademy" target="_blank" rel="noopener">Pay Fees</a>
                        <a class="enquire" href="application">Application Form</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="navigation" class="navigation">
        <div class="container">
            <div class="nav-row">

                <div class="header-logo">
                    <a href="/">
                        <img src="logos/gice-logo.png" alt="GICE Academy Logo" height="70">
                    </a>
                </div>

                <div class="nav-toggle" id="navToggle">
                    <span></span><span></span><span></span>
                </div>

                <nav class="nav-menus-wrapper" id="navMenu">
                    <ul class="nav-menu">

                        <li><a class="active" href="/">Home</a></li>

                        <li>
                            <a href="#">Govt Exam <i class="fas fa-chevron-down"></i></a>
                            <ul class="nav-dropdown">
                                <li>
                                    <a href="banking">Banking <i class="fas fa-chevron-down"></i></a>
                                </li>
                                <ul class="nav-menu">
                                    <li><a href="rbi-exam">RBI</a></li>
                                    <li><a href="sbi">SBI</a></li>
                                    <li><a href="ibpsexams">IBPS Exams</a></li>
                                    <li><a href="ibps-rrb">IBPS-RRB</a></li>
                                </ul>

                                <li>
                                    <a href="ssc">Staff Selection Commission <i class="fas fa-chevron-down"></i></a>
                                </li>
                                <ul class="nav-menu">
                                    <li><a href="ssc-cgl">CGL</a></li>
                                    <li><a href="ssc-chsl">CHSL</a></li>
                                    <li><a href="ssc-gd">SSC-GD</a></li>
                                    <li><a href="ssc-mts-coaching">MTS</a></li>
                                </ul>

                                <li><a href="railway-exam-coaching">Railway Exam</a></li>
                                <li><a href="insurance-exam-coaching">Insurance Exam</a></li>
                                <li><a href="mpsc-coaching">MPSC</a></li>
                                <li><a href="upsc-coaching">UPSC</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="#">MBA <i class="fas fa-chevron-down"></i></a>
                            <ul class="nav-dropdown">
                                <li><a href="cat-coaching">CAT</a></li>
                                <li><a href="mba-cet-coaching">MBA CET</a></li>
                                <li><a href="nmat-snap-gmat">NMAT / SNAP / GMAT</a></li>
                                <li><a href="xat-ibsat-cmat">XAT / CMAT / IBSAT</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="#">Defence <i class="fas fa-chevron-down"></i></a>
                            <ul class="nav-dropdown">
                                <li><a href="nda-coaching">NDA</a></li>
                                <li><a href="cds-coaching">CDS</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="#">Entrance <i class="fas fa-chevron-down"></i></a>
                            <ul class="nav-dropdown">
                                <li><a href="clat-coaching">CLAT</a></li>
                                <li><a href="mca-entrance-coaching">MCA</a></li>
                                <li><a href="imu-cet-coaching">IMU CET</a></li>
                                <li><a href="law-cet-coaching">LAW CET</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="#">Knowledge Hub <i class="fas fa-chevron-down"></i></a>
                            <ul class="nav-dropdown">
                                <li><a href="currentaffairs">Current Affairs</a></li>
                                <li><a href="blog">Blog</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="#">Signup <i class="fas fa-chevron-down"></i></a>
                            <ul class="nav-dropdown">
                                <li><a href="https://testseries.giceacademy.com/?_gl=1*1cg34b0*_ga*MTM5NTQzMTQxNS4xNzc1ODkyOTI3*_ga_6CR35BDB01*czE3OTIzOTU4MTckbzkkZzEkdDE3OTIzOTU5MjAkajYwJGwwJGgw*_ga_PYWH2CYJCR*czE3OTIzOTU4MTgkbzkkZzEkdDE3OTIzOTU5MjAkajYwJGwwJGgw*_gcl_au*NTYwMDA2NjQ2LjE3ODgxNzk5NjI" target="_blank" rel="noopener">Test Portal</a></li>
                                <li><a href="application">Enroll Now</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="contact" class="nav-enquire-btn">Enquire Now</a>
                        </li>

                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>
<!-- ====== Header End ====== -->
    
    <section class="page-banner">
  <div class="container">
    <h1>Exam Notifications</h1>
    <div class="breadcrumbs"><a href="/">Home</a> &nbsp;/&nbsp; Notifications</div>
  </div>
</section><section class="notifications-area">
  <div class="container">
    <div class="row-header text-center"><div class="section-title-2">
      <span class="sub-title">Latest</span>
      <h2 class="title">Exam <span>Notifications</span></h2><span class="line"></span>
      <p>Stay updated with the latest government job notifications, recruitment announcements and exam calendars.</p>
    </div></div>
    <div class="notifications-grid"><?php foreach ($notifs as $n) echo notifCardHtml($n); ?></div>
  </div>
</section>
<!-- ====== Newsletter Start ====== -->
<section class="newsletter-area">
    <div class="container">

        <div class="newsletter-wrapper" style="background-image: url('images/newsletter-bg.jpg');">
            <div class="newsletter-overlay"></div>

            <div class="newsletter-row">

                <div class="newsletter-left">
                    <div class="section-title-2">
                        <h2 class="title">Start Your Success Journey Today</h2>
                        <span class="line"></span>
                        <p>Enquire now and get expert counselling for the right course.<br> Our team is here to guide you.</p>
                    </div>
                </div>

                <div class="newsletter-right">
                    <div class="section-title-2">
                        <span class="line"></span>
                        <p>Start your journey with us.<br> Your path to success in every exam</p>
                        <a href="contact" class="main-btn main-btn-2">Enquire Now</a>
                    </div>
                </div>

            </div>
        </div>

    </div>
</section>
<!-- ====== Newsletter End ====== -->


<!-- ========================================================= -->
<!-- ====== NEW LOCATION FOOTER START ====== -->
<!-- ========================================================= -->

<footer class="footer-area">

    <div class="footer-overlay"></div>

    <!-- ====== Location Links Row Start ====== -->
    <div class="footer-locations">

        <div class="container">

            <div class="location-footer-grid">

                <!-- ===== COLUMN 1 ===== -->
                <div class="location-col">

                    <h4 class="location-title">Our Courses in Nerul</h4>

                    <ul class="location-link-list">
                        <li><i class="fas fa-angle-right"></i><a href="upsc-coaching-navi-mumbai">UPSC Coaching Classes in Navi Mumbai</a></li>
                        <li><i class="fas fa-angle-right"></i><a href="mba-cet-coaching-navi-mumbai">MBA Coaching Classes in Navi Mumbai</a></li>
                        <li><i class="fas fa-angle-right"></i><a href="imu-cet-coaching-navi-mumbai">IMU CET Coaching Classes in Navi Mumbai</a></li>
                        <li><i class="fas fa-angle-right"></i><a href="clat-coaching-navi-mumbai">CLAT Coaching Classes in Navi Mumbai</a></li>
                        <li><i class="fas fa-angle-right"></i><a href="cds-coaching-navi-mumbai">CDS Coaching Classes in Navi Mumbai</a></li>
                        <li><i class="fas fa-angle-right"></i><a href="banking-coaching-navi-mumbai">Banking Coaching Classes in Navi Mumbai</a></li>
                    </ul>

                    <h4 class="location-title">Our Courses in Ulhasnagar</h4>

                    <ul class="location-link-list">
                        <li><i class="fas fa-angle-right"></i><a href="cat-coaching-ulhasnagar">CAT Coaching Classes in Ulhasnagar</a></li>
                        <li><i class="fas fa-angle-right"></i><a href="imu-cet-coaching-ulhasnagar">IMU CET in classes Ulhasnagar</a></li>
                        <li><i class="fas fa-angle-right"></i><a href="law-cet-coaching-ulhasnagar">LAW CET Coaching Classes in Ulhasnagar</a></li>
                    </ul>

                    <h4 class="location-title">Our Courses in Badlapur</h4>

                    <ul class="location-link-list">
                        <li><i class="fas fa-angle-right"></i><a href="cat-coaching-badlapur">CAT Coaching Classes in Badlapur</a></li>
                        <li><i class="fas fa-angle-right"></i><a href="imu-cet-coaching-badlapur">IMU CET in classes Badlapur</a></li>
                        <li><i class="fas fa-angle-right"></i><a href="law-cet-coaching-badlapur">LAW CET Coaching Classes in Badlapur</a></li>
                    </ul>

                </div>


                <!-- ===== COLUMN 2 ===== -->
                <div class="location-col">

                    <h4 class="location-title">Our Courses in Thane</h4>

                    <ul class="location-link-list">
                        <li><i class="fas fa-angle-right"></i><a href="upsc-coaching-thane">UPSC Coaching Classes in Thane</a></li>
                        <li><i class="fas fa-angle-right"></i><a href="mpsc-coaching-thane">MPSC Coaching Classes in Thane</a></li>
                        <li><i class="fas fa-angle-right"></i><a href="mba-cet-coaching-thane">MBA Coaching Classes in Thane</a></li>
                        <li><i class="fas fa-angle-right"></i><a href="ssc-cgl-coaching">SSC Coaching Classes in Thane</a></li>
                        <li><i class="fas fa-angle-right"></i><a href="clat-coaching-thane">CLAT Coaching Classes in Thane</a></li>
                        <li><i class="fas fa-angle-right"></i><a href="nda-coaching-thane">NDA Coaching Classes in Thane</a></li>
                        <li><i class="fas fa-angle-right"></i><a href="mca-coaching-thane">MCA Coaching Classes in Thane</a></li>
                        <li><i class="fas fa-angle-right"></i><a href="cds-coaching-thane">CDS Coaching Classes in Thane</a></li>
                        <li><i class="fas fa-angle-right"></i><a href="banking-coaching-thane">Banking Coaching Classes in Thane</a></li>
                        <li><i class="fas fa-angle-right"></i><a href="imu-cet-coaching-thane">IMU CET Coaching Classes in Thane</a></li>
                    </ul>

                    <h4 class="location-title">Our Courses in Kalyan</h4>

                    <ul class="location-link-list">
                        <li><i class="fas fa-angle-right"></i><a href="cat-coaching-kalyan">CAT Coaching Classes in Kalyan</a></li>
                        <li><i class="fas fa-angle-right"></i><a href="imu-cet-coaching-kalyan">IMU CET in classes Kalyan</a></li>
                        <li><i class="fas fa-angle-right"></i><a href="law-cet-coaching-kalyan">LAW CET Coaching Classes in Kalyan</a></li>
                    </ul>

                    <h4 class="location-title">Our Courses in Ambernath</h4>

                    <ul class="location-link-list">
                        <li><i class="fas fa-angle-right"></i><a href="cat-coaching-ambernath">CAT Coaching Classes in Ambernath</a></li>
                        <li><i class="fas fa-angle-right"></i><a href="imu-cet-coaching-ambernath">IMU CET in classes Ambernath</a></li>
                        <li><i class="fas fa-angle-right"></i><a href="law-cet-coaching-ambernath">LAW CET Coaching Classes in Ambernath</a></li>
                    </ul>

                </div>


                <!-- ===== COLUMN 3 ===== -->
                <div class="location-col">

                    <h4 class="location-title">Our Courses In Dombivali</h4>

                    <ul class="location-link-list">
                        <li><i class="fas fa-angle-right"></i><a href="upsc-coaching-dombivli">UPSC Coaching Classes in Dombivali</a></li>
                        <li><i class="fas fa-angle-right"></i><a href="mpsc-coaching-dombivli">MPSC Coaching Classes in Dombivali</a></li>
                        <li><i class="fas fa-angle-right"></i><a href="ssc-chsl-coaching">SSC Coaching Classes in Dombivali</a></li>
                        <li><i class="fas fa-angle-right"></i><a href="cat-coaching-dombivli">CAT Coaching Classes in Dombivali</a></li>
                        <li><i class="fas fa-angle-right"></i><a href="nmat-coaching-dombivli">NMAT Coaching Classes in Dombivali</a></li>
                        <li><i class="fas fa-angle-right"></i><a href="snap-coaching-dombivli">SNAP Coaching Classes Dombivali</a></li>
                        <li><i class="fas fa-angle-right"></i><a href="mba-cet-coaching-dombivli">MBA CET Coaching Classes in Dombivali</a></li>
                        <li><i class="fas fa-angle-right"></i><a href="gmat-coaching-dombivli">GMAT Coaching Classes in Dombivali</a></li>
                        <li><i class="fas fa-angle-right"></i><a href="xat-coaching-dombivli">XAT Coaching Classes in Dombivali</a></li>
                        <li><i class="fas fa-angle-right"></i><a href="cmat-coaching-dombivli">CMAT Coaching Classes in Dombivali</a></li>
                        <li><i class="fas fa-angle-right"></i><a href="ibsat-preparation">IBSAT Coaching Classes in Dombivali</a></li>
                        <li><i class="fas fa-angle-right"></i><a href="rrb-coaching-dombivli">Railway Exam Coaching classes in Dombivali</a></li>
                        <li><i class="fas fa-angle-right"></i><a href="insurance-coaching-dombivli">Insurance Exam Coaching in Dombivali</a></li>
                        <li><i class="fas fa-angle-right"></i><a href="nda-coaching-dombivli">NDA Coaching Classes in Dombivali</a></li>
                        <li><i class="fas fa-angle-right"></i><a href="cds-coaching-dombivli">CDS Coaching Classes in Dombivali</a></li>
                        <li><i class="fas fa-angle-right"></i><a href="clat-coaching-dombivli">CLAT Coaching Classes in Dombivali</a></li>
                        <li><i class="fas fa-angle-right"></i><a href="mca-coaching-dombivli">MCA Coaching Classes in Dombivali</a></li>
                        <li><i class="fas fa-angle-right"></i><a href="imu-cet-coaching-dombivali">IMU CET Coaching Classes in Dombivali</a></li>
                        <li><i class="fas fa-angle-right"></i><a href="law-cet-coaching-dombivli">LAW CET Coaching Classes Dombivali</a></li>
                    </ul>

                </div>


                <!-- ===== COLUMN 4 ===== -->
                <div class="location-col location-address-col">

                    <div class="location-address-block">
                        <p>Railway Station Complex, F-111, above Union Bank of India, Nerul East, Nerul West, Nerul, Navi Mumbai, Maharashtra 400706</p>
                        <p>Mobile No: <a href="tel:+919920172327">+91 9920172327</a></p>
                        <p><a href="mailto:giceacademy@gmail.com">giceacademy@gmail.com</a></p>
                    </div>
                    
                    <div class="location-address-block">
                        <p>office No 101 , first floor, front of rathore hospital, Motibai tower, opposite Badlapur Railway Station, west, Mumbai, Maharashtra 421503</p>
                        <p>Mobile No: <a href="tel:+917021183032">+91 7021183032</a></p>
                        <p><a href="mailto:giceacademy@gmail.com">giceacademy@gmail.com</a></p>
                    </div>
                    <div class="location-address-block">
                        <p>A, Krishna plaza cop.hsc, railway station, 208, Shivaji Path, above Krishna sweets, Naik Wadi, Naupada, Thane – 400601</p>
                        <p>Mobile No: <a href="tel:+917400244518">+91 7400244518</a></p>
                        <p><a href="mailto:giceacademy@gmail.com">giceacademy@gmail.com</a></p>
                    </div>

                    <div class="location-address-block">
                        <p>Office Number 305, arya ariana, opp. Canara Bank, Dombivli, Ramnagar, Dombivli East, Kalyan, Maharashtra 421201</p>
                        <p>Mobile No: <a href="tel:+918879085440">+91 8879085440</a></p>
                        <p><a href="mailto:giceacademy@gmail.com">giceacademy@gmail.com</a></p>
                    </div>

                </div>

            </div>
        </div>

    </div>
    <!-- ====== Location Links Row End ====== -->


    <!-- ====== Main Footer Widget Start ====== -->
    <div class="footer-widget">

        <div class="container">

            <div class="footer-grid">

                <!-- About -->
                <div class="footer-col footer-about">

                    <div class="footer-logo">
                        <img src="logos/gice-logo-white.png" alt="GICE Academy" height="65">
                    </div>

                    <p>
                        Guidance Institute for Competitive Exams — your trusted partner for MBA CAT, MBA CET, CLAT, UPSC, SSC, MBA, Banking, NDA, IMU-CET & more in Dombivli, Thane, Badlapur, Nerul.
                    </p>

                    <div class="header-social">
                        <a href="https://www.facebook.com/share/1DgyEaHiro/"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://www.linkedin.com/company/gice-academy/"><i class="fab fa-linkedin"></i></a>
                        <a href="https://www.youtube.com/@giceacademy493"><i class="fab fa-youtube"></i></a>
                        <a href="https://www.instagram.com/giceacademy?stkn=MWNubWpmc3lvNXExdg%3D%3D"><i class="fab fa-instagram"></i></a>
                        <a href="https://t.me/+vC4GH7hnIsw2YmU1" target="_blank" rel="noopener"><i class="fab fa-telegram"></i></a>
                    </div>

                </div>


                <!-- Our Courses -->
                <div class="footer-col">

                    <div class="footer-link">

                        <h4 class="footer-title">Our Courses</h4>

                        <ul class="link-list">
                            <li><a href="upsc-coaching">UPSC Coaching</a></li>
                            <li><a href="mpsc-coaching">MPSC Coaching</a></li>
                            <li><a href="banking">Banking Coaching</a></li>
                            <li><a href="ssc-cgl">SSC Coaching</a></li>
                            <li><a href="nda-coaching">NDA Coaching</a></li>
                            <li><a href="courses">All Courses</a></li>
                        </ul>

                    </div>

                </div>


                <!-- Useful Links -->
                <div class="footer-col">

                    <div class="footer-link">

                        <h4 class="footer-title">Useful Links</h4>

                        <ul class="link-list">
                            <li><a href="about">About Us</a></li>
                            <li><a href="teachers">Our Teachers</a></li>
                            <li><a href="toppers">Our Toppers</a></li>
                            <li><a href="notifications">Notifications</a></li>
                            <li><a href="news">Knowledge Hub</a></li>
                            <li><a href="contact">Contact Us</a></li>
                            <li><a href="https://razorpay.me/@giceacademy" target="_blank" rel="noopener">Pay Fees Online</a></li>
                        </ul>

                    </div>

                </div>


                <!-- Contact Info -->
                <div class="footer-col">

                    <div class="footer-link">

                        <h4 class="footer-title">Contact Info</h4>

                        <ul class="link-list contact-list">

                            <li>
                                <i class="fas fa-map-marker-alt"></i>
                                <span>Office Number 305, arya ariana, opp. Canara Bank, Dombivli, Ramnagar, Dombivli East, Kalyan, Maharashtra 421201</span>
                            </li>

                            <li>
                                <i class="fas fa-phone"></i>
                                <a href="tel:+918879085440">+91 8879085440</a>
                            </li>

                            <li>
                                <i class="fas fa-envelope"></i>
                                <a href="mailto:giceacademy@gmail.com">giceacademy@gmail.com</a>
                            </li>

                            <li>
                                <i class="fas fa-globe"></i>
                                <a href="#">www.giceacademy.com</a>
                            </li>

                        </ul>

                    </div>

                </div>

            </div>

        </div>

    </div>
    <!-- ====== Main Footer Widget End ====== -->


    <!-- ====== Copyright Start ====== -->
    <div class="footer-copyright">

        <div class="container">

            <div class="copyright">

                <div style="display:flex; gap:10px;">

                    <p class="copyText">
                        © 2026 GICE Academy. All Rights Reserved.
                        Designed by
                        <a href="https://deepshitech.com/">DeepshiTech Private Limited</a>
                    </p>

                </div>

            </div>

        </div>

    </div>
    <!-- ====== Copyright End ====== -->

</footer>

<!-- ========================================================= -->
<!-- ====== NEW LOCATION FOOTER END ====== -->
<!-- ========================================================= -->


<a href="#" class="back-to-top" id="backToTop">
    <i class="fas fa-chevron-up"></i>
</a>

<script src="js/main.js"></script>

</body>
</html>