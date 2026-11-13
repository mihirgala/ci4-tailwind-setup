<?php
$variants = [
    'primary' => 'border-blue-700 bg-blue-700 text-white hover:border-blue-800 hover:bg-blue-800',
    'secondary' => 'border-slate-200 bg-slate-100 text-slate-900 hover:border-slate-300 hover:bg-slate-200',
    'outline' => 'border-slate-300 bg-white text-slate-900 hover:border-blue-700 hover:text-blue-700',
];
$classes = 'inline-flex items-center justify-center rounded-lg border px-4 py-2.5 text-sm font-semibold transition-colors focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-700 disabled:cursor-not-allowed disabled:opacity-50 ' . ($variants[$variant ?? 'primary'] ?? $variants['primary']);
$disabled = $disabled ?? false;
$text = $text ?? 'Continue';
$buttonType = in_array($buttonType ?? 'button', ['button', 'submit', 'reset'], true) ? ($buttonType ?? 'button') : 'button';
?>
<?php if (isset($href) && ! $disabled): ?>
    <a href="<?= esc(site_url($href), 'attr') ?>" class="<?= esc($classes, 'attr') ?>"><?= esc($text) ?></a>
<?php else: ?>
    <button type="<?= esc($buttonType, 'attr') ?>" class="<?= esc($classes, 'attr') ?>" <?= $disabled ? 'disabled' : '' ?>><?= esc($text) ?></button>
<?php endif; ?>
