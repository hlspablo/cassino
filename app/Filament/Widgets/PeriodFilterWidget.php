<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class PeriodFilterWidget extends Widget
{
    protected static string $view = 'filament.widgets.period-filter-widget';

    public static function canView(): bool
    {
        return auth()->user()->hasRole('admin');
    }

}
