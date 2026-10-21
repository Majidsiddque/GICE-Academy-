<?php
require_once '../config.php';
requireLogin();
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: index.php'); exit; }
checkCsrf();

$posts   = loadPosts();
$action  = $_POST['action'] ?? 'add';
$title   = trim($_POST['title'] ?? '');
$type    = in_array($_POST['type'] ?? '', ['blog', 'current-affairs', 'notification'], true) ? $_POST['type'] : 'blog';
$status  = ($_POST['status'] ?? '') === 'published' ? 'published' : 'draft';
$date    = preg_match('/^\d{4}-\d{2}-\d{2}$/', $_POST['date'] ?? '') ? $_POST['date'] : date('Y-m-d');
$image   = trim($_POST['image'] ?? '');
$content = cleanHtml($_POST['content'] ?? '');

if ($title === '') { die('Title is required.'); }

// image upload
if (!empty($_FILES['image_file']['name']) && $_FILES['image_file']['error'] === UPLOAD_ERR_OK) {
    $f = $_FILES['image_file'];
    $mime = (new finfo(FILEINFO_MIME_TYPE))->file($f['tmp_name']);
    $ext = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/webp' => 'webp'][$mime] ?? null;
    if (!$ext || $f['size'] > 3 * 1024 * 1024) {
        die('Image must be JPG, PNG or WebP and under 3 MB.');
    }
    if (!is_dir(UPLOAD_DIR)) { mkdir(UPLOAD_DIR, 0755, true); }
    $name = date('Ymd-His') . '-' . bin2hex(random_bytes(4)) . '.' . $ext;
    if (move_uploaded_file($f['tmp_name'], UPLOAD_DIR . $name)) {
        $image = UPLOAD_URL . $name;
    }
}

$id = $action === 'edit' ? ($_POST['id'] ?? '') : '';
$slug = slugify($_POST['slug'] ?? '') ?: slugify($title);
$slug = uniqueSlug($slug, $posts, $id);

$fields = [
    'slug'     => $slug,
    'title'    => $title,
    'type'     => $type,
    'category' => trim($_POST['category'] ?? ''),
    'date'     => $date,
    'image'    => $image,
    'excerpt'  => trim($_POST['excerpt'] ?? ''),
    'content'  => $content,
    'status'   => $status,
];

if ($action === 'edit') {
    $id = $_POST['id'] ?? '';
    foreach ($posts as &$p) {
        if (($p['id'] ?? '') === $id) {
            $p = array_merge($p, $fields, ['updated_by' => currentUser()['username']]);
            break;
        }
    }
    unset($p);
} else {
    $posts[] = array_merge(['id' => uniqid()], $fields, ['author' => currentUser()['username']]);
}

savePosts($posts);
header('Location: index.php?msg=' . urlencode('Saved.'));
exit;
