<?php

namespace App\Controllers;

use CodeIgniter\Exceptions\PageNotFoundException;
use Config\Development;

class DevPages extends BaseController
{
    public function index(): string
    {
        $this->requireDevelopment();

        return view('pages/dev-pages', $this->viewData('Page directory', 'directory'));
    }

    public function components(): string
    {
        $this->requireDevelopment();

        return view('pages/dev-design-components', $this->viewData('Component gallery', 'components'));
    }

    public function progress(string $slug): string
    {
        $this->requireDevelopment();
        $data = $this->viewData('Page progress', 'progress');
        $page = $data['development']->pages[$slug] ?? null;

        if ($page === null) {
            throw PageNotFoundException::forPageNotFound();
        }

        $sections = $page['sections'];
        $ready = 0;
        $total = 0;
        $assembled = 0;

        foreach ($sections as $section) {
            $ready += array_sum(array_column($section['items'], 'ready'));
            $total += array_sum(array_column($section['items'], 'total'));
            $assembled += (int) $section['assembled'];
        }

        return view('pages/dev-progress', array_merge($data, [
            'title' => $page['name'] . ' progress',
            'page' => $page,
            'ready' => $ready,
            'total' => $total,
            'assembled' => $assembled,
        ]));
    }

    protected function requireDevelopment(): void
    {
        if (ENVIRONMENT !== 'development') {
            throw PageNotFoundException::forPageNotFound();
        }
    }

    protected function viewData(string $title, string $activeDevPage): array
    {
        $development = config(Development::class);

        return [
            'title' => $title,
            'appName' => $development->projectName,
            'description' => 'Development directory, component previews, and implementation tracking.',
            'showSiteChrome' => false,
            'activeDevPage' => $activeDevPage,
            'development' => $development,
        ];
    }
}
