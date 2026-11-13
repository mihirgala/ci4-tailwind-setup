<?php
// Mirrors the canonical skills in .agents/skills into each agent-specific folder.
// Edit skills ONLY in .agents/skills, then run: pnpm skills:sync (the pre-commit hook also runs it).
// To support another agent, add its skills folder to $targets.
// Safe by design: copies into a temp folder and swaps it in only after every file copied; exits 1 on failure.
$root = dirname(__DIR__);
$source = $root . '/.agents/skills';
$targets = ['.claude/skills'];

function fail(string $message): never
{
    fwrite(STDERR, "sync-skills: {$message}\n");
    exit(1);
}

function rrmdir(string $dir): void
{
    if (! is_dir($dir)) {
        return;
    }
    foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir, FilesystemIterator::SKIP_DOTS), RecursiveIteratorIterator::CHILD_FIRST) as $f) {
        $ok = $f->isDir() ? rmdir($f->getPathname()) : unlink($f->getPathname());
        $ok || fail('could not remove ' . $f->getPathname());
    }
    rmdir($dir) || fail("could not remove {$dir}");
}

if (! is_dir($source)) {
    fail("source {$source} is missing; nothing was changed");
}

// Collect everything first so a read error cannot leave a half-deleted target.
$entries = [];
foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source, FilesystemIterator::SKIP_DOTS), RecursiveIteratorIterator::SELF_FIRST) as $f) {
    $entries[] = [$f->isDir(), $f->getPathname(), substr($f->getPathname(), strlen($source) + 1)];
}
if ($entries === []) {
    fail("source {$source} is empty; nothing was changed");
}

foreach ($targets as $target) {
    $dest = $root . '/' . $target;
    $tmp = $dest . '.tmp';

    // Build the new mirror beside the old one; only swap it in once every file copied.
    rrmdir($tmp);
    mkdir($tmp, 0777, true) || fail("could not create {$tmp}");
    foreach ($entries as [$isDir, $from, $rel]) {
        $to = $tmp . '/' . $rel;
        if ($isDir) {
            is_dir($to) || mkdir($to, 0777, true) || (rrmdir($tmp) ?: fail("could not create {$to}"));
        } else {
            is_dir(dirname($to)) || mkdir(dirname($to), 0777, true) || fail('could not create ' . dirname($to));
            copy($from, $to) || (rrmdir($tmp) ?: fail("could not copy {$from}; {$target} left unchanged"));
        }
    }

    rrmdir($dest);
    rename($tmp, $dest) || fail("could not move {$tmp} to {$dest}");
    echo "Synced to {$target}
";
}
