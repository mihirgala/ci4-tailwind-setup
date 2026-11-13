<?php
// Example section: outer gutter on the wrapper, centered width on the inner container.
$actions = [
    ['text' => 'Open development workspace', 'href' => '/dev', 'variant' => 'primary'],
    ['text' => 'Read the docs', 'href' => 'https://github.com/mihirgala/ci4-tailwind-setup', 'variant' => 'outline', 'external' => true],
];
?>
<section aria-labelledby="hero-heading" class="px-gutter py-16 sm:py-24">
    <div class="container-page flex flex-col items-start gap-8">
        <?= component('components/ui/title', [
            'id' => 'hero-heading',
            'tag' => 'h1',
            'text' => 'Build with CodeIgniter 4 and Tailwind CSS',
            'description' => 'Replace this section with your own. It shows the section convention: sections/<page>/<name>.php, utility classes, shared components.',
        ]) ?>
        <div class="flex flex-wrap gap-3">
            <?php foreach ($actions as $action): ?>
                <?php if (! empty($action['external'])): ?>
                    <a href="<?= esc($action['href'], 'attr') ?>" rel="noopener" class="inline-flex items-center justify-center rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-900 transition-colors hover:border-brand-700 hover:text-brand-700"><?= esc($action['text']) ?></a>
                <?php else: ?>
                    <?= component('components/ui/button', $action) ?>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>
