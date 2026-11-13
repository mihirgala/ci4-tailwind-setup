<?php
// Mirrors the canonical skills in .agents/skills into each agent-specific folder.
// Edit skills ONLY in .agents/skills, then run: pnpm skills:sync (the pre-commit hook also runs it).
// To support another agent, add its skills folder to $targets.
$root = dirname(__DIR__);
$source = $root . '/.agents/skills';
$targets = ['.claude/skills'];

function rrmdir(string $dir): void {
    if (! is_dir($dir)) return;
    foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir, FilesystemIterator::SKIP_DOTS), RecursiveIteratorIterator::CHILD_FIRST) as $f) {
        $f->isDir() ? rmdir($f->getPathname()) : unlink($f->getPathname());
    }
    rmdir($dir);
}

foreach ($targets as $target) {
    $dest = $root . '/' . $target;
    rrmdir($dest);
    foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source, FilesystemIterator::SKIP_DOTS), RecursiveIteratorIterator::SELF_FIRST) as $f) {
        $to = $dest . '/' . substr($f->getPathname(), strlen($source) + 1);
        $f->isDir() ? @mkdir($to, 0777, true) : (@mkdir(dirname($to), 0777, true) + copy($f->getPathname(), $to));
    }
    echo "Synced to {$target}\n";
}
