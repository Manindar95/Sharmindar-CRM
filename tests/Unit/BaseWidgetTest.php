<?php

use Sharmindar\Core\Dashboard\Widgets\BaseWidget;

/**
 * ---------------------------------------------------------------
 * Unit Tests: BaseWidget Contract
 * ---------------------------------------------------------------
 * Tests the abstract BaseWidget's default behaviors and the
 * canAccess() permission logic.
 */

// Create a minimal concrete implementation for testing defaults
function createDefaultWidget(): BaseWidget
{
    return new class extends BaseWidget {
        public function getId(): string
        {
            return 'default.test';
        }
        public function getName(): string
        {
            return 'Default Test';
        }
        public function getType(): string
        {
            return 'card';
        }
        public function render()
        {
            return '<div>Test</div>';
        }
    };
}

// Create a widget with specific permissions
function createRestrictedWidget(array $permissions): BaseWidget
{
    return new class($permissions) extends BaseWidget {
        public function __construct(private array $perms)
        {
        }

        public function getId(): string
        {
            return 'restricted.test';
        }
        public function getName(): string
        {
            return 'Restricted';
        }
        public function getType(): string
        {
            return 'card';
        }
        public function getRequiredPermissions(): array
        {
            return $this->perms;
        }
        public function render()
        {
            return '<div>Restricted</div>';
        }
    };
}

test('BaseWidget defaults getSortOrder to 100', function () {
    $widget = createDefaultWidget();

    expect($widget->getSortOrder())->toBe(100);
});

test('BaseWidget defaults getWidth to half', function () {
    $widget = createDefaultWidget();

    expect($widget->getWidth())->toBe('half');
});

test('BaseWidget canAccess returns true when no permissions required', function () {
    $widget = createDefaultWidget();

    expect($widget->getRequiredPermissions())->toBeEmpty();
    expect($widget->canAccess())->toBeTrue();
});

test('BaseWidget render returns HTML string', function () {
    $widget = createDefaultWidget();

    $html = $widget->render();

    expect($html)->toBeString();
    expect($html)->toContain('<div>');
});

test('BaseWidget getId returns a string identifier', function () {
    $widget = createDefaultWidget();

    expect($widget->getId())->toBe('default.test');
    expect($widget->getId())->toBeString();
});

test('BaseWidget getName returns human-readable name', function () {
    $widget = createDefaultWidget();

    expect($widget->getName())->toBe('Default Test');
});

test('BaseWidget getType returns widget type', function () {
    $widget = createDefaultWidget();

    expect($widget->getType())->toBe('card');
});

test('BaseWidget with permissions returns non-empty array', function () {
    $widget = createRestrictedWidget(['dashboard.admin']);

    expect($widget->getRequiredPermissions())->toHaveCount(1);
    expect($widget->getRequiredPermissions())->toContain('dashboard.admin');
});
