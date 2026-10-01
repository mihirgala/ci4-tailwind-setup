<section class="flex-1 bg-slate-50 px-4 py-10 sm:px-6 lg:px-8 lg:py-14" aria-labelledby="directory-title">
    <div class="mx-auto max-w-6xl">
        <header class="flex flex-wrap items-end justify-between gap-6 border-b border-slate-200 pb-8">
            <div>
                <p class="font-mono text-xs uppercase tracking-widest text-blue-700">Implementation workspace</p>
                <h1 id="directory-title" class="mt-3 text-3xl font-semibold tracking-tight sm:text-4xl">Page directory</h1>
                <p class="mt-4 max-w-xl text-sm leading-7 text-slate-600">Open a public page, inspect reusable components, or review the work still needed for each section.</p>
            </div>
            <div class="text-sm">
                <?= component('partials/dev/milestones', ['milestones' => ['Project started' => $development->projectStartedAt]]) ?>
            </div>
        </header>

        <div class="mt-8 rounded-xl border border-blue-200 bg-blue-50 p-5 sm:flex sm:items-center sm:justify-between sm:gap-6">
            <div>
                <h2 class="font-semibold text-blue-950">Component gallery</h2>
                <p class="mt-1 text-sm leading-6 text-blue-800">Check existing UI and variants before building another component.</p>
            </div>
            <div class="mt-4 shrink-0 sm:mt-0"><?= component('Components/ui/button', ['href' => '/dev-design-components', 'text' => 'Open gallery']) ?></div>
        </div>

        <?php if ($development->pages === []): ?>
            <div class="mt-8 rounded-xl border border-dashed border-slate-300 p-8">
                <h2 class="text-lg font-semibold">No pages registered</h2>
                <p class="mt-2 text-sm leading-7 text-slate-600">Add a page to <code class="break-all">app/Config/Development.php</code> to create its directory entry and build sheet.</p>
            </div>
        <?php else: ?>
            <div class="mt-8 grid items-start gap-6 md:grid-cols-2">
                <?php foreach ($development->pages as $slug => $entry): ?>
                    <article class="min-w-0 rounded-xl border border-slate-200 bg-white p-6">
                        <div class="flex flex-wrap items-start justify-between gap-3">
                            <h2 class="text-xl font-semibold tracking-tight"><?= esc($entry['name']) ?></h2>
                            <span class="break-all font-mono text-xs text-slate-500"><?= esc($entry['path']) ?></span>
                        </div>
                        <p class="mt-3 text-sm leading-7 text-slate-600"><?= esc($entry['description']) ?></p>
                        <div class="my-6 border-y border-slate-100 py-5">
                            <?= component('partials/dev/milestones', ['milestones' => [
                                'Design received' => $entry['designReceivedAt'] ?? null,
                                'Development started' => $entry['developmentStartedAt'] ?? null,
                                'Design updated' => $entry['designUpdatedAt'] ?? null,
                            ]]) ?>
                        </div>
                        <div class="flex flex-wrap gap-3">
                            <?= component('Components/ui/button', ['href' => $entry['path'], 'text' => 'Open ' . $entry['name']]) ?>
                            <?= component('Components/ui/button', ['href' => '/dev-progress/' . $slug, 'text' => $entry['name'] . ' build sheet', 'variant' => 'outline']) ?>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <p class="mt-8 text-sm leading-7 text-slate-500">Manage pages and milestones in <code class="break-all">app/Config/Development.php</code>. Setup and tracking examples are in <code>docs/development.md</code>.</p>
    </div>
</section>
