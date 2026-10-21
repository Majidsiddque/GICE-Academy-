<?php
require_once '../config.php';
requireLogin();
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: index.php'); exit; }
checkCsrf();
$id = $_POST['id'] ?? '';
$posts = array_filter(loadPosts(), fn($p) => ($p['id'] ?? '') !== $id);
savePosts($posts);
header('Location: index.php?msg=' . urlencode('Post deleted.'));
exit;
