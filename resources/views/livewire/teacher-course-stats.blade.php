<div class="bg-white rounded-lg shadow p-6">
    <h2 class="text-xl font-semibold mb-4">Statistiques des inscriptions</h2>
    <div wire:ignore>
        <livewire:livewire-column-chart
            key="{{ $columnChartModel->reactiveKey() }}"
            :column-chart-model="$columnChartModel"
        />
    </div>
</div>