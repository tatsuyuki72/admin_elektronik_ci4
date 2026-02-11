<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<!-- ================= HEADER ================= -->
<h2 class="text-2xl font-bold mb-6">Data Produk</h2>

<!-- ================= FORM TAMBAH PRODUK ================= -->
<div class="bg-white p-6 rounded shadow mb-8">
    <form action="/admin/tambah"
          method="post"
          enctype="multipart/form-data">

        <?= csrf_field(); ?>

        <div class="grid grid-cols-4 gap-4">
            <input type="file" name="thumbnail" required
                   class="border rounded p-2">

            <input type="text" name="kategori"
                   placeholder="Kategori"
                   class="border rounded p-2"
                   required>

            <input type="text" name="produk"
                   placeholder="Nama Produk"
                   class="border rounded p-2"
                   required>

            <input type="number" name="harga"
                   placeholder="Harga"
                   class="border rounded p-2"
                   required>
        </div>

        <button type="submit"
                class="mt-4 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            Tambah Produk
        </button>
    </form>
</div>

<!-- ================= TABEL PRODUK ================= -->
<div class="bg-white rounded shadow overflow-hidden">

    <table class="w-full text-sm">
        <thead class="bg-gray-100">
            <tr class="text-left">
                <th class="p-3">Thumbnail</th>
                <th class="p-3">Kategori</th>
                <th class="p-3">Produk</th>
                <th class="p-3 text-right">Harga</th>
                <th class="p-3">Aksi</th>
            </tr>
        </thead>

        <tbody>
        <?php if (!empty($produk)) : ?>
            <?php foreach ($produk as $p) : ?>
                <tr class="produk-row border-t hover:bg-gray-50">

                    <!-- Thumbnail -->
                    <td class="p-3">
                        <?php if (!empty($p['thumbnail'])) : ?>
                            <img src="/uploads/<?= esc($p['thumbnail']) ?>"
                                 width="60"
                                 class="rounded border">
                        <?php else : ?>
                            -
                        <?php endif; ?>
                    </td>

                    <!-- Kategori -->
                    <td class="p-3"><?= esc($p['kategori']) ?></td>

                    <!-- Produk -->
                    <td class="p-3"><?= esc($p['produk']) ?></td>

                    <!-- Harga -->
                    <td class="p-3 text-right">
                        Rp <?= number_format($p['harga'],0,',','.') ?>
                    </td>

                    <!-- Aksi -->
                    <td class="p-3">
                        <button
                            onclick="openEditModal(
                                <?= $p['id'] ?>,
                                '<?= esc($p['kategori'], 'js') ?>',
                                '<?= esc($p['produk'], 'js') ?>',
                                <?= $p['harga'] ?>
                            )"
                            class="text-blue-600 mr-3">
                            Edit
                        </button>

                        <button
                            onclick="openDeleteModal(<?= $p['id'] ?>)"
                            class="text-red-600">
                            Delete
                        </button>
                    </td>

                </tr>
            <?php endforeach; ?>
        <?php else : ?>
            <tr>
                <td colspan="5"
                    class="text-center p-6 text-gray-500">
                    Belum ada data produk
                </td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>

</div>

<!-- ================= EDIT MODAL ================= -->
<div id="editModal"
     class="fixed inset-0 bg-black bg-opacity-40 hidden items-center justify-center z-50">

    <div id="editBox"
         class="bg-white p-6 rounded-lg shadow-xl w-96 transform scale-95 opacity-0 transition-all duration-300">

        <h3 class="text-lg font-semibold mb-4">Edit Produk</h3>

        <form id="editForm" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>

            <div class="mb-3">
                <label class="text-sm">Kategori</label>
                <input type="text" name="kategori" id="editKategori"
                       class="border p-2 w-full">
            </div>

            <div class="mb-3">
                <label class="text-sm">Produk</label>
                <input type="text" name="produk" id="editProduk"
                       class="border p-2 w-full">
            </div>

            <div class="mb-3">
                <label class="text-sm">Harga</label>
                <input type="number" name="harga" id="editHarga"
                       class="border p-2 w-full">
            </div>

            <div class="mb-3">
                <label class="text-sm">Thumbnail (Optional)</label>
                <input type="file" name="thumbnail"
                       class="border p-2 w-full">
            </div>

            <div class="flex justify-end gap-3 mt-4">
                <button type="button"
                        onclick="closeEditModal()"
                        class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400 transition">
                    Batal
                </button>

                <button type="submit"
                        class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>

<!-- ================= DELETE MODAL ================= -->
<div id="deleteModal"
     class="fixed inset-0 bg-black bg-opacity-40 hidden items-center justify-center z-50">

    <div id="modalBox"
         class="bg-white p-6 rounded-lg shadow-xl w-80 transform scale-95 opacity-0 transition-all duration-300">

        <h3 class="text-lg font-semibold mb-4">Konfirmasi Hapus</h3>

        <p class="text-sm text-gray-600 mb-6">
            Apakah kamu yakin ingin menghapus produk ini?
        </p>

        <div class="flex justify-end gap-3">
            <button onclick="closeDeleteModal()"
                    class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400 transition">
                Batal
            </button>

            <a id="deleteConfirmBtn"
               href="#"
               class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition">
                Hapus
            </a>
        </div>
    </div>
</div>

<!-- ================= SCRIPT MODAL ================= -->
<script>
function openDeleteModal(id) {
    const modal = document.getElementById('deleteModal');
    const box   = document.getElementById('modalBox');
    const confirmBtn = document.getElementById('deleteConfirmBtn');

    confirmBtn.href = "/admin/delete/" + id;

    modal.classList.remove('hidden');
    modal.classList.add('flex');

    setTimeout(() => {
        box.classList.remove('scale-95','opacity-0');
        box.classList.add('scale-100','opacity-100');
    }, 10);
}

function closeDeleteModal() {
    const modal = document.getElementById('deleteModal');
    const box   = document.getElementById('modalBox');

    box.classList.remove('scale-100','opacity-100');
    box.classList.add('scale-95','opacity-0');

    setTimeout(() => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }, 200);
}

function openEditModal(id, kategori, produk, harga) {
    const modal = document.getElementById('editModal');
    const box   = document.getElementById('editBox');
    const form  = document.getElementById('editForm');

    form.action = "/admin/update/" + id;

    document.getElementById('editKategori').value = kategori;
    document.getElementById('editProduk').value   = produk;
    document.getElementById('editHarga').value    = harga;

    modal.classList.remove('hidden');
    modal.classList.add('flex');

    setTimeout(() => {
        box.classList.remove('scale-95','opacity-0');
        box.classList.add('scale-100','opacity-100');
    }, 10);
}

function closeEditModal() {
    const modal = document.getElementById('editModal');
    const box   = document.getElementById('editBox');

    box.classList.remove('scale-100','opacity-100');
    box.classList.add('scale-95','opacity-0');

    setTimeout(() => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }, 200);
}
</script>

<?= $this->endSection() ?>
