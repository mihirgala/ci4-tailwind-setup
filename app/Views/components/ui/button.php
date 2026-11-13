<?php
$variants = [
    'primary' => 'border-brand-700 bg-brand-700 text-white hover:border-brand-800 hover:bg-brand-800',
    'secondary' => 'border-slate-200 bg-slate-100 text-ink hover:border-slate-300 hover:bg-slate-200',
    'outline' => 'border-slate-300 bg-white text-ink hover:border-brand-700 hover:text-brand-700',
];
$classes = 'inline-flex items-center justify-center rounded-lg border px-4 py-2.5 text-sm font-semibold transition-colors focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-brand-700 disabled:cursor-not-allowed disabled:opacity-50 ' . ($variants[$variant ?? 'primary'] ?? $variants['primary']);
$disabled = $disabled ?? false;
$text = $text ?? 'Continue';
$buttonType = in_array($buttonType ?? 'button', ['button', 'submit', 'reset'], true) ? ($buttonType ?? 'button') : 'button';
// External links: pass 'external' => true with an absolute http(s) URL. Anything else falls back to an internal route.
$external = ($external ?? false) && isset($href) && preg_match('#^https?://#i', $href) === 1;
?>
<?php if (isset($href) && ! $disabled): ?>
    <a href="<?= esc($external ? $href : site_url($href), 'attr') ?>"<?= $external ? ' rel="noopener noreferrer"' : '' ?> class="<?= esc($classes, 'attr') ?>"><?= esc($text) ?></a>
<?php else: ?>
    <button type="<?= esc($buttonType, 'attr') ?>" class="<?= esc($classes, 'attr') ?>" <?= $disabled ? 'disabled' : '' ?>><?= esc($text) ?></button>
<?php endif; ?>
