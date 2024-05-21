
<!-- resources/views/livewire/period-filter-widget.blade.php -->

<div>
    <label for="startDate">Data de Início:</label>
    <input type="date" id="startDate" wire:model="startDate" wire:change="updateFilterDates($event.target.value, endDate.value)" class="custom-input">

    <label for="endDate">Data de Fim:</label>
    <input type="date" id="endDate" wire:model="endDate" wire:change="updateFilterDates(startDate.value, $event.target.value)" class="custom-input">
</div>

