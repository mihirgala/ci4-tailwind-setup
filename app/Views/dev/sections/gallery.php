<section class="flex-1 bg-slate-50 px-4 py-10 sm:px-6 lg:px-8 lg:py-14" aria-labelledby="gallery-title">
    <div class="mx-auto max-w-6xl">
        <header class="border-b border-slate-200 pb-8">
            <p class="font-mono text-xs uppercase tracking-widest text-blue-700">Reusable UI</p>
            <h1 id="gallery-title" class="mt-3 text-3xl font-semibold tracking-tight sm:text-4xl">Component gallery</h1>
            <p class="mt-4 max-w-2xl text-sm leading-7 text-slate-600">These previews render the actual component views with isolated props. Starter examples are not completed public-page sections.</p>
        </header>

        <?php if ($development->gallery === []): ?>
            <div class="mt-8 rounded-xl border border-dashed border-slate-300 p-8">
                <h2 class="text-lg font-semibold">No components registered</h2>
                <p class="mt-2 text-sm leading-7 text-slate-600">Add a view and example props to the gallery list in <code class="break-all">app/Config/Development.php</code>.</p>
            </div>
        <?php endif; ?>

        <?php foreach ($development->gallery as $index => $group): ?>
            <section class="mt-10" aria-labelledby="component-group-<?= $index ?>">
                <div class="flex flex-wrap items-baseline justify-between gap-3">
                    <h2 id="component-group-<?= $index ?>" class="text-xl font-semibold"><?= esc($group['name']) ?></h2>
                    <code class="break-all text-xs text-slate-500"><?= esc($group['view']) ?></code>
                </div>
                <p class="mt-2 text-sm leading-7 text-slate-600"><?= esc($group['description']) ?></p>
                <div class="mt-5 grid items-start gap-5 md:grid-cols-2">
                    <?php foreach ($group['examples'] as $example): ?>
                        <div class="min-w-0 rounded-xl border border-slate-200 bg-white p-5">
                            <p class="mb-5 border-b border-slate-100 pb-3 font-mono text-xs text-slate-500"><?= esc($example['label']) ?></p>
                            <?= component($group['view'], $example['props']) ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>
        <?php endforeach; ?>

        <p class="mt-10 text-sm text-slate-500">Component props and usage examples: <code>docs/components.md</code>.</p>
    </div>
</section>
