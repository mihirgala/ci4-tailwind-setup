---
name: responsive-qa
description: Use when verifying responsive layouts or visual regressions on CodeIgniter public pages and development previews. Covers viewport screenshots, short-screen checks, interactions, component galleries, and progress verification.
---

# Responsive QA

Follow this runbook for responsive changes in the CodeIgniter 4 / Tailwind starter. Repository paths are relative to the project root. Load `responsive-layout` for implementation rules. Read `docs/components.md` and `docs/development.md` for component and tracking conventions.

## Principles

- Measure CSS viewport pixels (`window.innerWidth` × `window.innerHeight`), not physical device resolutions.
- Test width and height independently. Short laptop/tablet screens can fail while taller screens at the same width pass.
- Prevent unintended horizontal scrolling: `document.documentElement.scrollWidth <= window.innerWidth`.
- Fix defects through normal flow, flex/grid, fluid sizing, and sensible containers rather than coordinates or device-specific breakpoint patches.
- For regressions, compare the same route, viewport, browser, fonts, and state before/after. Investigate unintended differences without treating intentional edits as failures.

## Full viewport matrix

| Tier | CSS viewport sizes | Focus |
| --- | --- | --- |
| Small mobile | 360 × 800, 375 × 812 | Wrapping, tap targets, gutters |
| Standard mobile | 390 × 844, 414 × 896 | Navigation, stacking, spacing |
| Tablet portrait | 768 × 1024 | Grid collapse, card widths |
| Tablet landscape / small laptop | 1280 × 720 | Short-screen composition |
| Desktop | 1366 × 768, 1440 × 900, 1536 × 864 | Containers, whitespace, typography |
| Large desktop | 1920 × 1080 | Centering and background stretch |

Use the full matrix for final responsive review. Add the reported problem viewport, an intermediate width, and actual Figma dimensions when relevant. Include explicit short/tall checks such as 390 × 600, 844 × 390, and 1440 × 600 versus 1440 × 1200.

## Routes and sources

Run the server with `CI_ENVIRONMENT=development`, for example:

```powershell
$env:CI_ENVIRONMENT = 'development'
php spark serve --port 8080
```

Confirm the actual URL before capture. Run `pnpm dev` while editing and `pnpm build` for the final CSS build.

| Route | Sources / checks |
| --- | --- |
| Affected public route | Its controller, page view, actual included sections, and assets |
| `/dev` | `sections/dev-pages/directory.php`, configured links, recorded dates |
| `/dev-design-components` | `sections/dev-design-components/gallery.php`, real component variants |
| `/dev-progress/<slug>` | `sections/dev-progress/overview.php`, counts, assembly, references |
| `/dev-landing-progress` | Alias to the `home` sheet |

`app/Config/Development.php` owns inventory and tracking. The number of sections is variable. Read real public sources before accepting an assembly claim. Unknown dates remain unset; QA must not change milestones.

## Capture and comparison

1. Identify affected routes and source files.
2. For a visual regression, capture representative before views at 390 × 844, 768 × 1024, 1280 × 720, and 1440 × 900, plus the problem viewport.
3. Use available browser automation or DevTools. Keep browser, fonts, state, and viewport consistent. Store screenshots in an approved temporary location outside the repository.
4. Apply the smallest resilient fix and build CSS if needed.
5. Capture comparable after views and inspect meaningful changes side by side.
6. Run the complete matrix, scroll the whole page, and test interactions. Gallery screenshots do not prove public assembly.

If a browser tool is unavailable, record the blocked visual checks accurately. Do not claim screenshots, keyboard checks, or console checks that were not performed.

## Full-page checklist

### Layout and overflow

- In each viewport, verify `document.documentElement.scrollWidth > window.innerWidth` returns `false`.
- Containers stay centered with balanced outer gutters; flex/grid children can shrink and long text wraps.
- No important content is clipped by `overflow: hidden`.
- Scroll to the bottom; inspect every section, not just the hero.

### Height and content flexibility

- Check short screens, landscape devices, and tall viewports.
- Headers and fixed controls do not monopolize the reading area.
- Menus, dialogs, and sheets remain accessible and scrollable.
- Viewport-sized sections allow content to grow; do not depend on fixed `100vh`.
- Headings, long strings, and multiline buttons remain readable and usable. Check zoom when relevant.

### Interactions and accessibility

- Tab and Shift+Tab reveal visible focus in a sensible order; skip links reach content.
- Mobile menus expose state, open/close correctly, and manage focus when required.
- Hover/focus/active/disabled states do not shift adjacent content.
- Forms have labels and useful error states. Informative/decorative images have appropriate alt text.
- Check motion behavior when animations are introduced, including reduced-motion settings.
- Follow directory and gallery links; inspect external reference labels/targets.

### Tracking and code health

- Check every configured section row and aggregate totals, including empty/zero states.
- Compare readiness with actual components/assets and assembly with the public source view.
- Check page, section, and shared references. Unknown slugs should return 404.
- Lint changed PHP, build Tailwind, and inspect compiled styling in the browser.
- Check console exceptions, failed requests, and missing assets.
- For routing changes, confirm `/dev*` endpoints return 404 outside development.

## Completion report

Report routes and sizes actually checked, before/after findings when applicable, build/lint results, tracking verification, and any blockers. A responsive audit should not alter dates or mark unfinished sections complete.
