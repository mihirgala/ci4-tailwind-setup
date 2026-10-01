# Reusable components

Components live in `app/Views/Components/` and render through `component()` from `app/Helpers/component_helper.php`. `BaseController` loads the helper. Each call uses a fresh renderer: page variables do not leak into props and props do not overwrite page/layout variables.

```php
<?= component('Components/ui/button', [
    'text' => 'Open home',
    'href' => '/',
    'variant' => 'outline',
]) ?>
```

Text and attribute values are escaped. These starter components do not accept raw HTML props. Match view path casing exactly, especially on Linux.

## Button — `Components/ui/button`

| Prop | Default | Meaning |
| --- | --- | --- |
| `text` | `Continue` | Visible text |
| `variant` | `primary` | `primary`, `secondary`, or `outline`; unknown variants fall back to primary |
| `href` | Unset | Internal route passed to `site_url()`; renders a link when enabled |
| `buttonType` | `button` | `button`, `submit`, or `reset`; only applies to button elements |
| `disabled` | `false` | Renders a native disabled button, including when a destination is supplied |

Buttons without `href` represent actions. Their caller owns the action handler; the gallery demonstrates styling, not application behavior. Use submit/reset types only inside the appropriate form. For external navigation, add a dedicated, documented external-link component rather than passing external URLs to this internal-route prop.

## Heading — `Components/ui/title`

| Prop | Default | Meaning |
| --- | --- | --- |
| `text` | `Section heading` | Heading text |
| `tag` | `h2` | Allowlisted `h1`–`h6`; choose the correct semantic level |
| `id` | Unset | Optional heading ID for section labeling |
| `description` | Unset | Supporting paragraph |

```php
<section aria-labelledby="features-title">
    <?= component('Components/ui/title', [
        'id' => 'features-title',
        'text' => 'Features',
        'description' => 'Supporting information for this section.',
    ]) ?>
</section>
```

## Card — `Components/ui/card`

| Prop | Default | Meaning |
| --- | --- | --- |
| `title` | `Card title` | `h3` heading text |
| `text` | `Supporting content.` | Plain supporting paragraph |
| `href` | Unset | Optional internal-route action |
| `actionText` | `Learn more` | Action text; prefer a specific destination label |

Cards size naturally to content. Their caller owns grid layout. Use them below an `h2` section heading or adapt the component heading API when another context requires it.

## Add a component

1. Inspect existing components and `/dev-design-components` first.
2. Create a prop-driven view under `app/Views/Components/` with safe defaults, escaping, and semantic markup.
3. Add a gallery group to `app/Config/Development.php`:

```php
[
    'name' => 'Feature card',
    'view' => 'Components/ui/card',
    'description' => 'Shared feature presentation.',
    'examples' => [
        [
            'label' => 'Default',
            'props' => ['title' => 'Example feature', 'text' => 'Example supporting text.'],
        ],
    ],
],
```

4. Document props and variants here. Include long-text, disabled, or alternate-state examples where relevant.
5. Lint PHP, build Tailwind, and check gallery examples and actual public callers.

The gallery uses real component views with isolated props. It does not imply that a public page section has been assembled or that project-specific design assets are ready.
