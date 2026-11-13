<?php
// Example section: outer gutter on the wrapper, centered width on the inner container.
// TODO(clone): replace the docs link with your project's own URL.
$docsUrl = 'https://github.com/mihirgala/ci4-tailwind-setup';
$actions = [];
if (ENVIRONMENT === 'development') {
    // /dev routes exist only in development, so only offer the link there.
    $actions[] = ['text' => 'Open development workspace', 'href' => '/dev', 'variant' => 'primary'];
}
$actions[] = ['text' => 'Read the docs', 'href' => $docsUrl, 'variant' => 'outline', 'external' => true];
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
                <?= component('components/ui/button', $action) ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>
