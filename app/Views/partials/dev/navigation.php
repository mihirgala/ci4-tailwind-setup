<a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:left-4 focus:top-4 focus:z-50 focus:rounded-lg focus:bg-white focus:p-3 focus:outline-2 focus:outline-blue-700">Skip to content</a>
<header class="border-b border-slate-200 bg-white px-4 sm:px-6 lg:px-8">
    <div class="mx-auto flex max-w-6xl flex-wrap items-center justify-between gap-4 py-5">
        <a href="<?= esc(site_url('dev'), 'attr') ?>" class="flex flex-wrap items-center gap-3 font-semibold focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-blue-700">
            <?= esc($development->projectName) ?>
            <span class="rounded border border-blue-200 bg-blue-50 px-2 py-1 font-mono text-xs font-normal text-blue-800">development</span>
        </a>
        <nav class="flex flex-wrap gap-1" aria-label="Development tools">
            <?php foreach (['directory' => ['dev', 'Pages'], 'components' => ['dev-design-components', 'Components']] as $key => [$path, $label]): ?>
                <a href="<?= esc(site_url($path), 'attr') ?>" <?= $activeDevPage === $key ? 'aria-current="page"' : '' ?> class="rounded-lg px-3 py-2 text-sm font-medium transition-colors hover:bg-slate-100 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-700 <?= $activeDevPage === $key ? 'bg-blue-50 text-blue-800' : 'text-slate-600' ?>"><?= esc($label) ?></a>
            <?php endforeach; ?>
        </nav>
    </div>
</header>
