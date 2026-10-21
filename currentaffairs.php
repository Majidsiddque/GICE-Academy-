<?php
require_once 'config.php';

$posts = loadPosts();

$posts = array_filter($posts, function ($post) {
    return ($post['status'] ?? 'draft') === 'published'
        && ($post['type'] ?? '') === 'current-affairs';
});

usort($posts, function ($a, $b) {
    return strtotime($b['date'] ?? '') - strtotime($a['date'] ?? '');
});
?>

<!doctype html>
<html lang="en">

<head>

<meta charset="utf-8">

<title>Current Affairs | GICE Academy</title>

<meta name="description"
content="Read the latest educational articles, exam preparation strategies, career guidance and competitive examination updates from GICE Academy.">

<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="icon" href="logos/favicon.png">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Exo:wght@400;500;600;700;800&family=Open+Sans:wght@400;500;600&display=swap"
rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<link rel="stylesheet" href="css/style.css">

<style>

.blog-cms-area {
    padding: 80px 0;
}

.blog-cms-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 30px;
}

.blog-cms-card {
    background: #fff;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 5px 25px rgba(0,0,0,.08);
    height: 100%;
    display: flex;
    flex-direction: column;
}

.blog-cms-image {
    width: 100%;
    height: 220px;
    object-fit: cover;
}

.blog-cms-content {
    padding: 25px;
    flex: 1;
    display: flex;
    flex-direction: column;
}

.blog-cms-meta {
    font-size: 13px;
    margin-bottom: 10px;
    opacity: .7;
}

.blog-cms-title {
    margin-bottom: 12px;
}

.blog-cms-title a {
    text-decoration: none;
}

.blog-cms-excerpt {
    margin-bottom: 20px;
}

.blog-cms-read {
    margin-top: auto;
}

.blog-cms-empty {
    text-align: center;
    width: 100%;
    padding: 40px;
}

@media(max-width: 991px) {
    .blog-cms-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media(max-width: 575px) {
    .blog-cms-grid {
        grid-template-columns: 1fr;
    }
}

</style>

</head>

<body>

<?php include __DIR__ . '/header.php'; ?>


<!-- ====== Page Banner ====== -->

<section class="page-banner">

    <div class="container">

        <div class="section-title-2 text-center">

            <span class="sub-title">
                GICE Academy
            </span>

            <h1 class="title">
                Latest <span>Current Affairs</span>
            </h1>

            <span class="line"></span>

            <p>
                Daily and monthly current affairs for competitive exam preparation
            </p>

        </div>

    </div>

</section>


<!-- ====== Blog Start ====== -->

<section class="blog-cms-area">

    <div class="container">

        <?php if (empty($posts)): ?>

            <div class="blog-cms-empty">

                <h3>
                    No current affairs available.
                </h3>

                <p>
                    New articles will appear here once published.
                </p>

            </div>

        <?php else: ?>

            <div class="blog-cms-grid">

                <?php foreach ($posts as $post): ?>

                    <article class="blog-cms-card">

                        <?php if (!empty($post['image'])): ?>

                            <img
                                class="blog-cms-image"
                                src="<?= e($post['image']) ?>"
                                alt="<?= e($post['title']) ?>">

                        <?php endif; ?>


                        <div class="blog-cms-content">

                            <div class="blog-cms-meta">

                                <i class="far fa-calendar"></i>

                                <?= e($post['date']) ?>

                                <?php if (!empty($post['category'])): ?>

                                    &nbsp; | &nbsp;

                                    <?= e($post['category']) ?>

                                <?php endif; ?>

                            </div>


                            <h3 class="blog-cms-title">

                                <a href="<?= e(postUrl($post)) ?>">

                                    <?= e($post['title']) ?>

                                </a>

                            </h3>


                            <p class="blog-cms-excerpt">

                                <?= e($post['excerpt'] ?? '') ?>

                            </p>


                            <div class="blog-cms-read">

                                <a class="main-btn"
                                   href="<?= e(postUrl($post)) ?>">

                                    Read More
                                    <i class="fas fa-arrow-right"></i>

                                </a>

                            </div>

                        </div>

                    </article>

                <?php endforeach; ?>

            </div>

        <?php endif; ?>

    </div>

</section>

<!-- ====== Blog End ====== -->


<!-- ====== Footer Start ====== -->

<footer class="footer-area">

    <div class="footer-overlay"></div>

    <div class="footer-locations">

        <div class="container">

            <div class="location-footer-grid">

                <div class="location-col">

                    <h4 class="location-title">
                        Our Courses in Nerul
                    </h4>

                    <ul class="location-link-list">

                        <li>
                            <i class="fas fa-angle-right"></i>
                            <a href="upsc-coaching-navi-mumbai">
                                UPSC Coaching Classes in Navi Mumbai
                            </a>
                        </li>

                        <li>
                            <i class="fas fa-angle-right"></i>
                            <a href="mba-cet-coaching-navi-mumbai">
                                MBA Coaching Classes in Navi Mumbai
                            </a>
                        </li>

                        <li>
                            <i class="fas fa-angle-right"></i>
                            <a href="imu-cet-coaching-navi-mumbai">
                                IMU CET Coaching Classes in Navi Mumbai
                            </a>
                        </li>

                        <li>
                            <i class="fas fa-angle-right"></i>
                            <a href="clat-coaching-navi-mumbai">
                                CLAT Coaching Classes in Navi Mumbai
                            </a>
                        </li>

                    </ul>

                </div>


                <div class="location-col">

                    <h4 class="location-title">
                        Quick Links
                    </h4>

                    <ul class="location-link-list">

                        <li>
                            <i class="fas fa-angle-right"></i>
                            <a href="/">Home</a>
                        </li>

                        <li>
                            <i class="fas fa-angle-right"></i>
                            <a href="courses">Courses</a>
                        </li>

                        <li>
                            <i class="fas fa-angle-right"></i>
                            <a href="toppers">Our Toppers</a>
                        </li>

                        <li>
                            <i class="fas fa-angle-right"></i>
                            <a href="notifications">Notifications</a>
                        </li>

                        <li>
                            <i class="fas fa-angle-right"></i>
                            <a href="currentaffairs">
                                Current Affairs
                            </a>
                        </li>

                        <li>
                            <i class="fas fa-angle-right"></i>
                            <a href="blog">
                                Blog
                            </a>
                        </li>

                        <li>
                            <i class="fas fa-angle-right"></i>
                            <a href="contact">
                                Contact Us
                            </a>
                        </li>

                    </ul>

                </div>


                <div class="location-col">

                    <h4 class="location-title">
                        Contact Info
                    </h4>

                    <ul class="link-list contact-list">

                        <li>
                            <i class="fas fa-map-marker-alt"></i>

                            <span>
                                Office Number 305, Arya Ariana,
                                Opp. Canara Bank, Dombivli,
                                Ramnagar, Dombivli East,
                                Kalyan, Maharashtra 421201
                            </span>

                        </li>

                        <li>

                            <i class="fas fa-phone"></i>

                            <a href="tel:+918879085440">
                                +91 8879085440
                            </a>

                        </li>

                        <li>

                            <i class="fas fa-envelope"></i>

                            <a href="mailto:giceacademy@gmail.com">
                                giceacademy@gmail.com
                            </a>

                        </li>

                    </ul>

                </div>

            </div>

        </div>

    </div>


    <div class="footer-copyright">

        <div class="container">

            <div class="copyright">

                <p class="copyText">

                    © 2026 GICE Academy. All Rights Reserved.

                    Designed by

                    <a href="https://deepshitech.com/">
                        DeepshiTech Private Limited
                    </a>

                </p>

            </div>

        </div>

    </div>

</footer>

<!-- ====== Footer End ====== -->


<a href="#"
   class="back-to-top"
   id="backToTop">

    <i class="fas fa-chevron-up"></i>

</a>


<script src="js/main.js"></script>

</body>
</html>