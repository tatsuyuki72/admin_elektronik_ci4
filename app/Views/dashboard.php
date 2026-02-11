<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<!-- ================= HEADER ================= -->
<h2 class="text-2xl font-bold mb-6">Dashboard</h2>

<div class="mb-6 flex gap-3">
    <a href="/admin/report"
       class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700 transition">
        Lihat Laporan
    </a>

    <a href="/admin/report/pdf"
       target="_blank"
       class="bg-red-600 text-white px-4 py-2 rounded shadow hover:bg-red-700 transition">
        Download PDF
    </a>
</div>


<!-- ================= CARD STATISTIK ================= -->
<div class="grid grid-cols-5 gap-4 mb-8">

    <div class="bg-white p-4 rounded shadow border-l-4 border-blue-600">
        <p class="text-sm text-gray-500">Earnings (Monthly)</p>
        <p class="text-xl font-bold">
            Rp <?= number_format($earningMonthly, 0, ',', '.') ?>
        </p>
    </div>

    <div class="bg-white p-4 rounded shadow border-l-4 border-green-600">
        <p class="text-sm text-gray-500">Earnings (Annual)</p>
        <p class="text-xl font-bold">
            Rp <?= number_format($earningAnnual, 0, ',', '.') ?>
        </p>
    </div>

    <div class="bg-white p-4 rounded shadow border-l-4 border-purple-600">
        <p class="text-sm text-gray-500">Total Produk</p>
        <p class="text-xl font-bold">
            <?= $totalProduk ?>
        </p>
    </div>

    <div class="bg-white p-4 rounded shadow border-l-4 border-cyan-600">
        <p class="text-sm text-gray-500">Tasks</p>
        <p class="text-xl font-bold">
            <?= $taskPercent ?>%
        </p>
    </div>

    <div class="bg-white p-4 rounded shadow border-l-4 border-yellow-500">
        <p class="text-sm text-gray-500">Pending Requests</p>
        <p class="text-xl font-bold">
            <?= $pendingRequest ?>
        </p>
    </div>

</div>


<!-- ================= GRAFIK ================= -->
<div class="grid grid-cols-3 gap-6 mb-10">

    <!-- LINE CHART -->
    <div class="col-span-2 bg-white p-4 rounded shadow">
        <h3 class="font-semibold mb-3">Earnings Overview</h3>
        <canvas id="lineChart"></canvas>
    </div>

    <!-- DONUT CHART -->
    <div class="bg-white p-4 rounded shadow">
        <h3 class="font-semibold mb-3">Revenue Sources</h3>
        <canvas id="donutChart"></canvas>
    </div>

</div>


<!-- ================= LAPORAN BULAN INI ================= -->
<div class="bg-white p-4 rounded shadow mb-8">
    <h3 class="text-lg font-semibold mb-4">Produk Bulan Ini</h3>

    <?php if (!empty($pembelianBulanan)) : ?>
        <table class="w-full text-sm border">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2 border">Produk</th>
                    <th class="p-2 border">Kategori</th>
                    <th class="p-2 border">Harga</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pembelianBulanan as $p) : ?>
                <tr class="hover:bg-gray-50">
                    <td class="p-2 border"><?= esc($p['produk']) ?></td>
                    <td class="p-2 border"><?= esc($p['kategori']) ?></td>
                    <td class="p-2 border text-right">
                        Rp <?= number_format($p['harga'],0,',','.') ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p class="text-gray-500">Tidak ada pembelian bulan ini.</p>
    <?php endif; ?>
</div>


<!-- ================= LAPORAN TAHUN INI ================= -->
<div class="bg-white p-4 rounded shadow">
    <h3 class="text-lg font-semibold mb-4">Produk Tahun Ini</h3>

    <?php if (!empty($pembelianTahunan)) : ?>
        <table class="w-full text-sm border">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2 border">Produk</th>
                    <th class="p-2 border">Kategori</th>
                    <th class="p-2 border">Harga</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pembelianTahunan as $p) : ?>
                <tr class="hover:bg-gray-50">
                    <td class="p-2 border"><?= esc($p['produk']) ?></td>
                    <td class="p-2 border"><?= esc($p['kategori']) ?></td>
                    <td class="p-2 border text-right">
                        Rp <?= number_format($p['harga'],0,',','.') ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p class="text-gray-500">Tidak ada pembelian tahun ini.</p>
    <?php endif; ?>
</div>


<!-- ================= CHART JS ================= -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
new Chart(document.getElementById('lineChart'), {
    type: 'line',
    data: {
        labels: <?= $bulan ?>,
        datasets: [{
            label: 'Earnings',
            data: <?= $earningBulanan ?>,
            borderColor: '#2563eb',
            backgroundColor: 'rgba(37,99,235,0.15)',
            tension: 0.4,
            fill: true
        }]
    },
    options: { plugins: { legend: { display: false } } }
});

new Chart(document.getElementById('donutChart'), {
    type: 'doughnut',
    data: {
        labels: <?= $labelsDonut ?>,
        datasets: [{
            data: <?= $dataDonut ?>,
            backgroundColor: ['#2563eb','#10b981','#06b6d4']
        }]
    },
    options: { plugins: { legend: { position: 'bottom' } } }
});
</script>

<?= $this->endSection() ?>
