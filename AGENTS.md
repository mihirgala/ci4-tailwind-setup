# CodeIgniter 4 / Tailwind Starter Guidelines

## Project and priorities

- Framework: CodeIgniter 4; templating: PHP views; styling: Tailwind CSS 4.
- Prefer vanilla JavaScript and CSS. Add a library only for a concrete requirement.
- Preserve design hierarchy and interactions while adapting naturally across viewport widths and heights.
- Prioritize semantic HTML, natural flow, flex/grid, reuse, accessibility, maintainability, and performance.
- Figma is a design reference and asset/content source, not production code or a pixel-coordinate specification.

## Load task-specific skills

Skills live in `.opencode/skills/<name>/SKILL.md`. Load the matching skill before relevant work; if the skill tool cannot discover it, read its file directly. All repository paths in skills are relative to the project root.

| Task | Skill |
| --- | --- |
| Create/edit PHP views, sections, partials, components, forms, navigation, or view-owned CSS/JS | `ci4-view-development` |
| Translate Figma designs or fetch Figma design context | `figma-design-to-code`, **before calling `figma_get_design_context`** |
| Create/change containers, typography, heroes, decoration, breakpoints, or viewport sizing | `responsive-layout` |
| Receive/use Figma references, assemble sections, or change development pages, readiness, or milestones | `development-tracking` |
| Verify responsive changes or visual regressions | `responsive-qa` |

Load multiple skills when responsibilities overlap. For a Figma section, use the Figma, view, layout, tracking, and QA skills. For a visual regression, load QA before editing to capture comparable before views. Avoid unrelated skills.

## Architecture and reuse

| Path | Responsibility |
| --- | --- |
| `app/Views/layouts/main.php` | Document structure, metadata, global includes, common wrappers |
| `app/Views/pages/` | Compose page sections and partials |
| `app/Views/sections/<page>/` | Meaningful page-level visual blocks |
| `app/Views/partials/` | Shared UI such as navigation and footer |
| `app/Views/Components/` | Reusable prop-driven components |
| `app/Config/Development.php` | Development page inventory, milestones, references, gallery, and section progress |
| `assets/css/input.css` | Tailwind source, theme, genuinely shared styles |
| `public/css/output.css` | Generated CSS; build it rather than editing it |
| `assets/js/script.js` | Shared JavaScript source when needed; publish it under `public/` before including it |
| `public/images/` | Meaningfully named, logically organized image assets when needed |

Read `docs/components.md` and `app/Helpers/component_helper.php` before duplicating UI. Use `component('Components/…', $props)` for reusable pieces; its renderer isolates props from page data. Match path casing exactly for Linux deployments.

Make repeated markup data-driven with PHP arrays and `foreach`. Keep page-specific markup, styles, and behavior in their relevant views. Shared CSS belongs in `assets/css/input.css`; small view-owned `<style>` and `<script>` blocks belong with the view. Never expose source directories through the document root.

## Layout and interactions

- Use normal flow, flex, and grid for important content; section-relative absolute positioning is for decoration and layering.
- Prefer padding, gaps, wrapping, fluid sizing, and appropriate max-widths to unnecessary fixed dimensions.
- Separate outer section gutters from inner centered width constraints. Preserve existing intentional container behavior when editing.
- Fix overflow at its cause; do not hide layout bugs with clipping or device-specific breakpoint patches.
- Allow content to grow and scroll. For intentional viewport-sized sections, prefer `svh`/`dvh` minimum heights to fixed `100vh`.
- Use semantic links/buttons, labeled controls, meaningful informative-image alt text, empty decorative alt text, visible focus, sufficient contrast, and stable interaction states.
- Keep transitions purposeful and respect reduced-motion preferences when adding motion.
- Avoid unnecessary dependencies, wrappers, oversized assets, and repeated requests.

## Development workflow and tracking

- Start at `/dev`; inspect variants at `/dev-design-components`; inspect page build sheets at `/dev-progress/<slug>`. `/dev-landing-progress` points to the `home` build sheet.
- Keep `/dev*` routes development-only in `app/Config/Routes.php`, with controller environment guards.
- `app/Config/Development.php` is the single source of development inventory and tracking data. Read actual views/assets before reporting status.
- Track every supplied or used Figma node URL for every page in its page/section `figma` list or the appropriate shared element. Preserve separate desktop, mobile, component, and state references and earlier URLs.
- `ready`/`total` count actually available components/assets. Placeholder or unrelated assets do not establish readiness.
- Set `assembled` only after the finished section is included in its public page and works there. A gallery preview does not establish assembly.
- Milestones are recorded dates, not timestamps for the current session. Keep unknown dates `null`; change design-received/design-updated only on explicit request, and development-started only when the actual date is known.
- Register new public pages and reusable component examples so the development directory stays useful. See `docs/development.md` for schemas.

## Verification

- Lint changed PHP with `php -l <file>`.
- Run `pnpm build` for Tailwind source or view-class changes; `pnpm dev` watches styles. The npm script equivalents also work.
- Use `responsive-qa` for the full viewport matrix, short/tall checks, full-page scroll, keyboard/interaction checks, and console/asset errors.
- Check affected public routes and relevant development previews. Shared components require gallery-variant and actual public-usage checks; tracking changes require counts, references, empty states, and directory navigation checks.
- Confirm development routes return 404 outside development after routing/controller changes.
- Report checks actually performed and blockers accurately. Restart OpenCode after changing skills so future sessions discover the new guidance.

**Final principle: preserve design intent, not Figma coordinates.**
