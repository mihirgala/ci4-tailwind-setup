---
name: responsive-layout
description: Use when creating or correcting responsive PHP and Tailwind layouts, containers, typography, heroes, decorations, breakpoints, or viewport-height behavior. Covers resilient width and height responsiveness.
---

# Responsive Layout

Repository paths are relative to the project root. Load `responsive-qa` before verification; for a regression, capture comparable before views before editing.

## Layout priorities

Preserve hierarchy and design intent using semantic HTML, natural flow, flex/grid, fluid sizing, maintainable utilities, and reusable components.

- Flex suits one-dimensional relationships; grid suits two-dimensional compositions; block flow suits text.
- Important content must not depend on absolute offsets, transforms, or decoration. Use absolute positioning for layered/ornamental elements relative to their section.
- Prefer padding, gaps, wrapping, `inline-flex`, and appropriate width/max-width constraints over rigid dimensions on text, buttons, cards, and navigation.
- Tolerate longer text, localization, font differences, zoom, and accessibility settings.
- Start with standard Tailwind utilities; a Figma coordinate alone does not justify an arbitrary value.

## Containers

Keep gutters on the outer wrapper and width/centering on the inner container:

```html
<section class="px-4 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-6xl">
        <!-- Flow-based content -->
    </div>
</section>
```

Inspect existing intentional container behavior before editing. Do not accidentally narrow usable width or change text wrapping through duplicated padding. Use `min-w-0` and appropriate wrapping on flex/grid children containing long text.

`overflow-hidden` is appropriate for deliberate decorative clipping, not masking a layout defect or hiding important content.

## Fluid values and breakpoints

- Scale headings and display values with responsive utilities or purposeful `clamp()` values.
- Fluid spacing and image sizing may help, but do not apply `clamp()` to everything automatically.
- Choose breakpoints where the composition genuinely changes, starting with the standard Tailwind breakpoints. Avoid device-specific patches.
- Mobile designs may change stacking, alignment, controls, navigation, and decoration. Interpolate gracefully between mobile and desktop canvases.
- Avoid fixed page/canvas sizes; designs must work at intermediate widths and wider monitors.

## Height responsiveness

- Prefer `min-height` and natural content growth to fixed heights.
- Do not force every hero to fill a viewport. For intentional viewport sizing, prefer `svh` for stable mobile minimums and `dvh` when dynamic visible height is intentional.
- Avoid generic fixed `100vh`; allow long content to scroll rather than clip.
- Short screens are distinct from narrow screens. Test browser chrome, laptop heights, and landscape devices.
- Height-based queries may reduce spacing or optional decoration; do not reconstruct the layout for each device.
- Use safe-area insets where UI touches device edges, especially fixed controls and bottom sheets.

## Decorations and layers

Position ornamental images, shapes, ribbons, overlays, and gradients relative to their containing section. Use viewport-fixed positioning only for a real viewport-fixed requirement.

Decorative layers should use `aria-hidden="true"`, `pointer-events-none`, and empty image alt text. Scale them fluidly; reduce or hide optional decoration before compromising primary content.

Use a small predictable z-index scale and inspect stacking contexts before adding larger values. Content must remain usable when a decoration is removed or hidden.

## Diagnose before adding a breakpoint

1. Is structural content in normal flow? Fix flow first.
2. Is fixed width causing the issue? Use appropriate width/max-width constraints.
3. Is fixed spacing causing it? Use gaps, padding, wrapping, or fluid sizing.
4. Is absolute decoration attached to the wrong containing block? Fix its parent.
5. Is height the actual constraint? Allow scroll/growth and consider a height query.
6. Is the element optional decoration? Resize, reposition, or hide it.

Preserve headings, primary content, and usable actions before decoration. Verify narrow/wide and short/tall viewports, full-page scrolling, wrapping, keyboard access, interactions, and console/asset errors with `responsive-qa`.
