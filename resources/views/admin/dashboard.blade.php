<x-app-layout>
    <div class="max-w-screen-lg mx-auto py-6 px-4">
        <h1 class="text-3xl font-bold mb-6 text-white">Dashboard Admin</h1>

        {{-- Statistik Ringkas --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-4">
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

            {{-- Grafik Penjualan Harian --}}
        <div class="grid grid-cols-1 gap-4 mb-4">
            <div class="bg-white p-4 rounded shadow">
                <h2 class="text-base font-semibold mb-2 text-gray-700">Penjualan 30 Hari Terakhir</h2>
                <canvas id="salesChart" width="200px" height="30px"></canvas>
            </div>
        </div>

        {{-- Grafik Pendapatan & Menu Terlaris --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="bg-white p-4 rounded shadow">
                <h2 class="text-base font-semibold mb-2 text-gray-700">Pendapatan Bulanan</h2>
                <canvas id="incomeChart" width="200px" height="70px"></canvas>
            </div>

            <div class="bg-white p-4 rounded shadow">
                <h2 class="text-base font-semibold mb-2 text-gray-700">Menu Terlaris</h2>
                <canvas id="menuChart" width="200px" height="70px"></canvas>
            </div>
        </div>


    {{-- Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Penjualan Harian
        const salesCtx = document.getElementById('salesChart').getContext('2d');
        new Chart(salesCtx, {
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
            options: { responsive: true, plugins: { legend: { display: false } } }
        });

        // Pendapatan Bulanan
        const incomeCtx = document.getElementById('incomeChart').getContext('2d');
        new Chart(incomeCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($pendapatanBulanan->keys()) !!},
                datasets: [{
                    label: 'Pendapatan',
                    data: {!! json_encode($pendapatanBulanan->values()) !!},
                    backgroundColor: 'rgba(59, 130, 246, 0.6)',
                    borderColor: 'rgba(59, 130, 246, 1)',
                    borderWidth: 1
                }]
            },
            options: { responsive: true }
        });

        // Menu Terlaris
        const menuCtx = document.getElementById('menuChart').getContext('2d');
        new Chart(menuCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($menuTerlaris->pluck('menu.name')) !!},
                datasets: [{
                    label: 'Jumlah Terjual',
                    data: {!! json_encode($menuTerlaris->pluck('total')) !!},
                    backgroundColor: 'rgba(139, 92, 246, 0.6)',
                    borderColor: 'rgba(139, 92, 246, 1)',
                    borderWidth: 1
                }]
            },
            options: { responsive: true }
        });
    </script>
</x-app-layout>
