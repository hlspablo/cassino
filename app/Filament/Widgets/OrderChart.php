<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;
use Filament\Support\RawJs;

class OrderChart extends ChartWidget
{
    protected static ?string $heading = 'Apostas';

    protected static ?int $sort = 3;

    protected int | string | array $columnSpan = 'full';

    public static function canView(): bool
    {
        return auth()->user()->hasRole('admin');
    }

    protected function getData(): array
    {
        $data = $this->getBetOrder();

        return [
            'datasets' => [
                [
                    'label' => 'Apostas na plataforma',
                    'data' => $data['orderPerMonth'],
                ],
            ],
            'labels' => $data['months'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }


    protected function getOptions(): RawJs
    {
        return RawJs::make(<<<JS
        {
            scales: {
                y: {
                    ticks: {
                        callback: (value) => 'R$ ' + value,
                    },
                },
            },
        }
    JS);
    }

    /**
     * @return array
     */
    private function getBetOrder(): array
    {
        $now = Carbon::now();
        $orderPerMonth = [];
        $months = [];

        collect(range(1, 12))->each(function ($month) use ($now, &$orderPerMonth, &$months) {
            $monthDate = Carbon::parse($now)->month($month);
            $sum = Order::whereMonth('created_at', $monthDate)->sum('bet');

            $orderPerMonth[] = $sum;
            $months[] = $monthDate->format('M');
        });

        return [
            'orderPerMonth' => $orderPerMonth,
            'months' => $months
        ];
    }
}
