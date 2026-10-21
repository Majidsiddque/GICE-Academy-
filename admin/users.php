<?php
require_once '../config.php';
requireAdmin();
$users = loadUsers();
$msg = $err = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    checkCsrf();
    $do = $_POST['do'] ?? '';
    $username = trim($_POST['username'] ?? '');

    if ($do === 'add') {
        $password = $_POST['password'] ?? '';
        $role = ($_POST['role'] ?? '') === 'admin' ? 'admin' : 'editor';
        if (!preg_match('/^[A-Za-z0-9_.-]{3,30}$/', $username)) $err = 'Username: 3-30 letters/numbers.';
        elseif (strlen($password) < 10) $err = 'Password must be at least 10 characters.';
        elseif (array_filter($users, fn($u) => strcasecmp($u['username'], $username) === 0)) $err = 'Username already exists.';
        else {
            $users[] = ['username' => $username, 'hash' => password_hash($password, PASSWORD_DEFAULT), 'role' => $role];
            saveUsers($users); $msg = "User $username added.";
        }
    } elseif ($do === 'delete') {
        if ($username === currentUser()['username']) $err = "You can't delete yourself.";
        else {
            $users = array_values(array_filter($users, fn($u) => $u['username'] !== $username));
            saveUsers($users); $msg = "User $username removed.";
        }
    } elseif ($do === 'reset') {
        $password = $_POST['password'] ?? '';
        if (strlen($password) < 10) $err = 'Password must be at least 10 characters.';
        else {
            foreach ($users as &$u) if ($u['username'] === $username) $u['hash'] = password_hash($password, PASSWORD_DEFAULT);
            unset($u); saveUsers($users); $msg = "Password reset for $username.";
        }
    }
}
?>
<!DOCTYPE html>
<html><head><title>Users | GICE CMS</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="noindex">
<?php include '_style.php'; ?>
</head><body>
<?php include '_nav.php'; ?>
<div class="container">
<?php if ($msg): ?><div class="msg ok"><?= e($msg) ?></div><?php endif; ?>
<?php if ($err): ?><div class="msg err"><?= e($err) ?></div><?php endif; ?>

<div class="card" style="margin-bottom:24px">
<h3>Add user</h3>
<form method="POST"><?= csrfField() ?><input type="hidden" name="do" value="add">
<input name="username" placeholder="Username" required>
<input type="password" name="password" placeholder="Password (min 10 chars)" required>
<select name="role"><option value="editor">Editor (posts only)</option><option value="admin">Admin (posts + users)</option></select>
<button type="submit">Add user</button></form>
</div>

<table>
<tr><th>User</th><th>Role</th><th>Reset password</th><th></th></tr>
<?php foreach ($users as $u): ?>
<tr><td><?= e($u['username']) ?></td><td><?= e($u['role']) ?></td>
<td><form method="POST" style="display:flex;gap:6px"><?= csrfField() ?>
<input type="hidden" name="do" value="reset"><input type="hidden" name="username" value="<?= e($u['username']) ?>">
<input type="password" name="password" placeholder="New password" style="margin:0"><button>Set</button></form></td>
<td><?php if ($u['username'] !== currentUser()['username']): ?>
<form class="inline" method="POST" onsubmit="return confirm('Remove this user?')"><?= csrfField() ?>
<input type="hidden" name="do" value="delete"><input type="hidden" name="username" value="<?= e($u['username']) ?>">
<button>Remove</button></form><?php endif; ?></td></tr>
<?php endforeach; ?>
</table>
</div></body></html>
