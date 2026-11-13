<?php
// Lints PHP under app/, scripts/, tests/ plus public/index.php. Usage: php scripts/lint.php
$failed = 0;
$root = dirname(__DIR__);
$files = [$root . '/public/index.php'];
foreach (['app', 'scripts', 'tests'] as $dir) {
    if (! is_dir($root . '/' . $dir)) {
        continue;
    }
    foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($root . '/' . $dir, FilesystemIterator::SKIP_DOTS)) as $file) {
        if ($file->getExtension() === 'php') {
            $files[] = $file->getPathname();
        }
    }
}
foreach ($files as $path) {
    exec('php -l ' . escapeshellarg($path) . ' 2>&1', $out, $code);
    if ($code !== 0) {
        $failed++;
        echo implode("\n", $out), "\n";
    }
    $out = [];
}
echo $failed ? "Lint failed: {$failed} file(s)\n" : "PHP lint OK\n";
exit($failed ? 1 : 0);
