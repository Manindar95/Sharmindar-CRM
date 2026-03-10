<?php

namespace Sharmindar\Core\DataGrid\ColumnTypes;

use Sharmindar\Core\DataGrid\Column;
use Sharmindar\Core\DataGrid\Enums\DateRangeOptionEnum;
use Sharmindar\Core\DataGrid\Enums\FilterTypeEnum;
use Sharmindar\Core\DataGrid\Exceptions\InvalidColumnException;

class Date extends Column
{
    /**
     * Set filterable type.
     */
    public function setFilterableType(?string $filterableType): void
    {
        if (
            $filterableType
            && ($filterableType !== FilterTypeEnum::DATE_RANGE->value)
        ) {
            throw new InvalidColumnException('Date filters will only work with `date_range` type. Either remove the `filterable_type` or set it to `date_range`.');
        }

        parent::setFilterableType($filterableType);
    }

    /**
     * Set filterable options.
     */
    public function setFilterableOptions(mixed $filterableOptions): void
    {
        if (empty($filterableOptions)) {
            $filterableOptions = DateRangeOptionEnum::options();
        }

        parent::setFilterableOptions($filterableOptions);
    }

    /**
     * Process filter.
     */
    public function processFilter($queryBuilder, $requestedDates)
    {
        return $queryBuilder->where(function ($scopeQueryBuilder) use ($requestedDates) {
            if (is_string($requestedDates)) {
                $rangeOption = collect($this->filterableOptions)->firstWhere('name', $requestedDates);

                $requestedDates = ! $rangeOption
                    ? [[$requestedDates, $requestedDates]]
                    : [[$rangeOption['from'], $rangeOption['to']]];
            }

            foreach ($requestedDates as $value) {
                $scopeQueryBuilder->whereBetween($this->columnName, [
                    ($value[0] ?? '').' 00:00:01',
                    ($value[1] ?? '').' 23:59:59',
                ]);
            }
        });
    }
}
