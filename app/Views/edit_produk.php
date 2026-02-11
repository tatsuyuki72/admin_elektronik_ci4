<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<!-- ================= HEADER ================= -->
<h2 class="text-2xl font-bold mb-6">Edit Produk</h2>

<!-- ================= FORM EDIT ================= -->
<div class="bg-white p-6 rounded shadow max-w-2xl">

    <form action="/admin/update/<?= $produk['id'] ?>"
          method="post"
          enctype="multipart/form-data">

        <!-- ================= KATEGORI ================= -->
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">
                Kategori
            </label>
            <input type="text"
                   name="kategori"
                   value="<?= esc($produk['kategori']) ?>"
                   class="border rounded p-2 w-full
                          focus:outline-none focus:ring focus:border-blue-400">
        </div>

        <!-- ================= PRODUK ================= -->
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">
                Nama Produk
            </label>
            <input type="text"
                   name="produk"
                   value="<?= esc($produk['produk']) ?>"
                   class="border rounded p-2 w-full
                          focus:outline-none focus:ring focus:border-blue-400">
        </div>

        <!-- ================= HARGA ================= -->
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">
                Harga
            </label>
            <input type="number"
                   name="harga"
                   value="<?= esc($produk['harga']) ?>"
                   class="border rounded p-2 w-full
                          focus:outline-none focus:ring focus:border-blue-400">
        </div>

        <!-- ================= THUMBNAIL ================= -->
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">
                Thumbnail
            </label>

            <input type="file"
                   name="thumbnail"
                   class="border rounded p-2 w-full">

            <?php if (!empty($produk['thumbnail'])) : ?>
                <div class="mt-3">
                    <p class="text-sm text-gray-500 mb-1">
                        Thumbnail Saat Ini:
                    </p>
                    <img src="/uploads/<?= esc($produk['thumbnail']) ?>"
                         width="100"
                         class="rounded border">
                </div>
            <?php endif; ?>
        </div>

        <!-- ================= BUTTON ================= -->
        <div class="flex gap-3 mt-6">

            <a href="/admin/produk"
               class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">
                Kembali
            </a>

            <button type="submit"
                    class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                Update
            </button>

        </div>

    </form>

</div>

<?= $this->endSection() ?>
