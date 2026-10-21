<?php
require_once '../config.php';
requireLogin();
$posts = loadPosts();
usort($posts, fn($a, $b) => strcmp($b['date'] ?? '', $a['date'] ?? ''));
$msg = $_GET['msg'] ?? '';
?>
<!DOCTYPE html>
<html><head><title>GICE Admin Dashboard</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="noindex">
<?php include '_style.php'; ?>
</head><body>
<?php include '_nav.php'; ?>
<div class="container">
<?php if ($msg): ?><div class="msg ok"><?= e($msg) ?></div><?php endif; ?>
<p><a class="btn" href="add-post.php">Add New Post</a></p>
<table>
<tr><th>Title</th><th>Type</th><th>Date</th><th>Status</th><th>Action</th></tr>
<?php foreach ($posts as $p): ?>
<tr>
<td><?= e($p['title']) ?></td>
<td><?= e($p['type']) ?></td>
<td><?= e($p['date']) ?></td>
<td><?= e($p['status']) ?></td>
<td>
<a href="edit-post.php?id=<?= urlencode($p['id']) ?>">Edit</a> &nbsp;|&nbsp;
<?php if (($p['status'] ?? '') === 'published'): ?>
<a href="<?= e(postUrl($p)) ?>" target="_blank">View</a> &nbsp;|&nbsp;
<?php endif; ?>
<form class="inline" method="POST" action="delete-post.php" onsubmit="return confirm('Delete this post?')">
<?= csrfField() ?><input type="hidden" name="id" value="<?= e($p['id']) ?>">
<button type="submit">Delete</button></form>
</td>
</tr>
<?php endforeach; ?>
<?php if (!$posts): ?><tr><td colspan="5">No posts yet.</td></tr><?php endif; ?>
</table>
</div></body></html>
