<?php
// Lints every PHP file under app/. Usage: php scripts/lint.php
$failed = 0;
$it = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(dirname(__DIR__) . '/app', FilesystemIterator::SKIP_DOTS));
foreach ($it as $file) {
    if ($file->getExtension() !== 'php') {
        continue;
    }
    exec('php -l ' . escapeshellarg($file->getPathname()) . ' 2>&1', $out, $code);
    if ($code !== 0) {
        $failed++;
        echo implode("\n", $out), "\n";
    }
    $out = [];
}
echo $failed ? "Lint failed: {$failed} file(s)\n" : "PHP lint OK\n";
exit($failed ? 1 : 0);
