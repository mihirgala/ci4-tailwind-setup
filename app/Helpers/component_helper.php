<?php

use Config\Services;

if (! function_exists('component')) {
    /** Render a view with isolated props so neither page nor component data leaks. */
    function component(string $name, array $data = []): string
    {
        return Services::renderer(null, null, false)
            ->setData($data, 'raw')
            ->render($name, [], false);
    }
}
