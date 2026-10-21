<?php
require_once '../config.php';
requireLogin();
$post = []; $action = "add";
?>
<!DOCTYPE html>
<html><head><title>Add Post | GICE CMS</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="noindex">
<?php include '_style.php'; ?>
</head><body>
<?php include '_nav.php'; ?>
<div class="container"><div class="card">
<h2>Add Post</h2>
<?php include '_form.php'; ?>
</div></div></body></html>
