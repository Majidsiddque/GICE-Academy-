<?php
require_once '../config.php';
requireLogin();
$msg = $err = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    checkCsrf();
    $users = loadUsers();
    $new = $_POST['new'] ?? '';
    foreach ($users as &$u) {
        if ($u['username'] === currentUser()['username']) {
            if (!password_verify($_POST['current'] ?? '', $u['hash'])) $err = 'Current password is wrong.';
            elseif (strlen($new) < 10) $err = 'New password must be at least 10 characters.';
            else { $u['hash'] = password_hash($new, PASSWORD_DEFAULT); saveUsers($users); $msg = 'Password changed.'; }
        }
    }
}
?>
<!DOCTYPE html>
<html><head><title>My Password | GICE CMS</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="noindex">
<?php include '_style.php'; ?>
</head><body>
<?php include '_nav.php'; ?>
<div class="container"><div class="card" style="max-width:420px">
<h3>Change my password</h3>
<?php if ($msg): ?><div class="msg ok"><?= e($msg) ?></div><?php endif; ?>
<?php if ($err): ?><div class="msg err"><?= e($err) ?></div><?php endif; ?>
<form method="POST"><?= csrfField() ?>
<input type="password" name="current" placeholder="Current password" required>
<input type="password" name="new" placeholder="New password (min 10 chars)" required>
<button>Change</button></form>
</div></div></body></html>
