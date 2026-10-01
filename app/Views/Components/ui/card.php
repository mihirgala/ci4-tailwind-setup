<article class="flex flex-col rounded-xl border border-slate-200 bg-white p-6">
    <h3 class="text-lg font-semibold tracking-tight"><?= esc($title ?? 'Card title') ?></h3>
    <p class="mt-3 text-sm leading-7 text-slate-600"><?= esc($text ?? 'Supporting content.') ?></p>
    <?php if (isset($href)): ?>
        <div class="mt-6">
            <?= component('Components/ui/button', ['href' => $href, 'text' => $actionText ?? 'Learn more', 'variant' => 'outline']) ?>
        </div>
    <?php endif; ?>
</article>
