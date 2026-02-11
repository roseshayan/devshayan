<?php declare(strict_types=1); ?>
<div class="p-5 rounded-2xl border border-white/10 bg-white/5">
  <div class="text-sm text-zinc-300">Welcome</div>
  <div class="text-2xl font-semibold mt-1"><?= e(($user['name']??'').'') ?></div>
  <div class="text-sm text-zinc-300 mt-2">Role: <?= e(($user['role']??'')) ?></div>
</div>
