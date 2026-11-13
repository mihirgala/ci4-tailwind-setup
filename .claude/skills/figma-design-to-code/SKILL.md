---
name: figma-design-to-code
description: Use when implementing or updating CodeIgniter pages, sections, or components from Figma designs or node URLs. Load before Figma get_design_context; covers reference interpretation, existing component reuse, assets, and development tracking.
---

# Figma Design to CodeIgniter

Load this guidance before calling `figma_get_design_context`. Repository paths are relative to the project root. Also load `ci4-view-development`, `responsive-layout`, and `development-tracking` for implementation and tracking work.

## Establish context

1. Identify the public route and affected views. Start at `/dev` and inspect `/dev-design-components` before creating another UI piece.
2. Read `docs/components.md`, existing components, callers, styles, and theme tokens. Adapt designs to PHP views, Tailwind CSS, and vanilla JavaScript.
3. Record every supplied/used node URL in `app/Config/Development.php`, preserving separate desktop, mobile, component, and state references.
4. Extract the node ID from the URL and request design context with its screenshot. Drill into relevant sections/components when a large node returns metadata.
5. Use screenshots, assets, content, and metadata to understand hierarchy, relationships, colors, typography, spacing, proportions, and interactions.

## Translate intent, not coordinates

- Never copy raw generated code literally. Remove excessive wrappers, redundant nesting/transforms, duplicate markup, unnecessary fixed dimensions, and structural absolute positioning.
- A Figma canvas is a visual reference, not a fixed page size or CSS breakpoint.
- Use normal flow, flex, and grid for important content. Pixel offsets are suspect unless they express a genuine layering requirement.
- Position decoration relative to its section with fluid sizing; content must remain usable if decoration is moved, resized, or hidden.
- A mobile node describes hierarchy and composition across nearby widths, not only its exact canvas dimensions. Desktop layouts must also tolerate small laptops, wide monitors, and short screens.
- Keep outer gutters separate from inner centered width constraints and preserve existing intentional containers.
- Preserve responsive behavior over exact screenshot coordinates. Verify the supplied dimensions plus the full `responsive-qa` matrix and short/tall checks.

## Assets

- Store published assets under `public/images/`, organized by page, section, or purpose, such as `home/`, `icons/`, and `common/`.
- Rename export hashes/frame names to meaningful lowercase kebab-case filenames, such as `hero-ribbon.svg` or `feature-illustration.webp`.
- Prefer SVG, WebP, or AVIF when appropriate; optimize raster size and use responsive images where helpful.
- Use CSS backgrounds for ornamental backgrounds when appropriate and `<img>` for informative imagery.
- Decorative images use empty alt text. Decorative layers should be hidden from assistive technology and not intercept pointer events.
- Do not substitute placeholders or generic icons to claim pending design assets are ready. Report missing assets accurately.

## Completion

Compose the production section and include it in its public page. Lint PHP, build Tailwind, check shared variants in the gallery and public usage, and verify responsiveness. Record component/asset availability and assembly honestly. Gallery presence alone is not assembly; missing assets and verification blockers belong in the completion report.
