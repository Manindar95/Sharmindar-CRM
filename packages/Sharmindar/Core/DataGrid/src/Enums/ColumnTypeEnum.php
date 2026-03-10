<?php

namespace Sharmindar\Core\DataGrid\Enums;

use Sharmindar\Core\DataGrid\ColumnTypes\Aggregate;
use Sharmindar\Core\DataGrid\ColumnTypes\Boolean;
use Sharmindar\Core\DataGrid\ColumnTypes\Date;
use Sharmindar\Core\DataGrid\ColumnTypes\Datetime;
use Sharmindar\Core\DataGrid\ColumnTypes\Decimal;
use Sharmindar\Core\DataGrid\ColumnTypes\Integer;
use Sharmindar\Core\DataGrid\ColumnTypes\Text;
use Sharmindar\Core\DataGrid\Exceptions\InvalidColumnTypeException;

enum ColumnTypeEnum: string
{
    /**
     * String.
     */
    case STRING = 'string';

    /**
     * Integer.
     */
    case INTEGER = 'integer';

    /**
     * Float.
     */
    case FLOAT = 'float';

    /**
     * Boolean.
     */
    case BOOLEAN = 'boolean';

    /**
     * Date.
     */
    case DATE = 'date';

    /**
     * Date time.
     */
    case DATETIME = 'datetime';

    /**
     * Aggregate.
     */
    case AGGREGATE = 'aggregate';

    /**
     * Get the corresponding class name for the column type.
     */
    public static function getClassName(string $type): string
    {
        return match ($type) {
            self::STRING->value    => Text::class,
            self::INTEGER->value   => Integer::class,
            self::FLOAT->value     => Decimal::class,
            self::BOOLEAN->value   => Boolean::class,
            self::DATE->value      => Date::class,
            self::DATETIME->value  => Datetime::class,
            self::AGGREGATE->value => Aggregate::class,
            default                => throw new InvalidColumnTypeException("Invalid column type: {$type}"),
        };
    }
}
