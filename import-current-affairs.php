<?php
/*
 * ONE-TIME IMPORT of the 90 old WordPress current-affairs posts.
 * Adds them to your LIVE data/posts.json (nothing is overwritten, existing posts are kept,
 * posts whose slug already exists are skipped, and a backup is made first).
 *
 * How to use:  log in at /admin/login, then open /import-current-affairs
 *              -> check the numbers -> click "Import now".
 * Afterwards DELETE this file and data/current-affairs-import.json from the server.
 */
require_once __DIR__ . '/config.php';
requireAdmin();

$src = __DIR__ . '/data/current-affairs-import.json';
$new = readJson($src);
$live = loadPosts();
$have = [];
foreach ($live as $p) { $have[$p['slug'] ?? ''] = true; }
$toAdd = array_values(array_filter($new, function ($p) use ($have) { return empty($have[$p['slug']]); }));

$done = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $toAdd) {
    checkCsrf();
    $backup = __DIR__ . '/data/posts.backup-' . date('Ymd-His') . '.json';
    copy(DATA_FILE, $backup);
    savePosts(array_merge($live, $toAdd));
    $done = true;
}
?>
<!doctype html>
<meta charset="utf-8">
<title>Import current affairs</title>
<body style="font-family:Arial,sans-serif;max-width:640px;margin:60px auto;line-height:1.6">
<h2>Import current affairs</h2>
<?php if ($done): ?>
    <p style="color:green"><b>Done.</b> <?= count($toAdd) ?> posts added. Existing posts untouched; backup saved in /data.</p>
    <p>Now delete <code>import-current-affairs.php</code> and <code>data/current-affairs-import.json</code> from the server.</p>
    <p><a href="currentaffairs">View Current Affairs</a></p>
<?php elseif (!$new): ?>
    <p style="color:red">data/current-affairs-import.json not found. Upload it into the data folder.</p>
<?php elseif (!$toAdd): ?>
    <p>Everything in the import file already exists on the site. Nothing to add. You can delete both files.</p>
<?php else: ?>
    <p>Live posts now: <b><?= count($live) ?></b><br>
       In import file: <b><?= count($new) ?></b><br>
       Will be added: <b><?= count($toAdd) ?></b></p>
    <form method="post">
        <?= function_exists('csrfField') ? csrfField() : '' ?>
        <button style="padding:10px 22px;font-size:16px">Import now</button>
    </form>
<?php endif; ?>
</body>
