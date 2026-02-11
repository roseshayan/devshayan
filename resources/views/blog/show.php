<?php declare(strict_types=1); ?>
<main class="max-w-3xl mx-auto px-4 py-10">
  <article class="reveal">
    <a class="text-sm text-zinc-600 dark:text-zinc-300 hover:opacity-80" href="/blog">← Back to Blog</a>
    <h1 class="mt-4 text-3xl md:text-4xl font-bold"><?= e((string)$post['title']) ?></h1>
    <div class="mt-3 text-xs text-zinc-500 dark:text-zinc-400"><?= e((string)($post['published_at']??'')) ?></div>
    <?php if(!empty($post['cover_path'])): ?>
      <img class="mt-6 w-full rounded-3xl border border-zinc-200/70 dark:border-white/10 object-cover" src="<?= e((string)$post['cover_path']) ?>" alt="cover">
    <?php endif; ?>
    <?php if(!empty($post['excerpt'])): ?>
      <p class="mt-6 text-zinc-600 dark:text-zinc-300 leading-8"><?= e((string)$post['excerpt']) ?></p>
    <?php endif; ?>
    <div class="mt-8 rounded-3xl border border-zinc-200/70 dark:border-white/10 bg-white/60 dark:bg-white/5 backdrop-blur p-6 text-zinc-700 dark:text-zinc-200 leading-8 whitespace-pre-wrap"><?= e((string)$post['content']) ?></div>
  </article>
</main>
