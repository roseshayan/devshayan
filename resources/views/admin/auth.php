<?php declare(strict_types=1); ?>
<!doctype html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title><?= e($title??'Admin') ?></title>
  <link rel="stylesheet" href="/assets/app.css">
</head>
<body class="min-h-screen flex items-center justify-center bg-zinc-950 text-zinc-50">
  <?= $content??'' ?>
</body>
</html>
