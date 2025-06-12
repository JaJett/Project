<x-app-layout>
    <div class="max-w-7xl mx-auto py-10 px-6 lg:px-8">
        <h1 class="text-3xl font-bold mb-6 text-gray-100">Statistik</h1>

        {{-- Grafik Penjualan Harian --}}
        <div class="bg-white p-6 rounded shadow mb-6">
            <h2 class="text-lg font-semibold mb-4">Penjualan Selama Setahun</h2>
            <canvas id="salesChart" height="100"></canvas>
        </div>

        {{-- Menu Terlaris --}}
        <div class="bg-white p-6 rounded shadow mb-6">
            <h2 class="text-lg font-semibold mb-4">Top 5 Menu Terlaris</h2>
            <ul class="list-disc list-inside text-gray-700">
                @foreach ($menuTerlaris as $item)
                    <li>{{ $item->menu->name }} - {{ $item->total }} Terjual</li>
                @endforeach
            </ul>
        </div>
    </div>

    {{-- Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('salesChart').getContext('2d');
        const salesChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($penjualanHarian->keys()) !!},
                datasets: [{
                    label: 'Penjualan',
                    data: {!! json_encode($penjualanHarian->values()) !!},
                    borderColor: 'rgba(99, 102, 241, 1)',
                    backgroundColor: 'rgba(99, 102, 241, 0.2)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    </script>
</x-app-layout>
