<?php
require_once '../config.php';
requireLogin();
$id = $_GET["id"] ?? ""; $post = null;
foreach (loadPosts() as $item) { if (($item["id"] ?? "") === $id) { $post = $item; break; } }
if (!$post) { die("Post not found."); }
$action = "edit";
?>
<!DOCTYPE html>
<html><head><title>Edit Post | GICE CMS</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="noindex">
<?php include '_style.php'; ?>
</head><body>
<?php include '_nav.php'; ?>
<div class="container"><div class="card">
<h2>Edit Post</h2>
<?php include '_form.php'; ?>
</div></div></body></html>
