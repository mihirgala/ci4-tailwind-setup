<dl class="grid gap-3 text-sm">
    <?php foreach ($milestones as $label => $date): ?>
        <div class="flex flex-wrap justify-between gap-x-4 gap-y-1">
            <dt class="text-slate-500"><?= esc($label) ?></dt>
            <dd class="font-medium text-slate-800">
                <?php if ($date !== null): ?>
                    <time datetime="<?= esc($date, 'attr') ?>"><?= esc(date('j M Y', strtotime($date))) ?></time>
                <?php else: ?>
                    <span class="font-normal text-slate-500">Not recorded</span>
                <?php endif; ?>
            </dd>
        </div>
    <?php endforeach; ?>
</dl>
