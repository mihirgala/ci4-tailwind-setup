# ci4-tailwind-setup

A reusable **CodeIgniter 4 / PHP 8.2+ / Tailwind CSS 4** starter with modular PHP views, a development workspace, and project-neutral agent skills. Uses vanilla JavaScript when needed; no frontend framework or animation library is required.

## Quick start

```sh
git clone https://github.com/mihirgala/ci4-tailwind-setup.git
cd ci4-tailwind-setup
composer install
pnpm install
```

Create `.env` (skips if one exists):

```sh
pnpm setup
```

Or copy it manually:

```powershell
Copy-Item .env.example .env
```

On macOS/Linux, use `cp .env.example .env`. The example enables local development and sets `app.baseURL` to `http://localhost:8080/`. Adjust the URL for your host/port. Set `CI_ENVIRONMENT=production` when deploying.

Open two terminals:

```sh
# Terminal 1: Tailwind watcher
pnpm dev

# Terminal 2: PHP development server
php spark serve
```

Visit **http://localhost:8080/dev** to open the development workspace. Existing `.env` files need `CI_ENVIRONMENT=development` to enable it. `npm install`, `npm run dev`, and `npm run build` also work; pnpm is the lockfile-backed default.

## Development workspace

| Route | Purpose |
| --- | --- |
| `/` | Public starter page |
| `/dev` | Page directory and recorded milestone dates |
| `/dev-design-components` | Reusable component previews and variants |
| `/dev-progress/<slug>` | Configured page's section readiness, assembly, and design references |
| `/dev-landing-progress` | Shortcut to the home-page build sheet |

Edit **`app/Config/Development.php`** to register pages, sections, references, milestone dates, and gallery examples. The starter contains only home with empty progress data and unset dates. It supports any number of pages/sections and keeps component readiness separate from public-page assembly.

Development routes are registered only in development and guarded in their controller. They return 404 in production. See [the development guide](docs/development.md) for configuration examples.

## Project structure

```text
.
├── .agents/skills/            # Five agent skills (canonical source)
├── .claude/skills/            # Generated mirror for Claude Code (pnpm skills:sync)
├── CLAUDE.md, GEMINI.md      # Import AGENTS.md for tools that read their own file
├── AGENTS.md                 # Agent conventions and skill selection
├── app/
│   ├── Config/Development.php # Development inventory and tracking
│   ├── Controllers/          # Public and development controllers
│   ├── Helpers/              # Isolated component renderer
│   └── Views/
│       ├── layouts/main.php  # Document structure and global includes
│       ├── pages/            # Page composition
│       ├── sections/<page>/  # Page-level visual blocks (home/hero.php example)
│       ├── partials/         # Shared navbar and footer
│       ├── components/ui/    # Prop-driven buttons, headings, cards
│       └── dev/              # Development workspace (delete when not needed)
├── assets/css/input.css      # Tailwind source and theme tokens
├── public/
│   ├── css/output.css        # Generated CSS (committed; server has no Node)
│   ├── js/                   # Shared JavaScript
│   └── images/               # Image assets
├── docs/
│   ├── components.md         # Props, reuse, gallery examples
│   └── development.md        # Workspace setup and tracking schema
├── package.json
└── composer.json
```

Compose pages from sections and partials; render repeated markup from PHP arrays. Reusable components use `component('components/…', $props)` with isolated data. Shared styles belong in Tailwind source; view-specific CSS/JS stays with its owning view. Global JavaScript goes in `public/js/script.js` (no bundler); images in `public/images/`.

## Agent skills

`AGENTS.md` links to skills for:

- CodeIgniter view/component development.
- Responsive layouts across widths and heights.
- Figma design-to-code translation.
- Development tracking and recorded milestones.
- Responsive QA, interactions, and build-sheet verification.

Skills are authored in `.agents/skills/` (Codex, OpenCode, Antigravity and others) and mirrored to `.claude/skills/` for Claude Code by `pnpm skills:sync`. `CLAUDE.md` and `GEMINI.md` import `AGENTS.md` because those tools do not read it themselves. Restart your agent after adding or editing skills. All guidance is generic and can be adapted to confirmed requirements in projects created from this template.

## Vendored framework

`system/` is the CodeIgniter 4 framework (currently 4.7.2), committed on purpose so a fresh clone runs without `composer install`. `composer update` does **not** upgrade it. To upgrade: download the new CodeIgniter 4 release, replace `system/` with its `system/` folder, review the release's upgrade notes for `app/Config/` changes, then run `pnpm check` and load `/` and `/dev`.

## Build and verification

```sh
pnpm build
php -l app/Config/Development.php
php spark routes
```

Build CSS whenever Tailwind source or view classes change. Lint changed PHP and check affected public routes plus relevant gallery/progress previews. Follow the responsive QA skill for the viewport matrix, full-page scrolling, keyboard access, interactions, and console/asset checks.

## Deployment

Point the web server document root to **`public/`**, configure the actual base URL and URL rewrites, install PHP dependencies, build CSS, and use `CI_ENVIRONMENT=production`. Development configuration, source files, skills, and documentation must remain outside the document root.

## License

See [LICENSE](LICENSE).
