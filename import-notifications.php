<?php
/*
 * ONE-TIME: turns your 16 existing notification cards into real notifications
 * (each gets its own page and can be edited in the admin panel).
 * Existing posts are never touched; posts that already exist are skipped; a backup is made first.
 *
 * Use: log in to /admin/login, then open /import-notifications . It runs by itself.
 * Afterwards DELETE this file and data/notifications-import.json from the server.
 */
require_once __DIR__ . '/config.php';
requireAdmin();

$new = readJson(__DIR__ . '/data/notifications-import.json');
$live = loadPosts();
$have = [];
foreach ($live as $p) { $have[$p['slug'] ?? ''] = true; $have[strtolower($p['title'] ?? '')] = true; }
$toAdd = array_values(array_filter($new, function ($p) use ($have) {
    return empty($have[$p['slug']]) && empty($have[strtolower($p['title'])]);
}));
if ($toAdd) {
    copy(DATA_FILE, __DIR__ . '/data/posts.backup-' . date('Ymd-His') . '.json');
    savePosts(array_merge($live, $toAdd));
}
?>
<!doctype html>
<meta charset="utf-8">
<title>Import notifications</title>
<body style="font-family:Arial,sans-serif;max-width:640px;margin:60px auto;line-height:1.6">
<h2>Import notifications</h2>
<?php if (!$new): ?>
    <p style="color:red">data/notifications-import.json not found. Upload it into the data folder.</p>
<?php elseif (!$toAdd): ?>
    <p>Nothing to add - these notifications are already on the site. You can delete both import files.</p>
<?php else: ?>
    <p style="color:green"><b>Done.</b> <?= count($toAdd) ?> notifications added. Your other posts were not touched (a backup was saved in /data).</p>
    <p>Now delete <code>import-notifications.php</code> and <code>data/notifications-import.json</code> from the server.</p>
    <p><a href="notifications">View Notifications</a> &nbsp;|&nbsp; <a href="admin/">Open admin</a></p>
<?php endif; ?>
</body>
