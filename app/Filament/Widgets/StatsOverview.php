<?php

namespace App\Filament\Widgets;

use App\Models\User;
use App\Models\Order;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Livewire\Attributes\On;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 2;
    protected static ?string $pollingInterval = '15s';
    protected static bool $isLazy = true;

    public $startDate;
    public $endDate;

    public function mount()
    {
        $this->startDate = Carbon::now()->startOfMonth()->toDateString();
        $this->endDate = Carbon::now()->endOfMonth()->toDateString();
    }

    #[On('filter-dates')]
    public function updateFilterDates($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    /**
     * @return array|Stat[]
     */
    protected function getStats(): array
    {

        $startDate = $this->startDate;
        $endDate = Carbon::parse($this->endDate)->endOfDay()->toDateTimeString();

        $totalWon = Order::where('type', 'win')->whereBetween('created_at', [$startDate, $endDate])->sum('amount');
        $totalLoss = Order::where('type', 'loss')->whereBetween('created_at', [$startDate, $endDate])->sum('amount');
        $totalBet = Order::whereBetween('created_at', [$startDate, $endDate])->sum('bet');

        return [

            Stat::make('Total Ganhos', \Helper::amountFormatDecimal($totalWon))
                ->description('Ganhos dos usuários')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success')
                ->chart([7,3,4,5,6,3,5,3]),
            Stat::make('Total Perdas', \Helper::amountFormatDecimal($totalLoss))
                ->description('Perdas dos usuários')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('danger')
                ->chart([7,3,4,5,6,3,5,3]),
            Stat::make('Total em Apostas', \Helper::amountFormatDecimal($totalBet))
                ->description('Apostas no Periodo')
                ->descriptionIcon('heroicon-m-fire')
                ->color('success')
                ->chart([7,3,4,5,6,3,5,3])
        ];
    }

    public static function canView(): bool
    {
        return auth()->user()->hasRole('admin');
    }
}
