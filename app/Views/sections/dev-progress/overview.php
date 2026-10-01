<?php
$sections = $page['sections'];
$sectionCount = count($sections);
$completion = $total > 0 ? round($ready / $total * 100) : 0;
?>
<section class="flex-1 bg-slate-50 px-4 py-10 sm:px-6 lg:px-8 lg:py-14" aria-labelledby="progress-title">
    <div class="mx-auto max-w-6xl">
        <header class="border-b border-slate-200 pb-8">
            <p class="font-mono text-xs uppercase tracking-widest text-blue-700">Page build sheet</p>
            <h1 id="progress-title" class="mt-3 text-3xl font-semibold tracking-tight sm:text-4xl"><?= esc($page['name']) ?> progress</h1>
            <p class="mt-4 max-w-2xl text-sm leading-7 text-slate-600">Track available components and assets separately from sections assembled on the public page.</p>
            <div class="mt-5"><?= component('Components/ui/button', ['href' => $page['path'], 'text' => 'Open ' . $page['name'], 'variant' => 'outline']) ?></div>

            <div class="mt-8 grid gap-5 sm:grid-cols-2">
                <div class="rounded-xl border border-slate-200 bg-white p-6">
                    <h2 class="text-sm font-medium text-slate-600">Components and assets available</h2>
                    <p class="mt-3 font-mono text-3xl"><?= $ready ?><span class="text-xl text-slate-400"> / <?= $total ?></span></p>
                    <?php if ($total > 0): ?>
                        <div class="mt-5 h-2 overflow-hidden rounded-full bg-slate-100" role="progressbar" aria-label="Components and assets available" aria-valuenow="<?= $ready ?>" aria-valuemin="0" aria-valuemax="<?= $total ?>">
                            <div class="h-full rounded-full bg-blue-700" style="width: <?= $completion ?>%"></div>
                        </div>
                    <?php else: ?>
                        <p class="mt-4 text-sm text-slate-500">No requirements scoped yet.</p>
                    <?php endif; ?>
                </div>
                <div class="rounded-xl border border-slate-200 bg-white p-6">
                    <h2 class="text-sm font-medium text-slate-600">Sections assembled on the public page</h2>
                    <p class="mt-3 font-mono text-3xl"><?= $assembled ?><span class="text-xl text-slate-400"> / <?= $sectionCount ?></span></p>
                    <p class="mt-4 break-words text-sm leading-6 text-slate-500">Verify assembly in <code><?= esc($page['source']) ?></code>.</p>
                </div>
            </div>
        </header>

        <section class="mt-8 rounded-xl border border-slate-200 bg-white p-6" aria-labelledby="page-references-title">
            <h2 id="page-references-title" class="text-lg font-semibold">Page design references</h2>
            <div class="mt-4"><?= component('partials/dev/references', ['references' => $page['figma'] ?? []]) ?></div>
        </section>

        <?php if ($development->sharedElements !== []): ?>
            <section class="mt-8" aria-labelledby="shared-elements-title">
                <h2 id="shared-elements-title" class="text-lg font-semibold">Shared site elements</h2>
                <p class="mt-2 text-sm leading-7 text-slate-600">Shared partials and references are separate from this page's section counts.</p>
                <div class="mt-4 grid gap-5 md:grid-cols-2">
                    <?php foreach ($development->sharedElements as $element): ?>
                        <article class="min-w-0 rounded-xl border border-slate-200 bg-white p-6">
                            <h3 class="font-semibold"><?= esc($element['label']) ?></h3>
                            <p class="mt-2 text-sm leading-7 text-slate-600"><?= esc($element['description']) ?></p>
                            <p class="mt-3 break-all font-mono text-xs text-slate-500"><?= esc($element['source']) ?></p>
                            <div class="mt-4"><?= component('partials/dev/references', ['references' => $element['figma'] ?? []]) ?></div>
                        </article>
                    <?php endforeach; ?>
                </div>
            </section>
        <?php endif; ?>

        <section class="mt-10" aria-labelledby="sections-title">
            <h2 id="sections-title" class="text-xl font-semibold">Page sections</h2>
            <?php if ($sections === []): ?>
                <div class="mt-4 rounded-xl border border-dashed border-slate-300 p-8">
                    <h3 class="font-semibold">No sections tracked yet</h3>
                    <p class="mt-2 text-sm leading-7 text-slate-600">Add the page's real sections and required pieces in <code class="break-all">app/Config/Development.php</code>. Leave dates unset until the actual milestones are known.</p>
                </div>
            <?php endif; ?>
            <div class="mt-4 space-y-5">
                <?php foreach ($sections as $index => $section): ?>
                    <?php
                    $sectionReady = array_sum(array_column($section['items'], 'ready'));
                    $sectionTotal = array_sum(array_column($section['items'], 'total'));
                    $status = $sectionTotal === 0 ? 'Not scoped' : ($sectionReady < $sectionTotal ? 'Pieces pending' : 'Pieces available');
                    ?>
                    <article class="rounded-xl border border-slate-200 bg-white p-6" aria-labelledby="section-<?= $index ?>-title">
                        <div class="flex flex-wrap items-start justify-between gap-4">
                            <div class="min-w-0">
                                <h3 id="section-<?= $index ?>-title" class="break-words text-lg font-semibold"><?= esc($section['name']) ?></h3>
                                <p class="mt-2 text-sm text-slate-500"><?= $sectionReady ?>/<?= $sectionTotal ?> pieces available · <?= $section['assembled'] ? 'Assembled' : 'Not assembled' ?></p>
                            </div>
                            <span class="rounded-md border border-slate-200 px-3 py-1 font-mono text-xs text-slate-600"><?= esc($status) ?></span>
                        </div>
                        <ul class="mt-5 grid gap-2 text-sm sm:grid-cols-2">
                            <?php foreach ($section['items'] as $item): ?>
                                <li class="flex items-start justify-between gap-4 rounded-lg bg-slate-50 px-3 py-2">
                                    <span class="min-w-0 break-words"><?= esc($item['label']) ?></span>
                                    <span class="shrink-0 font-mono text-slate-500"><?= esc((string) $item['ready']) ?>/<?= esc((string) $item['total']) ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                        <div class="mt-5 border-t border-slate-100 pt-4"><?= component('partials/dev/references', ['references' => $section['figma'] ?? []]) ?></div>
                    </article>
                <?php endforeach; ?>
            </div>
        </section>

        <p class="mt-8 text-sm leading-7 text-slate-500">Update <code class="break-all">app/Config/Development.php</code> as designs and assets arrive. A gallery preview alone does not establish public assembly. See <code>docs/development.md</code>.</p>
    </div>
</section>
