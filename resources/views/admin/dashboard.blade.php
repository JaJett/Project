<x-app-layout>
    <div class="max-w-7xl mx-auto py-10 px-6 lg:px-8">
        <h1 class="text-3xl font-bold mb-6 text-gray-100">Dashboard Admin</h1>

        {{-- Statistik Ringkas --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
            <div class="bg-white p-6 rounded shadow text-center">
                <h2 class="text-2xl font-bold text-blue-600">{{ $totalMenus }}</h2>
                <p class="text-gray-600">Total Menu</p>
            </div>
            <div class="bg-white p-6 rounded shadow text-center">
                <h2 class="text-2xl font-bold text-green-600">{{ $totalUsers }}</h2>
                <p class="text-gray-600">User Terdaftar</p>
            </div>
            <div class="bg-white p-6 rounded shadow text-center">
                <h2 class="text-2xl font-bold text-yellow-600">{{ $totalAdmins }}</h2>
                <p class="text-gray-600">Admin</p>
            </div>
            <div class="bg-white p-6 rounded shadow text-center">
                <h2 class="text-2xl font-bold text-purple-600">Rp{{ number_format($totalPenjualan, 0, ',', '.') }}</h2>
                <p class="text-gray-600">Total Penjualan</p>
            </div>
        </div>

        {{-- Grafik Penjualan --}}
        <div class="bg-white p-6 rounded shadow mb-6">
            <h2 class="text-lg font-semibold mb-4 text-gray-700">Penjualan Selama Setahun</h2>
            <canvas id="salesChart" height="100"></canvas>
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
