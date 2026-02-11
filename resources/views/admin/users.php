<?php declare(strict_types=1); ?>
<div class="p-5 rounded-2xl border border-white/10 bg-white/5">
  <h2 class="text-lg font-semibold">Users</h2>
  <form class="mt-4 grid grid-cols-1 md:grid-cols-4 gap-3" method="post" action="/admin/users/create">
    <?= csrf_field() ?>
    <input class="px-3 py-2 rounded-lg bg-zinc-900 border border-white/10" name="name" placeholder="Name" required>
    <input class="px-3 py-2 rounded-lg bg-zinc-900 border border-white/10" name="email" type="email" placeholder="Email" required>
    <input class="px-3 py-2 rounded-lg bg-zinc-900 border border-white/10" name="password" type="password" placeholder="Password" required>
    <select class="px-3 py-2 rounded-lg bg-zinc-900 border border-white/10" name="role">
      <option value="editor">editor</option>
      <option value="admin">admin</option>
    </select>
    <button class="md:col-span-4 px-3 py-2 rounded-lg bg-white text-zinc-950 font-semibold">Create User</button>
  </form>
  <div class="mt-6 overflow-x-auto">
    <table class="w-full text-sm">
      <thead class="text-zinc-300"><tr class="border-b border-white/10"><th class="text-left py-2">ID</th><th class="text-left py-2">Name</th><th class="text-left py-2">Email</th><th class="text-left py-2">Role</th><th class="text-left py-2">Created</th></tr></thead>
      <tbody>
        <?php foreach(($users??[]) as $u): ?>
          <tr class="border-b border-white/5">
            <td class="py-2"><?= (int)$u['id'] ?></td>
            <td class="py-2"><?= e($u['name']) ?></td>
            <td class="py-2"><?= e($u['email']) ?></td>
            <td class="py-2"><?= e($u['role']) ?></td>
            <td class="py-2 text-zinc-300"><?= e($u['created_at']) ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
