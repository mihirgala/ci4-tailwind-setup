<?php
$tag = in_array($tag ?? 'h2', ['h1', 'h2', 'h3', 'h4', 'h5', 'h6'], true) ? ($tag ?? 'h2') : 'h2';
?>
<div>
    <<?= $tag ?><?php if (isset($id)): ?> id="<?= esc($id, 'attr') ?>"<?php endif; ?> class="text-2xl font-semibold tracking-tight sm:text-3xl"><?= esc($text ?? 'Section heading') ?></<?= $tag ?>>
    <?php if (! empty($description)): ?>
        <p class="mt-3 max-w-2xl text-sm leading-7 text-slate-600"><?= esc($description) ?></p>
    <?php endif; ?>
</div>
