<?php declare(strict_types=1); ?>
<main class="max-w-6xl mx-auto px-4 py-10">
  <div class="reveal">
    <h1 class="text-3xl md:text-4xl font-bold">Blog</h1>
    <p class="mt-3 text-zinc-600 dark:text-zinc-300">Writing about PHP, WordPress, front-end, and building products.</p>
  </div>
  <div class="mt-10 grid grid-cols-1 md:grid-cols-2 gap-6">
    <?php foreach(($posts??[]) as $p): ?>
      <a class="reveal group rounded-3xl border border-zinc-200/70 dark:border-white/10 bg-white/60 dark:bg-white/5 backdrop-blur overflow-hidden hover:bg-white dark:hover:bg-white/10 transition" href="/blog/<?= e($p['slug']) ?>">
        <?php if(!empty($p['cover_path'])): ?>
          <img src="<?= e((string)$p['cover_path']) ?>" alt="cover" class="w-full h-44 object-cover">
        <?php endif; ?>
        <div class="p-6">
          <div class="text-xs text-zinc-500 dark:text-zinc-400"><?= e((string)($p['published_at']??'')) ?></div>
          <div class="mt-2 font-semibold text-lg"><?= e((string)$p['title']) ?></div>
          <div class="mt-3 text-sm text-zinc-600 dark:text-zinc-300 leading-7"><?= e((string)$p['excerpt']) ?></div>
          <div class="mt-4 text-xs text-zinc-500 dark:text-zinc-400 group-hover:text-zinc-900 dark:group-hover:text-white transition">Read →</div>
        </div>
      </a>
    <?php endforeach; ?>
    <?php if(empty($posts)): ?>
      <div class="reveal rounded-3xl border border-zinc-200/70 dark:border-white/10 bg-white/60 dark:bg-white/5 backdrop-blur p-6 text-zinc-600 dark:text-zinc-300">No posts yet.</div>
    <?php endif; ?>
  </div>
</main>
