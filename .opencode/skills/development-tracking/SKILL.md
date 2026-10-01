---
name: development-tracking
description: Use when receiving or using Figma node references, assembling page sections, recording component or asset readiness, or editing development pages, build sheets, galleries, and milestone dates. Covers tracking for every configured page.
---

# Development Tracking

Repository paths are relative to the project root. Development pages support implementation and are not public-site content. Keep routes scoped to development in `app/Config/Routes.php` and retain controller guards in `app/Controllers/DevPages.php`.

## Entry points and sources

| Route | Purpose |
| --- | --- |
| `/dev` | Public-page directory and links to development tools |
| `/dev-design-components` | Real reusable component views and example props |
| `/dev-progress/<slug>` | Configured page's section readiness, assembly, and references |
| `/dev-landing-progress` | Shortcut to the `home` build sheet |

Data lives in `app/Config/Development.php`. Views live under `app/Views/pages/dev-*`, `app/Views/sections/dev-*`, and `app/Views/partials/dev/`. Read `docs/development.md` for the configuration schema and `docs/components.md` before duplicating UI.

## Register pages and gallery entries

- Each page uses a unique URL-safe slug, a real public path, a source view, a description, milestone fields, page references, and sections.
- Registration creates a directory entry and build sheet; it does not create the public route/controller/view. Create those separately and verify the link.
- Preserve existing entries. Do not replace the inventory when adding a page.
- Add reusable component examples to `gallery` with the actual view and isolated props. A preview is an example, not evidence of public assembly.

## Design references for every page

- Record every Figma node URL supplied or used, including designs for non-home pages.
- Whole-page references belong in the page's `figma` list; section references belong in that section's `figma` list; shared navigation/footer references belong in `sharedElements`.
- Preserve separate desktop, mobile, component, and interaction-state nodes with descriptive labels.
- Append new references without erasing historical ones; avoid duplicate identical label/URL pairs.
- Make references reachable from `/dev` through the appropriate page build sheet.

## Readiness and assembly

Inspect real source views, assets, and component implementations before reporting status.

- Every section has a name, `items`, `assembled`, and optional `figma` references.
- Each item has a label and integer counts satisfying `0 <= ready <= total`.
- Adjust counts only when the required pieces actually exist and are usable. Generic icons, placeholder images, or unrelated assets do not establish design readiness.
- Requirements should describe the work for that section consistently; shared elements are shown separately from section totals.
- Set `assembled` only after the finished section is included in its configured public source view and works on the public route.
- Empty sections/items mean unscoped work, not completion. Do not invent section counts to fill the dashboard.

## Milestones

Project/page dates are recorded milestones in ISO `YYYY-MM-DD` format, not session or QA timestamps.

- Keep unknown dates `null` and show them as not recorded.
- Change design-received/design-updated dates only on explicit request.
- Set development-started and project-start dates only when the actual dates are known.
- Never infer a milestone from the current clock or from the date a tracking entry was added.

## Verify

Lint PHP, build Tailwind for view-class changes, and check directory links, gallery variants, all configured section rows, aggregate totals, assembly claims, and page/section/shared references. Check empty states and unknown-slug 404s. Confirm development tools remain unavailable outside development. Load `responsive-qa` for development-view layout changes.
