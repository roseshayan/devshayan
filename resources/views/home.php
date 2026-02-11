<?php declare(strict_types=1); ?>
<main class="max-w-6xl mx-auto px-4 py-10">
  <section class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
    <div class="lg:col-span-8 reveal">
      <div class="inline-flex items-center gap-2 rounded-full border border-zinc-200/70 dark:border-white/10 bg-white/60 dark:bg-white/5 px-3 py-1 text-xs text-zinc-600 dark:text-zinc-300">
        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
        <span><?= e($data['availability']) ?></span>
      </div>
      <h1 class="mt-4 text-3xl md:text-5xl font-bold tracking-tight">
        <span class="bg-clip-text text-transparent" style="background-image:linear-gradient(90deg,#111827,#6366f1,#ec4899);" class="dark:[background-image:linear-gradient(90deg,#ffffff,#a5b4fc,#fbcfe8)]">
          <?= e($data['name']) ?>
        </span>
      </h1>
      <div class="mt-3 text-zinc-600 dark:text-zinc-300 text-lg"><?= e($data['headline']) ?></div>
      <p id="about" class="mt-6 leading-8 text-zinc-600 dark:text-zinc-300"><?= e($data['summary']) ?></p>
      <div class="mt-8 flex flex-wrap gap-3">
        <a href="#projects" class="rounded-xl px-4 py-2 bg-zinc-900 text-white dark:bg-white dark:text-zinc-900 hover:opacity-90 transition">Projects</a>
        <a href="/blog" class="rounded-xl px-4 py-2 border border-zinc-200/70 dark:border-white/10 bg-white/60 dark:bg-white/5 hover:bg-white dark:hover:bg-white/10 transition">Blog</a>
        <?php if(!empty($data['resume'])): ?>
          <a href="<?= e((string)$data['resume']) ?>" class="rounded-xl px-4 py-2 border border-zinc-200/70 dark:border-white/10 bg-white/60 dark:bg-white/5 hover:bg-white dark:hover:bg-white/10 transition" target="_blank" rel="noreferrer">Resume PDF</a>
        <?php endif; ?>
      </div>
    </div>
    <aside class="lg:col-span-4 reveal">
      <div class="rounded-3xl border border-zinc-200/70 dark:border-white/10 bg-white/60 dark:bg-white/5 backdrop-blur p-6">
        <div class="flex items-center gap-4">
          <img src="<?= e((string)$data['profile_image']) ?>" alt="profile" class="w-16 h-16 rounded-2xl object-cover border border-zinc-200/70 dark:border-white/10">
          <div>
            <div class="font-semibold">Contact</div>
            <div class="text-xs text-zinc-500 dark:text-zinc-400"><?= e($settings['site_name']??'devshayan') ?></div>
          </div>
        </div>
        <div class="mt-5 space-y-3 text-sm">
          <?php foreach($data['contacts'] as $c): if(empty($c['value'])&&empty($c['href'])) continue; ?>
            <div class="flex items-center justify-between gap-4">
              <span class="text-zinc-500 dark:text-zinc-400"><?= e($c['label']) ?></span>
              <a class="text-zinc-900 dark:text-white hover:opacity-80 transition text-right" href="<?= e($c['href']) ?>" target="_blank" rel="noreferrer">
                <?= e($c['value']?:$c['href']) ?>
              </a>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </aside>
  </section>

  <section id="skills" class="mt-16 reveal">
    <div class="flex items-center gap-3">
      <div class="w-10 h-[2px] bg-zinc-200 dark:bg-white/10"></div>
      <h2 class="text-xl font-semibold">Skills</h2>
    </div>
    <div class="mt-6 grid grid-cols-1 lg:grid-cols-2 gap-8">
      <div class="rounded-3xl border border-zinc-200/70 dark:border-white/10 bg-white/60 dark:bg-white/5 backdrop-blur p-6">
        <div class="font-semibold mb-4">Skill Meter</div>
        <div class="space-y-4">
          <?php foreach($data['skillBars'] as $s): ?>
            <div class="skill" data-value="<?= (int)$s['value'] ?>">
              <div class="flex justify-between text-sm text-zinc-600 dark:text-zinc-300">
                <span><?= e($s['title']) ?></span><span><?= (int)$s['value'] ?>%</span>
              </div>
              <div class="h-2 bg-zinc-100 dark:bg-white/10 rounded-full overflow-hidden mt-2">
                <div class="skill-bar h-2 bg-zinc-900 dark:bg-white rounded-full w-0"></div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
      <div class="rounded-3xl border border-zinc-200/70 dark:border-white/10 bg-white/60 dark:bg-white/5 backdrop-blur p-6">
        <div class="font-semibold mb-4">Stacks</div>
        <div class="space-y-5">
          <?php foreach($data['stacks'] as $group=>$items): ?>
            <div>
              <div class="text-sm text-zinc-500 dark:text-zinc-400 mb-2"><?= e($group) ?></div>
              <div class="flex flex-wrap gap-2">
                <?php foreach($items as $it): ?>
                  <span class="text-xs rounded-full border border-zinc-200/70 dark:border-white/10 bg-white/70 dark:bg-white/5 px-3 py-1"><?= e($it) ?></span>
                <?php endforeach; ?>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </section>

  <section id="projects" class="mt-16 reveal">
    <div class="flex items-center gap-3">
      <div class="w-10 h-[2px] bg-zinc-200 dark:bg-white/10"></div>
      <h2 class="text-xl font-semibold">Projects</h2>
    </div>
    <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
      <?php foreach($data['projects'] as $p): ?>
        <a href="<?= e($p['href']) ?>" target="_blank" rel="noreferrer" class="group rounded-3xl border border-zinc-200/70 dark:border-white/10 bg-white/60 dark:bg-white/5 backdrop-blur p-6 hover:bg-white dark:hover:bg-white/10 transition">
          <div class="flex items-start justify-between gap-4">
            <div>
              <div class="font-semibold"><?= e($p['title']) ?></div>
              <div class="text-xs text-zinc-500 dark:text-zinc-400 mt-1"><?= e($p['stack']) ?></div>
            </div>
            <div class="text-xs text-zinc-500 dark:text-zinc-400 group-hover:text-zinc-900 dark:group-hover:text-white transition">View ↗</div>
          </div>
          <div class="text-sm text-zinc-600 dark:text-zinc-300 mt-4 leading-7"><?= e($p['desc']) ?></div>
        </a>
      <?php endforeach; ?>
    </div>
  </section>

  <footer class="mt-16 text-center text-xs text-zinc-500 dark:text-zinc-400"><?= e($settings['footer_text']??('© '.date('Y').' devshayan')) ?></footer>
</main>
