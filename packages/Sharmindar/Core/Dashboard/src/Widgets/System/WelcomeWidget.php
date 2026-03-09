<?php

namespace Sharmindar\Core\Dashboard\Widgets\System;

use Sharmindar\Core\Dashboard\Widgets\BaseWidget;
use Illuminate\Support\Facades\View;

class WelcomeWidget extends BaseWidget
{
    public function getId(): string
    {
        return 'system.welcome';
    }

    public function getName(): string
    {
        return 'Welcome Information';
    }

    public function getType(): string
    {
        return 'card';
    }

    public function getSortOrder(): int
    {
        return 10;
    }

    public function getWidth(): string
    {
        return 'half';
    }

    public function render()
    {
        // For testing, we simulate passing data directly into our generic engine component
        return View::make('company_dashboard::components.widget.card', [
            'title' => 'System Status',
            'value' => 'All Systems Operational',
            'icon' => 'icon-dashboard',
            'color' => 'brandColor',
            'footer' => 'Dynamic Engine Integration Successful'
        ])->render();
    }
}
