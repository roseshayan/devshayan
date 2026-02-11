<?php declare(strict_types=1); ?>
<div class="p-5 rounded-2xl border border-white/10 bg-white/5">
  <h2 class="text-lg font-semibold">Settings</h2>
  <p class="mt-2 text-sm text-zinc-300">Site identity + hero content + contacts + uploads.</p>
  <form class="mt-6 space-y-6" method="post" action="/admin/settings/save" enctype="multipart/form-data">
    <?= csrf_field() ?>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div>
        <label class="text-sm text-zinc-300">Site name</label>
        <input class="mt-2 w-full px-3 py-2 rounded-lg bg-zinc-900 border border-white/10" name="site_name" value="<?= e($s['site_name']??'devshayan') ?>">
      </div>
      <div>
        <label class="text-sm text-zinc-300">Availability text</label>
        <input class="mt-2 w-full px-3 py-2 rounded-lg bg-zinc-900 border border-white/10" name="availability_text" value="<?= e($s['availability_text']??'') ?>">
      </div>
      <div>
        <label class="text-sm text-zinc-300">Hero name</label>
        <input class="mt-2 w-full px-3 py-2 rounded-lg bg-zinc-900 border border-white/10" name="hero_name" value="<?= e($s['hero_name']??'') ?>">
      </div>
      <div>
        <label class="text-sm text-zinc-300">Hero headline</label>
        <input class="mt-2 w-full px-3 py-2 rounded-lg bg-zinc-900 border border-white/10" name="hero_headline" value="<?= e($s['hero_headline']??'') ?>">
      </div>
      <div class="md:col-span-2">
        <label class="text-sm text-zinc-300">Hero summary</label>
        <textarea class="mt-2 w-full px-3 py-2 rounded-lg bg-zinc-900 border border-white/10 h-28" name="hero_summary"><?= e($s['hero_summary']??'') ?></textarea>
      </div>
      <div class="md:col-span-2">
        <label class="text-sm text-zinc-300">Footer text</label>
        <input class="mt-2 w-full px-3 py-2 rounded-lg bg-zinc-900 border border-white/10" name="footer_text" value="<?= e($s['footer_text']??'') ?>">
      </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div>
        <label class="text-sm text-zinc-300">Email</label>
        <input class="mt-2 w-full px-3 py-2 rounded-lg bg-zinc-900 border border-white/10" name="contact_email" value="<?= e($s['contact_email']??'') ?>">
      </div>
      <div>
        <label class="text-sm text-zinc-300">Phone</label>
        <input class="mt-2 w-full px-3 py-2 rounded-lg bg-zinc-900 border border-white/10" name="contact_phone" value="<?= e($s['contact_phone']??'') ?>">
      </div>
      <div>
        <label class="text-sm text-zinc-300">GitHub URL</label>
        <input class="mt-2 w-full px-3 py-2 rounded-lg bg-zinc-900 border border-white/10" name="contact_github" value="<?= e($s['contact_github']??'') ?>">
      </div>
      <div>
        <label class="text-sm text-zinc-300">LinkedIn URL</label>
        <input class="mt-2 w-full px-3 py-2 rounded-lg bg-zinc-900 border border-white/10" name="contact_linkedin" value="<?= e($s['contact_linkedin']??'') ?>">
      </div>
      <div class="md:col-span-2">
        <label class="text-sm text-zinc-300">Website URL</label>
        <input class="mt-2 w-full px-3 py-2 rounded-lg bg-zinc-900 border border-white/10" name="contact_website" value="<?= e($s['contact_website']??'') ?>">
      </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
      <div>
        <label class="text-sm text-zinc-300">Logo (PNG)</label>
        <input class="mt-2 w-full text-sm" type="file" name="logo" accept="image/png">
        <?php if(!empty($s['logo_path'])): ?><img class="mt-3 w-16 h-16 rounded-xl object-cover border border-white/10" src="<?= e($s['logo_path']) ?>" alt="logo"><?php endif; ?>
      </div>
      <div>
        <label class="text-sm text-zinc-300">Profile image</label>
        <input class="mt-2 w-full text-sm" type="file" name="profile_image" accept="image/png,image/jpeg,image/webp">
        <?php if(!empty($s['profile_image_path'])): ?><img class="mt-3 w-16 h-16 rounded-xl object-cover border border-white/10" src="<?= e($s['profile_image_path']) ?>" alt="profile"><?php endif; ?>
      </div>
      <div>
        <label class="text-sm text-zinc-300">Resume (PDF)</label>
        <input class="mt-2 w-full text-sm" type="file" name="resume_pdf" accept="application/pdf">
        <?php if(!empty($s['resume_path'])): ?><a class="mt-3 inline-block text-sm underline" href="<?= e($s['resume_path']) ?>" target="_blank" rel="noreferrer">Current PDF</a><?php endif; ?>
      </div>
    </div>

    <button class="px-4 py-2 rounded-xl bg-white text-zinc-950 font-semibold">Save</button>
  </form>
</div>
