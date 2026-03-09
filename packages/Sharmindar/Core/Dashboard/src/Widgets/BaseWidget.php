<?php

namespace Sharmindar\Core\Dashboard\Widgets;

use Illuminate\Contracts\Support\Renderable;

abstract class BaseWidget implements Renderable
{
    /**
     * Unique identifier for the widget.
     *
     * @return string
     */
    abstract public function getId(): string;

    /**
     * Display name of the widget.
     *
     * @return string
     */
    abstract public function getName(): string;

    /**
     * Type of widget (e.g., card, pie_chart, bar_chart, table).
     *
     * @return string
     */
    abstract public function getType(): string;

    /**
     * The sort order for the dashboard layout (lower appears first).
     *
     * @return int
     */
    public function getSortOrder(): int
    {
        return 100;
    }

    /**
     * The width of the widget on the grid.
     * Options: 'full', 'half', 'quarter', 'third'
     *
     * @return string
     */
    public function getWidth(): string
    {
        return 'half';
    }

    /**
     * The specific permissions or roles required to view this widget.
     * If empty, it's accessible by all authenticated admin users.
     * Example: ['dashboard.sales.view'] or ['role:administrator']
     *
     * @return array
     */
    public function getRequiredPermissions(): array
    {
        return [];
    }

    /**
     * Check if the currently authenticated user can view this widget.
     *
     * @return bool
     */
    public function canAccess(): bool
    {
        $permissions = $this->getRequiredPermissions();

        if (empty($permissions)) {
            return true;
        }

        // Bouncer specific logic for Webkul CRM
        foreach ($permissions as $permission) {
            if (bouncer()->hasPermission($permission)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Render the widget's HTML or blade component.
     * Must be implemented by the specific widget class.
     *
     * @return string
     */
    abstract public function render();
}
