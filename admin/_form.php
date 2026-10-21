<?php /* expects $post (array), $action ('add'|'edit') */ ?>
<form action="save-post.php" method="POST" enctype="multipart/form-data" id="postForm">
<?= csrfField() ?>
<input type="hidden" name="action" value="<?= e($action) ?>">
<input type="hidden" name="id" value="<?= e($post['id'] ?? '') ?>">

<label>Title</label>
<input type="text" name="title" value="<?= e($post['title'] ?? '') ?>" required>

<label>Page URL (optional — leave blank to create from title)</label>
<div style="display:flex;align-items:center;gap:6px">
<span id="urlPrefix" style="white-space:nowrap;font-size:13px;color:#666">giceacademy.com/blog/</span>
<input type="text" name="slug" id="slug" value="<?= e($post['slug'] ?? '') ?>" placeholder="my-post-url" pattern="[A-Za-z0-9\- ]*" style="margin:6px 0 18px">
</div>

<label>Type</label>
<select name="type">
<option value="blog" <?= ($post['type'] ?? '') === 'blog' ? 'selected' : '' ?>>Blog</option>
<option value="current-affairs" <?= ($post['type'] ?? '') === 'current-affairs' ? 'selected' : '' ?>>Current Affairs</option>
<option value="notification" <?= ($post['type'] ?? '') === 'notification' ? 'selected' : '' ?>>Notification</option>
</select>

<label>Category</label>
<input type="text" name="category" value="<?= e($post['category'] ?? '') ?>" placeholder="Banking, SSC, UPSC, MBA etc.">

<label>Date</label>
<input type="date" name="date" value="<?= e($post['date'] ?? date('Y-m-d')) ?>" required>

<label>Featured image (upload JPG/PNG/WebP, max 3 MB)</label>
<?php if (!empty($post['image'])): ?>
<p><img src="../<?= e($post['image']) ?>" style="max-height:90px"><br><small>Current: <?= e($post['image']) ?> — upload a new file to replace it</small></p>
<?php endif; ?>
<input type="file" name="image_file" accept="image/jpeg,image/png,image/webp">
<input type="hidden" name="image" value="<?= e($post['image'] ?? '') ?>">

<label>Excerpt (short summary shown on the listing)</label>
<textarea name="excerpt" style="min-height:90px"><?= e($post['excerpt'] ?? '') ?></textarea>

<label>Content</label>
<textarea name="content" id="content" style="min-height:420px"><?= e($post['content'] ?? '') ?></textarea>

<label style="display:block;margin-top:18px">Status</label>
<select name="status">
<option value="published" <?= ($post['status'] ?? 'published') === 'published' ? 'selected' : '' ?>>Published</option>
<option value="draft" <?= ($post['status'] ?? '') === 'draft' ? 'selected' : '' ?>>Draft</option>
</select>

<button type="submit">Save</button>
</form>
<script>
var typeSel = document.querySelector('select[name=type]');
function setPrefix(){ document.getElementById('urlPrefix').textContent =
  'giceacademy.com/' + ({'current-affairs':'current-affairs','notification':'notification'}[typeSel.value] || 'blog') + '/'; }
typeSel.addEventListener('change', setPrefix); setPrefix();
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.3/tinymce.min.js" referrerpolicy="origin"></script>
<script>
tinymce.init({
  selector: '#content',
  height: 520,
  menubar: 'edit insert format table',
  plugins: 'table lists link image code autoresize',
  toolbar: 'blocks | bold italic underline | bullist numlist | link image blockquote | table | removeformat | code',
  block_formats: 'Paragraph=p; Heading 2=h2; Heading 3=h3',
  table_toolbar: 'tableprops tabledelete | tableinsertrowbefore tableinsertrowafter tabledeleterow | tableinsertcolbefore tableinsertcolafter tabledeletecol | tablecellprops',
  table_default_attributes: {},
  table_default_styles: { width: '100%' },
  table_appearance_options: false,
  relative_urls: false,
  remove_script_host: false,
  convert_urls: false,
  branding: false,
  promotion: false,
  content_style: 'body{font-family:Arial,sans-serif;font-size:16px;line-height:1.6} table{border-collapse:collapse} td,th{border:1px solid #bbb;padding:6px 10px}'
});
</script>
