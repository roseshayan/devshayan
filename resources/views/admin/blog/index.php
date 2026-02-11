<?php declare(strict_types=1); ?>
<div class="p-5 rounded-2xl border border-white/10 bg-white/5">
  <div class="flex items-center justify-between">
    <h2 class="text-lg font-semibold">Blog posts</h2>
    <a class="px-3 py-2 rounded-xl bg-white text-zinc-950 font-semibold" href="/admin/blog/create">New post</a>
  </div>
  <div class="mt-6 overflow-x-auto">
    <table class="w-full text-sm">
      <thead class="text-zinc-300"><tr class="border-b border-white/10"><th class="text-left py-2">ID</th><th class="text-left py-2">Title</th><th class="text-left py-2">Status</th><th class="text-left py-2">Published</th><th class="text-left py-2">Updated</th><th class="text-left py-2">Actions</th></tr></thead>
      <tbody>
        <?php foreach(($posts??[]) as $p): ?>
          <tr class="border-b border-white/5">
            <td class="py-2"><?= (int)$p['id'] ?></td>
            <td class="py-2">
              <div class="font-semibold"><?= e($p['title']) ?></div>
              <div class="text-xs text-zinc-400">/blog/<?= e($p['slug']) ?></div>
            </td>
            <td class="py-2"><?= e($p['status']) ?></td>
            <td class="py-2 text-zinc-300"><?= e((string)($p['published_at']??'')) ?></td>
            <td class="py-2 text-zinc-300"><?= e((string)($p['updated_at']??'')) ?></td>
            <td class="py-2">
              <div class="flex items-center gap-2">
                <a class="underline" href="/admin/blog/edit/<?= (int)$p['id'] ?>">Edit</a>
                <form method="post" action="/admin/blog/delete/<?= (int)$p['id'] ?>" onsubmit="return confirm('Delete this post?')">
                  <?= csrf_field() ?>
                  <button class="underline text-rose-300">Delete</button>
                </form>
              </div>
            </td>
          </tr>
        <?php endforeach; ?>
        <?php if(empty($posts)): ?><tr><td class="py-6 text-zinc-300" colspan="6">No posts.</td></tr><?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
