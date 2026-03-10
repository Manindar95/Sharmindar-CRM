<?php

use Sharmindar\Core\Dashboard\Managers\DashboardManager;
use Sharmindar\Core\Dashboard\Widgets\BaseWidget;

/**
 * ---------------------------------------------------------------
 * Unit Tests: DashboardManager
 * ---------------------------------------------------------------
 * Tests the core widget registry: registration, filtering,
 * sorting, and duplicate ID handling.
 */

// Helper: create a concrete test widget
function createTestWidget(string $id, string $name, int $sortOrder = 100, bool $canAccess = true): BaseWidget
{
    return new class($id, $name, $sortOrder, $canAccess) extends BaseWidget {
        public function __construct(private
        string $widgetId, private
        string $widgetName, private
        int $widgetSort, private
        bool $widgetAccess
        )
        {
        }

        public function getId(): string
        {
            return $this->widgetId;
        }
        public function getName(): string
        {
            return $this->widgetName;
        }
        public function getType(): string
        {
            return 'card';
        }
        public function getSortOrder(): int
        {
            return $this->widgetSort;
        }
        public function canAccess(): bool
        {
            return $this->widgetAccess;
        }
        public function render()
        {
            return "<div>{$this->widgetName}</div>";
        }
    };
}

test('DashboardManager can register a widget', function () {
    $manager = new DashboardManager();
    $widget = createTestWidget('test.widget', 'Test Widget');

    $manager->registerWidget($widget);

    $available = $manager->getAvailableWidgets();

    expect($available)->toHaveCount(1);
    expect($available->first()->getId())->toBe('test.widget');
    expect($available->first()->getName())->toBe('Test Widget');
});

test('DashboardManager can register multiple widgets', function () {
    $manager = new DashboardManager();

    $manager->registerWidget(createTestWidget('w1', 'Widget One'));
    $manager->registerWidget(createTestWidget('w2', 'Widget Two'));
    $manager->registerWidget(createTestWidget('w3', 'Widget Three'));

    expect($manager->getAvailableWidgets())->toHaveCount(3);
});

test('DashboardManager filters out widgets where canAccess is false', function () {
    $manager = new DashboardManager();

    $manager->registerWidget(createTestWidget('visible', 'Visible', 10, true));
    $manager->registerWidget(createTestWidget('hidden', 'Hidden', 20, false));
    $manager->registerWidget(createTestWidget('also-visible', 'Also Visible', 30, true));

    $available = $manager->getAvailableWidgets();

    expect($available)->toHaveCount(2);

    $ids = $available->map(fn($w) => $w->getId())->values()->toArray();
    expect($ids)->not->toContain('hidden');
});

test('DashboardManager sorts widgets by sort order', function () {
    $manager = new DashboardManager();

    $manager->registerWidget(createTestWidget('last', 'Last', 300));
    $manager->registerWidget(createTestWidget('first', 'First', 10));
    $manager->registerWidget(createTestWidget('middle', 'Middle', 100));

    $available = $manager->getAvailableWidgets();
    $ids = $available->values()->map(fn($w) => $w->getId())->toArray();

    expect($ids)->toBe(['first', 'middle', 'last']);
});

test('DashboardManager handles duplicate widget IDs by overwriting', function () {
    $manager = new DashboardManager();

    $manager->registerWidget(createTestWidget('dup', 'Original'));
    $manager->registerWidget(createTestWidget('dup', 'Replacement'));

    $available = $manager->getAvailableWidgets();

    expect($available)->toHaveCount(1);
    expect($available->first()->getName())->toBe('Replacement');
});

test('DashboardManager returns empty collection when no widgets registered', function () {
    $manager = new DashboardManager();

    expect($manager->getAvailableWidgets())->toHaveCount(0);
    expect($manager->getAvailableWidgets())->toBeEmpty();
});

test('DashboardManager ignores non-BaseWidget instances', function () {
    $manager = new DashboardManager();

    // Passing a stdClass should be silently ignored
    $manager->registerWidget(new \stdClass());

    expect($manager->getAvailableWidgets())->toHaveCount(0);
});
