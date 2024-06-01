<?php

namespace App\Filament\Widgets;

use App\Models\Deposit;
use App\Models\Withdrawal;
use App\Models\AfilliateHistory;
use App\Models\User;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Livewire\Attributes\On;

class WalletOverview extends BaseWidget
{
    public $startDate;
    public $endDate;

    public function mount(): void
    {
        $this->startDate = Carbon::now()->startOfMonth()->toDateString();
        $this->endDate = Carbon::now()->endOfMonth()->toDateString();
    }

    #[On('filter-dates')]
    public function updateFilterDates($startDate, $endDate): void
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    protected function getStats(): array
    {
        $startDate = $this->startDate;
        $endDate = Carbon::parse($this->endDate)->endOfDay()->toDateTimeString();

        $setting = \Helper::getSetting();
        $dataAtual = Carbon::now();

        $sumDepositMonth = Deposit::whereBetween('created_at', [$startDate, $endDate])
            ->where('status', 1)
            ->sum('amount');

        $sumWithdrawalMonth = Withdrawal::whereBetween('created_at', [$startDate, $endDate])
            ->sum('amount');

        $total_users = User::where('role_id', 3)->count();

        return [
            Stat::make('Depósitos', \Helper::amountFormatDecimal($sumDepositMonth))
                ->description('Total de Depósitos')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
            Stat::make('Saques', \Helper::amountFormatDecimal($sumWithdrawalMonth))
                ->description('Total de saques')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('danger'),
          Stat::make('Total Usuários', $total_users)
                ->description('Novos usuários')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('info')
                ->chart([7,3,4,5,6,3,5,3]),
        ];
    }
    public static function canView(): bool
    {
        return auth()->user()->hasRole('admin');
    }

}
