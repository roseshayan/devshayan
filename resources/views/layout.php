<?php

declare(strict_types=1);
function e(mixed $v): string
{
    return htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8');
}
?>
<!doctype html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($title ?? 'devshayan') ?></title>
    <script>
        // جلوگیری از پرش تم (FOUC) - پیش‌فرض: دارک
        (() => {
            const saved = localStorage.getItem('theme');
            const theme = saved === 'light' ? 'light' : 'dark';
            document.documentElement.setAttribute('data-theme', theme);
        })();
    </script>
    <link rel="stylesheet" href="/assets/app.css">
</head>

<body class="min-h-screen bg-white text-zinc-900 dark:bg-zinc-950 dark:text-zinc-50 antialiased">
    <div aria-hidden="true" class="fixed inset-0 -z-10 opacity-80 dark:opacity-70"
        style="background:
       radial-gradient(700px 400px at 20% 10%, rgba(99,102,241,.20), transparent 60%),
       radial-gradient(600px 350px at 80% 20%, rgba(16,185,129,.16), transparent 60%),
       radial-gradient(800px 500px at 50% 90%, rgba(236,72,153,.12), transparent 60%);">
    </div>
    <header class="sticky top-0 z-30 border-b border-zinc-200/60 dark:border-white/10 bg-white/70 dark:bg-zinc-950/55 backdrop-blur">
        <div class="max-w-6xl mx-auto px-4 py-3 flex items-center justify-between">
            <a href="/" class="font-semibold tracking-tight">devshayan</a>
            <nav class="hidden md:flex items-center gap-5 text-sm text-zinc-600 dark:text-zinc-300">
                <a href="#about" class="hover:text-zinc-900 dark:hover:text-white">درباره</a>
                <a href="#skills" class="hover:text-zinc-900 dark:hover:text-white">مهارت‌ها</a>
                <a href="#experience" class="hover:text-zinc-900 dark:hover:text-white">سوابق</a>
                <a href="#projects" class="hover:text-zinc-900 dark:hover:text-white">پروژه‌ها</a>
                <a href="#contact" class="hover:text-zinc-900 dark:hover:text-white">تماس</a>
            </nav>
            <button id="themeToggle" class="group inline-flex items-center gap-2 rounded-xl border border-zinc-200/70 dark:border-white/10 px-3 py-2 text-sm bg-white/60 dark:bg-white/5 hover:bg-white dark:hover:bg-white/10 transition">
                <span class="opacity-80 group-hover:opacity-100">Theme</span>
                <span class="w-5 h-5 inline-block">
                    <!-- آیکن ساده (بسته به تم با CSS) -->
                    <svg viewBox="0 0 24 24" fill="none" class="w-5 h-5">
                        <path class="stroke-zinc-800 dark:stroke-white" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"
                            d="M12 18a6 6 0 1 0 0-12a6 6 0 0 0 0 12Z" />
                        <path class="stroke-zinc-800 dark:stroke-white" stroke-width="1.8" stroke-linecap="round"
                            d="M12 2v2M12 20v2M4 12H2M22 12h-2M5 5l1.4 1.4M17.6 17.6L19 19M19 5l-1.4 1.4M5 19l1.4-1.4" />
                    </svg>
                </span>
            </button>
        </div>
    </header>
    <?= $content ?? '' ?>
    <script src="/assets/app.js"></script>
</body>

</html>