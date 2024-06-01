<?php

namespace App\Livewire;

use App\Models\AffiliateHistory;
use App\Models\User;
use App\Models\Wallet;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AdminWidgets extends BaseWidget
{
    /**
     * @return array|Stat[]
     */
    protected function getCards(): array
    {
        $comissionTotal      = Wallet::where('user_id', auth()->user()->id)->sum('refer_rewards');
        $comissionRevshareTotal   = AffiliateHistory::where('commission_type', 'revshare')
            ->where('status', 1)->sum('commission_paid');
        $comissionCpaTotal       = AffiliateHistory::where('commission_type', 'cpa')
            ->where('status', 1)->sum('commission_paid');

        return [
            Stat::make('Comissão', \Helper::amountFormatDecimal($comissionTotal))
                ->description('Comissão')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
            Stat::make('Comissão CPA', \Helper::amountFormatDecimal($comissionCpaTotal))
                ->description('Comissão Cpa')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
            Stat::make('Comissão Revshare', \Helper::amountFormatDecimal($comissionRevshareTotal))
                ->description('Comissão revshare')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
        ];
    }

    /**
     * @return bool
     */

    public static function canView(): bool
    {
        return auth()->user()->hasRole('afiliado');
    }
}
