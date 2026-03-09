<?php

namespace Sharmindar\Core\Dashboard\Managers;

use Sharmindar\Core\Dashboard\Widgets\BaseWidget;
use Illuminate\Support\Collection;

class DashboardManager
{
    /**
     * All registered widgets.
     *
     * @var \Illuminate\Support\Collection
     */
    protected $widgets;

    public function __construct()
    {
        $this->widgets = new Collection();
    }

    /**
     * Register a new widget into the engine.
     *
     * @param string|BaseWidget $widgetClass
     * @return void
     */
    public function registerWidget($widgetClass)
    {
        // Resolve the class if a string name was passed
        $widget = is_string($widgetClass) ? app($widgetClass) : $widgetClass;

        if ($widget instanceof BaseWidget) {
            $this->widgets->put($widget->getId(), $widget);
        }
    }

    /**
     * Retrieve all widgets the current user has access to, correctly sorted.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getAvailableWidgets(): Collection
    {
        return $this->widgets
            ->filter(function (BaseWidget $widget) {
            return $widget->canAccess();
        })
            ->sortBy(function (BaseWidget $widget) {
            return $widget->getSortOrder();
        });
    }
}
