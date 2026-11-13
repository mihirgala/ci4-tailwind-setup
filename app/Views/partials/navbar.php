<?php
$brand = $appName ?? 'CI4 Starter';
$links = [
    ['label' => 'Home', 'path' => '/'],
];
$current = trim(service('request')->getUri()->getPath(), '/');
?>
<a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:left-4 focus:top-4 focus:z-50 focus:rounded-lg focus:bg-white focus:p-3">Skip to content</a>
<header class="border-b border-slate-200 bg-white px-gutter">
    <div class="container-page flex flex-wrap items-center justify-between gap-4 py-4">
        <a href="<?= esc(site_url('/'), 'attr') ?>" class="font-semibold"><?= esc($brand) ?></a>
        <nav aria-label="Primary" class="flex flex-wrap gap-1">
            <?php foreach ($links as $link): ?>
                <?php $isCurrent = trim($link['path'], '/') === $current; ?>
                <a href="<?= esc(site_url($link['path']), 'attr') ?>" <?= $isCurrent ? 'aria-current="page"' : '' ?> class="rounded-lg px-3 py-2 text-sm font-medium transition-colors hover:bg-slate-100 <?= $isCurrent ? 'bg-brand-50 text-brand-800' : 'text-muted' ?>"><?= esc($link['label']) ?></a>
            <?php endforeach; ?>
        </nav>
    </div>
</header>
