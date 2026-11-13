---
name: ci4-view-development
description: Use when creating or editing CodeIgniter PHP views, sections, partials, reusable UI components, forms, navigation, or view-owned CSS and JavaScript. Covers architecture, isolated props, semantics, and interactive states.
---

# CodeIgniter View Development

Repository paths are relative to the project root. Load `responsive-layout` for layout changes, `responsive-qa` for verification, and `figma-design-to-code` for Figma implementation.

## Inspect before implementing

1. Read affected views, callers, controllers, and relevant assets.
2. Read `docs/components.md` and `app/Helpers/component_helper.php` before duplicating UI.
3. Inspect `app/Views/components/` and variants at `/dev-design-components` in development.
4. Reuse `component('components/…', $props)`. This helper uses a fresh renderer so component props cannot overwrite page/layout data or inherit unintended page variables.
5. Match existing names and path casing; a Windows-only casing mismatch can fail on Linux.

## View ownership

| Path | Responsibility |
| --- | --- |
| `app/Views/layouts/main.php` | HTML document, metadata, global includes, common wrappers |
| `app/Views/pages/` | Page composition |
| `app/Views/sections/<page>/` | Meaningful page-level visual blocks |
| `app/Views/partials/` | Shared navigation, footer, and other shared markup |
| `app/Views/components/` | Reusable prop-driven pieces |

Compose sections with `$this->include('sections/…')`. Do not put page-specific markup into a global layout or implement a large page as one monolithic view. The layout owns `<main>`; do not nest another main element in a page.

Finished sections must be included in the actual public page. Gallery availability alone is not assembly. Render repeated navigation, cards, testimonials, FAQs, links, badges, and statistics from PHP arrays with `foreach`.

## Components and output

- Document props, defaults, allowed variants, and meaningful examples in `docs/components.md`.
- Add gallery examples in `app/Config/Development.php`; preview real views rather than duplicate demo markup.
- Escape text with `esc()` and attributes with `esc($value, 'attr')`. Restrict dynamic tag names to an explicit allowlist.
- Use `site_url()` for internal routes and `base_url()` for published assets so deployments under a subdirectory work.
- Escape plain content by default. Allow raw markup only through an intentional, documented trusted-HTML prop.
- If a component changes, inspect its callers and verify both gallery variants and public usage.

## Styles and scripts

- Tailwind utilities first. Do not write vanilla CSS for layout, spacing, color, typography, or states. Arbitrary values need a genuine design-specific reason; prefer `@theme` tokens.
- Edit `assets/css/input.css`, not generated `public/css/output.css`. Run `pnpm build` after CSS or class changes.
- Keep theme variables and genuinely shared styles in global CSS. A view-owned `<style>` block is a last resort for things utilities cannot do (keyframes, third-party markup).
- Shared JavaScript lives in `public/js/script.js` (the starter has no JS bundler); include it with `base_url('js/script.js')`. Do not link directly to `assets/`.
- Small page-specific scripts belong in the owning view. Initialize repeated components safely and avoid duplicate listeners or global variable collisions.
- Prefer vanilla JavaScript, and do not add an animation library merely because the template could support one.

## Semantic and accessible UI

- Use appropriate landmarks, headings, paragraphs, lists, figures, and section labels.
- Use `<a>` for navigation and `<button>` for actions. Set action buttons to `type="button"` unless they submit/reset a form.
- Informative images need meaningful alt text; decorative images need `alt=""`.
- Controls need labels; placeholders are not labels. Expose validation and errors clearly.
- Keep contrast, keyboard access, visible focus, and hover/active/disabled states. State changes should not shift nearby content.
- Derive navigation active states from the current route. Mobile menus must expose open/closed state and support keyboard use.
- Use subtle, purposeful transitions and respect reduced-motion preferences when adding animation.

## Finish

Lint changed PHP and build Tailwind. Check interactions, keyboard access, and console/asset loading; use the full responsive QA matrix for layout changes. Update `development-tracking` when references, component availability, or section assembly changes.
