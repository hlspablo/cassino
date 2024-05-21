<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Log;

class PeriodFilter extends Component
{
    public $startDate;
    public $endDate;


    public function mount()
    {
        $startDate = Carbon::now()->startOfMonth()->toDateString();
        $endDate = Carbon::now()->endOfMonth()->toDateString();

        $this->startDate = $startDate;
        $this->endDate = $endDate;

        $this->dispatch('filter-dates', $startDate, $endDate);
    }

    public function updateFilterDates($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;

        // Emit the event to other components
        $this->dispatch('filter-dates', $startDate, $endDate);
    }

    public function render(): View
    {
        return view('livewire.period-filter-widget', [
            'startDate' => $this->startDate,
            'endDate' => $this->endDate,
        ]);
    }
}
