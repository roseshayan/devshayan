<?php declare(strict_types=1); use App\Core\Auth; ?>
<!doctype html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title><?= e($title??'Admin') ?></title>
  <link rel="stylesheet" href="/assets/app.css">
</head>
<body class="min-h-screen bg-zinc-950 text-zinc-50">
  <header class="border-b border-white/10">
    <div class="max-w-6xl mx-auto px-4 py-4 flex items-center justify-between">
      <a href="/admin" class="font-semibold">devshayan Admin</a>
      <form method="post" action="/admin/logout" class="flex items-center gap-3 text-sm text-zinc-300">
        <?= csrf_field() ?>
        <span><?= e(Auth::name()??'') ?> (<?= e(Auth::role()??'') ?>)</span>
        <button class="px-3 py-1.5 rounded-lg bg-white/10 hover:bg-white/15">Logout</button>
      </form>
    </div>
  </header>
  <div class="max-w-6xl mx-auto px-4 py-6 grid grid-cols-12 gap-6">
    <aside class="col-span-12 md:col-span-3">
      <nav class="space-y-2 text-sm">
        <a class="block px-3 py-2 rounded-lg bg-white/5 hover:bg-white/10" href="/admin">Dashboard</a>
        <a class="block px-3 py-2 rounded-lg bg-white/5 hover:bg-white/10" href="/admin/blog">Blog</a>
        <?php if(Auth::isAdmin()): ?>
          <a class="block px-3 py-2 rounded-lg bg-white/5 hover:bg-white/10" href="/admin/settings">Settings</a>
          <a class="block px-3 py-2 rounded-lg bg-white/5 hover:bg-white/10" href="/admin/users">Users</a>
        <?php endif; ?>
        <a class="block px-3 py-2 rounded-lg bg-white/5 hover:bg-white/10" href="/">Back to site</a>
      </nav>
    </aside>
    <main class="col-span-12 md:col-span-9"><?= $content??'' ?></main>
  </div>
</body>
</html>
