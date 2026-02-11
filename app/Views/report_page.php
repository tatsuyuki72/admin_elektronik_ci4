<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<!-- ================= HEADER LAPORAN ================= -->
<h2 class="text-2xl font-bold mb-6">Laporan Produk</h2>

<!-- ================= ACTION BUTTON ================= -->
<div class="mb-4">
    <a href="/admin/report/pdf"
       target="_blank"
       class="bg-red-600 text-white px-4 py-2 rounded shadow hover:bg-red-700">
        Download PDF
    </a>
</div>

<!-- ================= TABEL LAPORAN ================= -->
<div class="bg-white rounded shadow overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-3 border text-left">No</th>
                <th class="p-3 border text-left">Produk</th>
                <th class="p-3 border text-left">Kategori</th>
                <th class="p-3 border text-right">Harga</th>
            </tr>
        </thead>

        <tbody>
            <?php if (!empty($produk)) : ?>
                <?php $no = 1; foreach ($produk as $p) : ?>
                <tr class="hover:bg-gray-50">
                    <td class="p-3 border"><?= $no++ ?></td>
                    <td class="p-3 border"><?= esc($p['produk']) ?></td>
                    <td class="p-3 border"><?= esc($p['kategori']) ?></td>
                    <td class="p-3 border text-right">
                        Rp <?= number_format($p['harga'], 0, ',', '.') ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="4"
                        class="p-6 text-center text-gray-500 border">
                        Data laporan belum tersedia.
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>
