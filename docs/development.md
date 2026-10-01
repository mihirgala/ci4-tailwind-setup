# Development workspace

The template includes a generalized page directory, component gallery, and build sheets. They are available only with `CI_ENVIRONMENT=development`.

## Start locally

Install dependencies, copy `.env.example` to `.env` if needed, and use the documented development settings. Do not overwrite an existing `.env` when starting work on an established project.

```sh
composer install
pnpm install
```

Run in separate terminals:

```sh
pnpm dev
php spark serve
```

The default URL is `http://localhost:8080`. Set `app.baseURL` to the actual URL if using another host, port, or path; development links and CSS URLs use CodeIgniter URL helpers. Respect the project's `app.indexPage` and rewrite configuration.

| Route | Purpose |
| --- | --- |
| `/dev` | Public pages, recorded milestones, gallery, and build-sheet links |
| `/dev-design-components` | Component examples and variants |
| `/dev-progress/<slug>` | Build sheet for any page registered in configuration |
| `/dev-landing-progress` | Shortcut to `/dev-progress/home` |

The route registration is scoped to development in `app/Config/Routes.php`. `DevPages` also rejects requests outside development. An unregistered page slug returns 404.

## One inventory

Edit `app/Config/Development.php`. It owns:

- `projectName`: development-workspace identity, not public branding.
- `projectStartedAt`: known ISO milestone date or `null`.
- `pages`: pages keyed by stable URL-safe slugs.
- `sharedElements`: shared partial sources and design references, excluded from section totals.
- `gallery`: actual component views and example props; see `docs/components.md`.

The starter registers the existing home page with empty section/reference lists and unknown dates. It does not fabricate project progress. Lists can be empty, and section counts are unlimited.

## Register a page

Add an entry to `pages` after creating its real route, controller, and page view:

```php
'about' => [
    'name' => 'About',
    'path' => '/about',
    'description' => 'Introduction and team information.',
    'source' => 'app/Views/pages/about.php',
    'designReceivedAt' => null,
    'developmentStartedAt' => null,
    'designUpdatedAt' => null,
    'figma' => [],
    'sections' => [
        [
            'name' => 'Introduction',
            'assembled' => false,
            'items' => [
                ['label' => 'Heading component', 'ready' => 1, 'total' => 1],
                ['label' => 'Introduction illustration', 'ready' => 0, 'total' => 1],
            ],
            'figma' => [],
        ],
    ],
],
```

This automatically adds a directory entry and `/dev-progress/about`. Registration does **not** create the public page. Paths must point to real public routes; source paths document the page whose assembly will be checked.

`name`, `path`, `description`, `source`, and `sections` are required page fields. Dates and `figma` can be omitted, although keeping the explicit empty fields makes tracking easier. Each section requires `name`, `assembled`, and `items`; its `figma` list is optional.

## Readiness versus assembly

- Item counts are integers satisfying `0 <= ready <= total`.
- `ready` counts actual usable components/assets, not placeholder availability.
- `total` counts the required pieces for that item; define requirements consistently.
- Aggregate readiness sums the items in the page's sections. Shared elements are shown separately.
- `assembled` means the finished section is included in the page's configured source and works on the public route.
- An available component or gallery example does not establish public assembly.
- Empty sections/items indicate unscoped work; a zero total does not mean 100% complete.

Inspect real files and assets before updating counts or status. Add sections as the project needs them; there is no fixed landing-section count.

## Track design references

Add labeled references to a page, section, or shared element's `figma` list:

```php
'figma' => [
    ['label' => 'Introduction — desktop', 'url' => '<actual supplied Figma node URL>'],
    ['label' => 'Introduction — mobile', 'url' => '<actual supplied Figma node URL>'],
],
```

Replace the placeholders with actual supplied URLs before adding references to configuration. Record every supplied or used node and distinguish desktop, mobile, component, and interaction-state references. Preserve earlier links as new designs arrive. Whole-page nodes belong at page level; global navigation/footer nodes belong in `sharedElements`.

## Milestone dates

Dates use `YYYY-MM-DD` or `null`. Unknown dates display as **Not recorded**.

- Set design-received/design-updated only from confirmed instructions.
- Set development-started/project-started only when the actual dates are known.
- Do not fill dates from the current clock or change them during QA.

## Verify and deploy

Lint changed PHP and run `pnpm build` for Tailwind source/class changes. Follow `.opencode/skills/responsive-qa/SKILL.md` for layout verification. Check directory links, gallery variants, progress rows/totals, empty states, references, unknown-slug 404s, and actual public assembly.

In production, set `CI_ENVIRONMENT=production` and point the document root to `public/`. Development routes must return 404. A production environment has no development route registration; controller guards provide a second check if routing changes later.

## Agent guidance

`AGENTS.md` maps tasks to five project-local skills under `.opencode/skills/`. They describe view architecture, responsive implementation, Figma translation, tracking, and responsive QA. The guidance is project-neutral: customize it as a new project develops confirmed requirements. Restart OpenCode after changing skills so discovery picks up the new files.
