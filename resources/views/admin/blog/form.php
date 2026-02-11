<?php declare(strict_types=1); $isEdit=!empty($post); ?>
<div class="p-5 rounded-2xl border border-white/10 bg-white/5">
  <div class="flex items-center justify-between">
    <h2 class="text-lg font-semibold"><?= $isEdit?'Edit post':'New post' ?></h2>
    <a class="text-sm underline text-zinc-300" href="/admin/blog">Back</a>
  </div>
  <form class="mt-6 space-y-4" method="post" enctype="multipart/form-data" action="<?= $isEdit?('/admin/blog/update/'.(int)$post['id']):'/admin/blog/store' ?>">
    <?= csrf_field() ?>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div class="md:col-span-2">
        <label class="text-sm text-zinc-300">Title</label>
        <input class="mt-2 w-full px-3 py-2 rounded-lg bg-zinc-900 border border-white/10" name="title" value="<?= e($post['title']??'') ?>" required>
      </div>
      <div class="md:col-span-2">
        <label class="text-sm text-zinc-300">Slug (optional)</label>
        <input class="mt-2 w-full px-3 py-2 rounded-lg bg-zinc-900 border border-white/10" name="slug" value="<?= e($post['slug']??'') ?>" placeholder="auto-from-title">
      </div>
      <div class="md:col-span-2">
        <label class="text-sm text-zinc-300">Excerpt</label>
        <textarea class="mt-2 w-full px-3 py-2 rounded-lg bg-zinc-900 border border-white/10 h-24" name="excerpt"><?= e($post['excerpt']??'') ?></textarea>
      </div>
      <div class="md:col-span-2">
        <label class="text-sm text-zinc-300">Content</label>
        <textarea class="mt-2 w-full px-3 py-2 rounded-lg bg-zinc-900 border border-white/10 h-64" name="content"><?= e($post['content']??'') ?></textarea>
      </div>
      <div>
        <label class="text-sm text-zinc-300">Status</label>
        <select class="mt-2 w-full px-3 py-2 rounded-lg bg-zinc-900 border border-white/10" name="status">
          <?php $st=(string)($post['status']??'draft'); ?>
          <option value="draft" <?= $st==='draft'?'selected':'' ?>>draft</option>
          <option value="published" <?= $st==='published'?'selected':'' ?>>published</option>
        </select>
      </div>
      <div>
        <label class="text-sm text-zinc-300">Published at (YYYY-MM-DD HH:MM:SS)</label>
        <input class="mt-2 w-full px-3 py-2 rounded-lg bg-zinc-900 border border-white/10" name="published_at" value="<?= e((string)($post['published_at']??'')) ?>">
      </div>
      <div class="md:col-span-2">
        <label class="text-sm text-zinc-300">Cover image</label>
        <input class="mt-2 w-full text-sm" type="file" name="cover" accept="image/png,image/jpeg,image/webp">
        <?php if(!empty($post['cover_path'])): ?><img class="mt-3 w-full max-w-md rounded-2xl border border-white/10 object-cover" src="<?= e((string)$post['cover_path']) ?>" alt="cover"><?php endif; ?>
      </div>
    </div>
    <button class="px-4 py-2 rounded-xl bg-white text-zinc-950 font-semibold">Save</button>
    <?php if($isEdit): ?><a class="ml-3 text-sm underline text-zinc-300" href="/blog/<?= e((string)$post['slug']) ?>" target="_blank" rel="noreferrer">View</a><?php endif; ?>
  </form>
</div>
