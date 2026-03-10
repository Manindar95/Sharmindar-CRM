<?php

namespace Sharmindar\Core\Settings\Helpers;

use Sharmindar\Core as BaseCore;

class Core
{
    /**
     * @var BaseCore
     */
    protected $core;

    public function __construct(BaseCore $core)
    {
        $this->core = $core;
    }

    /**
     * Retrieve all timezones formatted for system config drop-downs.
     */
    public function timezones(): array
    {
        $options = [];
        foreach ($this->core->timezones() as $timezone) {
            $options[] = [
                'title' => $timezone,
                'value' => $timezone,
            ];
        }
        return $options;
    }

    /**
     * Retrieve all locales formatted for system config drop-downs.
     */
    public function locales(): array
    {
        // The base core already formats locales correctly as title/value pairs!
        return $this->core->locales();
    }

    /**
     * Retrieve all currencies formatted for system config drop-downs.
     * Webkul Core doesn't actually have a currencies() method, so we provide one.
     */
    public function currencies(): array
    {
        return [
            ['title' => 'USD - US Dollar', 'value' => 'USD'],
            ['title' => 'EUR - Euro', 'value' => 'EUR'],
            ['title' => 'INR - Indian Rupee', 'value' => 'INR'],
            ['title' => 'GBP - British Pound', 'value' => 'GBP'],
            ['title' => 'AUD - Australian Dollar', 'value' => 'AUD'],
            ['title' => 'CAD - Canadian Dollar', 'value' => 'CAD'],
            ['title' => 'AED - United Arab Emirates Dirham', 'value' => 'AED'],
            ['title' => 'SAR - Saudi Riyal', 'value' => 'SAR'],
            ['title' => 'QAR - Qatari Riyal', 'value' => 'QAR'],
            ['title' => 'OMR - Omani Rial', 'value' => 'OMR'],
            ['title' => 'BHD - Bahraini Dinar', 'value' => 'BHD'],
            ['title' => 'KWD - Kuwaiti Dinar', 'value' => 'KWD'],
            ['title' => 'BDT - Bangladeshi Taka', 'value' => 'BDT'],
            ['title' => 'PKR - Pakistani Rupee', 'value' => 'PKR'],
        ];
    }
}
