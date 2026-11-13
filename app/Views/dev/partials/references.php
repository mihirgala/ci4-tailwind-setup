<?php if ($references === []): ?>
    <p class="text-sm text-slate-500">No design references recorded.</p>
<?php else: ?>
    <ul class="flex flex-wrap gap-x-5 gap-y-3 text-sm">
        <?php foreach ($references as $reference): ?>
            <li class="min-w-0 break-words">
                <a href="<?= esc($reference['url'], 'attr') ?>" target="_blank" rel="noopener noreferrer" class="text-blue-700 underline underline-offset-4 hover:text-blue-900 focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-blue-700"><?= esc($reference['label']) ?> <span aria-hidden="true">↗</span><span class="sr-only"> (opens in a new tab)</span></a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
