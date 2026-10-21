<?php
require_once '../config.php';

if (currentUser()) { header('Location: index.php'); exit; }

$users = loadUsers();
$setup = empty($users);   // first run: create the first admin
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    checkCsrf();
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($setup) {
        if (!preg_match('/^[A-Za-z0-9_.-]{3,30}$/', $username) || strlen($password) < 10) {
            $error = 'Username: 3-30 letters/numbers. Password: at least 10 characters.';
        } else {
            saveUsers([[
                'username' => $username,
                'hash'     => password_hash($password, PASSWORD_DEFAULT),
                'role'     => 'admin',
            ]]);
            session_regenerate_id(true);
            $_SESSION['gice_user'] = ['username' => $username, 'role' => 'admin'];
            header('Location: index.php'); exit;
        }
    } else {
        foreach ($users as $u) {
            if (hash_equals($u['username'], $username) && password_verify($password, $u['hash'])) {
                session_regenerate_id(true);
                $_SESSION['gice_user'] = ['username' => $u['username'], 'role' => $u['role']];
                header('Location: index.php'); exit;
            }
        }
        sleep(1);
        $error = 'Invalid username or password.';
    }
}
?>
<!DOCTYPE html>
<html><head><title>GICE Admin Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="noindex">
<?php include '_style.php'; ?>
</head><body>
<div class="card" style="width:360px;max-width:90%;margin:90px auto">
<h2><?= $setup ? 'Create first admin' : 'GICE Academy Admin' ?></h2>
<?php if ($error): ?><div class="msg err"><?= e($error) ?></div><?php endif; ?>
<form method="POST">
<?= csrfField() ?>
<input type="text" name="username" placeholder="Username" required autofocus>
<input type="password" name="password" placeholder="Password" required>
<button type="submit" style="width:100%"><?= $setup ? 'Create admin &amp; log in' : 'Login' ?></button>
</form>
</div></body></html>
