<?php

require_once 'config.php';

$id = $_GET['id'] ?? '';
$slug = $_GET['slug'] ?? '';

$posts = loadPosts();

$post = null;

foreach ($posts as $item) {

    $match = $slug !== ''
        ? ($item['slug'] ?? '') === $slug
        : ($id !== '' && ($item['id'] ?? '') === $id);

    if ($match && ($item['status'] ?? '') === 'published') {

        $post = $item;
        break;

    }

}

if (!$post) {

    http_response_code(404);

    die('Post not found.');

}

?>

<!doctype html>

<html lang="en">

<head>

<meta charset="utf-8">
<base href="/">

<title><?= e($post['title']) ?> | GICE Academy</title>

<meta name="description"
content="<?= e($post['excerpt'] ?? $post['title']) ?>">

<meta name="viewport"
content="width=device-width, initial-scale=1">

<link rel="icon"
href="logos/favicon.png">

<link rel="preconnect"
href="https://fonts.googleapis.com">

<link rel="preconnect"
href="https://fonts.gstatic.com"
crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Exo:wght@400;500;600;700;800&family=Open+Sans:wght@400;500;600&display=swap"
rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<link rel="stylesheet"
href="css/style.css">

<style>

.article-area {
    padding:80px 0;
}

.article-wrapper {
    max-width:900px;
    margin:0 auto;
}

.article-featured-image {
    width:100%;
    max-height:500px;
    object-fit:cover;
    border-radius:8px;
    margin-bottom:30px;
}

.article-meta {
    font-size:14px;
    margin-bottom:20px;
    opacity:.7;
}

.article-content {
    font-size:17px;
    line-height:1.8;
}

.article-content h2 {
    margin-top:35px;
}

.article-content h3 {
    margin-top:25px;
}

.article-content table {
    width:100%;
    border-collapse:collapse;
    margin:25px 0;
    font-size:16px;
    line-height:1.5;
}

.article-content table th,
.article-content table td {
    border:1px solid #d5dbe3;
    padding:10px 14px;
    text-align:left;
    vertical-align:top;
}

.article-content table th,
.article-content table tr:first-child td strong {
    color:#07294d;
}

.article-content table thead th,
.article-content table tr:first-child th {
    background:#07294d;
    color:#fff;
}

.article-content table tbody tr:nth-child(even) {
    background:#f4f7fb;
}

.article-content figure {
    margin:0;
    overflow-x:auto;
}

@media (max-width:768px) {
    .article-content table {
        display:block;
        overflow-x:auto;
        -webkit-overflow-scrolling:touch;
    }
}

.article-content img {
    max-width:100%;
    height:auto;
}

.article-content ul,
.article-content ol {
    padding-left:25px;
}

</style>

</head>

<body>

<?php include __DIR__ . '/header.php'; ?>


<!-- ====== Article ====== -->

<section class="page-banner">

    <div class="container">

        <div class="section-title-2 text-center">

            <span class="sub-title">
                GICE Academy
            </span>

            <h1 class="title">
                <?= e($post['title']) ?>
            </h1>

        </div>

    </div>

</section>


<section class="article-area">

    <div class="container">

        <article class="article-wrapper">

            <?php if (!empty($post['image'])): ?>

                <img
                    class="article-featured-image"
                    src="<?= e($post['image']) ?>"
                    alt="<?= e($post['title']) ?>">

            <?php endif; ?>


            <div class="article-meta">

                <i class="far fa-calendar"></i>

                <?= e($post['date']) ?>

                <?php if (!empty($post['category'])): ?>

                    &nbsp; | &nbsp;

                    <?= e($post['category']) ?>

                <?php endif; ?>

            </div>


            <div class="article-content">

                <?= $post['content'] ?>

            </div>

        </article>

    </div>

</section>


<!-- Use the same footer as your GICE pages here -->

<footer class="footer-area">

    <div class="footer-overlay"></div>

    <div class="container">

        <div class="footer-copyright">

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


<a href="#"
   class="back-to-top"
   id="backToTop">

    <i class="fas fa-chevron-up"></i>

</a>

<script src="js/main.js"></script>

</body>

</html>