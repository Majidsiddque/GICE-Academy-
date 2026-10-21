<div class="header">
  <h2>GICE Academy CMS</h2>
  <div>
    <a href="index.php">Posts</a>
    <a href="add-post.php">New Post</a>
    <?php if (currentUser()['role'] === 'admin'): ?><a href="users.php">Users</a><?php endif; ?>
    <a href="account.php">My Password</a>
    <a href="logout.php">Logout (<?= e(currentUser()['username']) ?>)</a>
  </div>
</div>
