<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\PeriodFilterWidget;
use App\Livewire\WalletOverview;
use App\Livewire\AdminWidgets;
use App\Livewire\LatestAdminComissions;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Dashboard as BasePage;
use Illuminate\Contracts\View\View;

class Dashboard extends BasePage implements HasForms
{
    /**
     * @return string|\Illuminate\Contracts\Support\Htmlable|null
     */
    public function getSubheading(): string| null|\Illuminate\Contracts\Support\Htmlable
    {
        if (auth()->user()->hasRole('admin')) {
            return null;
        }

        return 'Olá, afiliado! Seja muito bem-vindo ao seu painel.';
    }

    /**
     * @return string[]
     */
    public function getWidgets(): array
    {
        return [
            PeriodFilterWidget::class,
            WalletOverview::class,
            AdminWidgets::class,
            LatestAdminComissions::class,
        ];
    }

    /**
     * Render the view for the dashboard.
     *
     * @return View
     */
    public function render(): View
    {
        return view('filament.pages.dashboard');
    }
}
