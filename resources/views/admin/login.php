<?php

declare(strict_types=1); ?>
<div class="w-full max-w-md p-6 rounded-2xl border border-white/10 bg-white/5">
    <h1 class="text-xl font-semibold">Admin Login</h1>
    <?php if (!empty($error)): ?>
        <div class="mt-3 text-sm text-rose-300"><?= e($error) ?></div>
    <?php endif; ?>
    <form class="mt-5 space-y-3" method="post" action="/admin/login">
        <input class="w-full px-3 py-2 rounded-lg bg-zinc-900 border border-white/10" name="email" type="email" placeholder="Email" required>
        <input class="w-full px-3 py-2 rounded-lg bg-zinc-900 border border-white/10" name="password" type="password" placeholder="Password" required>
        <button class="w-full px-3 py-2 rounded-lg bg-white text-zinc-950 font-semibold">Sign in</button>
    </form>
</div>