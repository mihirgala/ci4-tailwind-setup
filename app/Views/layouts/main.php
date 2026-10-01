<?php
$appName = $appName ?? 'CI4 Starter';
$showSiteChrome = $showSiteChrome ?? true;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= esc($description ?? 'A CodeIgniter 4 and Tailwind CSS starter.', 'attr') ?>">
    <title><?= esc(empty($title) ? $appName : $title . ' | ' . $appName) ?></title>
    <link rel="stylesheet" href="<?= esc(base_url('css/output.css'), 'attr') ?>">
</head>

<body class="flex min-h-svh flex-col bg-white text-slate-900">
    <?php if ($showSiteChrome): ?>
    <?= $this->include('partials/navbar') ?>
    <?php endif; ?>
    <?= $this->renderSection('navigation') ?>

    <main id="main-content" tabindex="-1" class="flex flex-1 flex-col">
        <?= $this->renderSection('content') ?>
    </main>

    <?php if ($showSiteChrome): ?>
    <?= $this->include('partials/footer') ?>
    <?php endif; ?>
</body>

</html>
