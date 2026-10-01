<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

/**
 * Development inventory. Record real milestones and availability, not QA dates.
 * See docs/development.md for page, section, reference, and gallery schemas.
 */
class Development extends BaseConfig
{
    public string $projectName = 'CI4 Starter';

    public ?string $projectStartedAt = null;

    /** Pages keyed by a stable URL-safe slug. Adding an entry exposes its build sheet. */
    public array $pages = [
        'home' => [
            'name' => 'Home',
            'path' => '/',
            'description' => 'The public starter page. Add sections as the site takes shape.',
            'source' => 'app/Views/pages/home.php',
            'designReceivedAt' => null,
            'developmentStartedAt' => null,
            'designUpdatedAt' => null,
            'figma' => [],
            'sections' => [],
        ],
    ];

    /** Shared references are shown separately and do not inflate section totals. */
    public array $sharedElements = [
        [
            'label' => 'Navigation',
            'description' => 'Shared public header; currently starter markup.',
            'source' => 'app/Views/partials/navbar.php',
            'figma' => [],
        ],
        [
            'label' => 'Footer',
            'description' => 'Shared public footer; currently starter markup.',
            'source' => 'app/Views/partials/footer.php',
            'figma' => [],
        ],
    ];

    /** Every preview renders a real component with isolated props. */
    public array $gallery = [
        [
            'name' => 'Buttons',
            'view' => 'Components/ui/button',
            'description' => 'Navigation links and action buttons, including disabled states.',
            'examples' => [
                ['label' => 'Primary link', 'props' => ['text' => 'Open home', 'href' => '/']],
                ['label' => 'Secondary action', 'props' => ['text' => 'Preview action', 'variant' => 'secondary']],
                ['label' => 'Outline link', 'props' => ['text' => 'View build sheet', 'href' => '/dev-progress/home', 'variant' => 'outline']],
                ['label' => 'Disabled action', 'props' => ['text' => 'Unavailable', 'disabled' => true]],
            ],
        ],
        [
            'name' => 'Headings',
            'view' => 'Components/ui/title',
            'description' => 'Semantic headings with an optional supporting description.',
            'examples' => [
                ['label' => 'Heading', 'props' => ['text' => 'Section heading', 'tag' => 'h3']],
                ['label' => 'Heading with description', 'props' => ['text' => 'A longer heading that can wrap naturally', 'tag' => 'h3', 'description' => 'Supporting text stays in normal document flow.']],
            ],
        ],
        [
            'name' => 'Cards',
            'view' => 'Components/ui/card',
            'description' => 'Content-sized cards with an optional navigation action.',
            'examples' => [
                ['label' => 'Content', 'props' => ['title' => 'Content card', 'text' => 'Replace this example with content from your project.']],
                ['label' => 'With action', 'props' => ['title' => 'Home page', 'text' => 'An example of a card with a real destination.', 'href' => '/', 'actionText' => 'Open home']],
            ],
        ],
    ];
}
