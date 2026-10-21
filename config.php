<?php

define('SITE_NAME', 'GICE Academy');
define('DATA_FILE', __DIR__ . '/data/posts.json');
define('USERS_FILE', __DIR__ . '/data/users.json');
define('UPLOAD_DIR', __DIR__ . '/images/blog/');
define('UPLOAD_URL', 'images/blog/');

if (session_status() === PHP_SESSION_NONE) {
    session_set_cookie_params([
        'httponly' => true,
        'samesite' => 'Lax',
        'secure'   => !empty($_SERVER['HTTPS']),
    ]);
    session_start();
}

function readJson($file)
{
    if (!file_exists($file)) {
        return [];
    }
    $data = json_decode(file_get_contents($file), true);
    return is_array($data) ? $data : [];
}

function writeJson($file, $data)
{
    if (!is_dir(dirname($file))) {
        mkdir(dirname($file), 0755, true);
    }
    file_put_contents(
        $file,
        json_encode(array_values($data), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
        LOCK_EX
    );
}

function loadPosts()  { return readJson(DATA_FILE); }
function savePosts($posts) { writeJson(DATA_FILE, $posts); }
function loadUsers()  { return readJson(USERS_FILE); }
function saveUsers($u) { writeJson(USERS_FILE, $u); }

function e($value)
{
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

/* ---------- auth ---------- */

function currentUser()
{
    return $_SESSION['gice_user'] ?? null; // ['username'=>..., 'role'=>...]
}

function requireLogin()
{
    if (!currentUser()) {
        header('Location: login');
        exit;
    }
}

function requireAdmin()
{
    requireLogin();
    if (currentUser()['role'] !== 'admin') {
        http_response_code(403);
        die('Admins only.');
    }
}

/* ---------- CSRF ---------- */

function csrfToken()
{
    if (empty($_SESSION['csrf'])) {
        $_SESSION['csrf'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf'];
}

function csrfField()
{
    return '<input type="hidden" name="csrf" value="' . e(csrfToken()) . '">';
}

function checkCsrf()
{
    $ok = isset($_POST['csrf']) && hash_equals($_SESSION['csrf'] ?? '', $_POST['csrf']);
    if (!$ok) {
        http_response_code(400);
        die('Invalid request. Go back, refresh and try again.');
    }
}

/* ---------- content safety ---------- */

// Editors are trusted to write HTML, but strip scripts and inline event handlers.
function cleanHtml($html)
{
    $html = preg_replace('#<script\b[^>]*>.*?</script>#is', '', $html);
    $html = preg_replace('#\son\w+\s*=\s*("[^"]*"|\'[^\']*\'|[^\s>]+)#i', '', $html);
    $html = preg_replace('#(href|src)\s*=\s*(["\'])\s*javascript:[^"\']*\2#i', '$1=$2#$2', $html);
    return $html;
}


/* ---------- URLs / slugs ---------- */

function slugify($text)
{
    $text = strtolower(trim($text));
    $text = preg_replace('/[^a-z0-9]+/', '-', $text);
    return trim($text, '-');
}

function uniqueSlug($slug, $posts, $ignoreId = '')
{
    $base = $slug = $slug !== '' ? $slug : 'post';
    $n = 2;
    $taken = function ($s) use ($posts, $ignoreId) {
        foreach ($posts as $p) {
            if (($p['slug'] ?? '') === $s && ($p['id'] ?? '') !== $ignoreId) return true;
        }
        return false;
    };
    while ($taken($slug)) { $slug = $base . '-' . $n++; }
    return $slug;
}

function postUrl($post)
{
    if (empty($post['slug'])) {
        return '/post?id=' . urlencode($post['id']);
    }
    $t = $post['type'] ?? '';
    $prefix = $t === 'current-affairs' ? 'current-affairs' : ($t === 'notification' ? 'notification' : 'blog');
    return '/' . $prefix . '/' . $post['slug'];
}


/* ---------- Notifications (home page + /notifications) ---------- */

// Newest published notifications first (newest date, and for the same date the most recently added).
function latestNotifications($limit = 0)
{
    $list = [];
    foreach (loadPosts() as $i => $p) {
        if (($p['type'] ?? '') === 'notification' && ($p['status'] ?? 'draft') === 'published') {
            $list[] = [$i, $p];
        }
    }
    usort($list, function ($a, $b) {
        $d = strtotime($b[1]['date'] ?? '') - strtotime($a[1]['date'] ?? '');
        return $d !== 0 ? $d : $b[0] - $a[0];
    });
    $list = array_map(function ($x) { return $x[1]; }, $list);
    return $limit > 0 ? array_slice($list, 0, $limit) : $list;
}

// $n = ['href'=>, 'img'=>, 'tag'=>, 'title'=>]; values must already be HTML-safe.
function notifCardHtml($n)
{
    $h = '<a href="' . $n['href'] . '" class="notification-card">';
    if (!empty($n['img'])) {
        $h .= '<div class="notif-img"><img src="' . $n['img'] . '" alt="" loading="lazy"></div>';
    }
    $h .= '<div class="notif-body">';
    if (!empty($n['tag'])) $h .= '<span class="notif-tag">' . $n['tag'] . '</span>';
    return $h . '<h5>' . $n['title'] . '</h5></div></a>';
}

// Turns a stored post into card data (escaped).
function notifFromPost($p)
{
    $img = '';
    if (!empty($p['image'])) {
        $img = preg_match('#^https?://#i', $p['image']) ? $p['image'] : '/' . ltrim($p['image'], '/');
    }
    return ['href' => e(postUrl($p)), 'img' => e($img), 'tag' => e($p['category'] ?? ''), 'title' => e($p['title'])];
}

