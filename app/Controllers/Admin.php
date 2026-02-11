<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductModel;
use Dompdf\Dompdf;

class Admin extends BaseController
{

    /* ================= DASHBOARD ================= */
    public function dashboard()
    {
        $db = \Config\Database::connect();

        /* ================= CARD STATISTIK ================= */

        // Earnings Monthly
        $earningMonthly = $db->query("
            SELECT SUM(harga) as total
            FROM products
            WHERE MONTH(created_at) = MONTH(CURRENT_DATE())
            AND YEAR(created_at) = YEAR(CURRENT_DATE())
        ")->getRow()->total ?? 0;

        // Earnings Annual
        $earningAnnual = $db->query("
            SELECT SUM(harga) as total
            FROM products
            WHERE YEAR(created_at) = YEAR(CURRENT_DATE())
        ")->getRow()->total ?? 0;

        // Total Produk
        $totalProduk = $db->query("
            SELECT COUNT(*) as total FROM products
        ")->getRow()->total ?? 0;


        /* ================= GRAFIK BULANAN ================= */

        $monthlyData = $db->query("
            SELECT MONTH(created_at) as bulan, SUM(harga) as total
            FROM products
            WHERE YEAR(created_at) = YEAR(CURRENT_DATE())
            GROUP BY MONTH(created_at)
        ")->getResult();

        $bulanLabel = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
        $earningBulanan = array_fill(0, 12, 0);

        foreach ($monthlyData as $data) {
            $earningBulanan[$data->bulan - 1] = $data->total;
        }


        /* ================= DONUT CHART ================= */

        $kategoriData = $db->query("
            SELECT kategori, SUM(harga) as total
            FROM products
            GROUP BY kategori
        ")->getResult();

        $labelsDonut = [];
        $dataDonut   = [];

        foreach ($kategoriData as $data) {
            $labelsDonut[] = $data->kategori;
            $dataDonut[]   = $data->total;
        }


        /* ================= LAPORAN DETAIL ================= */

        $pembelianBulanan = $db->query("
            SELECT * FROM products
            WHERE MONTH(created_at) = MONTH(CURRENT_DATE())
            AND YEAR(created_at) = YEAR(CURRENT_DATE())
            ORDER BY created_at DESC
        ")->getResultArray();

        $pembelianTahunan = $db->query("
            SELECT * FROM products
            WHERE YEAR(created_at) = YEAR(CURRENT_DATE())
            ORDER BY created_at DESC
        ")->getResultArray();


        return view('dashboard', [
            'earningMonthly'   => $earningMonthly,
            'earningAnnual'    => $earningAnnual,
            'totalProduk'      => $totalProduk,
            'taskPercent'      => 100,
            'pendingRequest'   => 0,
            'bulan'            => json_encode($bulanLabel),
            'earningBulanan'   => json_encode($earningBulanan),
            'labelsDonut'      => json_encode($labelsDonut),
            'dataDonut'        => json_encode($dataDonut),
            'pembelianBulanan' => $pembelianBulanan,
            'pembelianTahunan' => $pembelianTahunan,
        ]);
    }


    /* ================= CRUD PRODUK ================= */

    public function produk()
    {
        $model = new ProductModel();
        return view('produk', [
            'produk' => $model->findAll()
        ]);
    }

    public function tambah()
    {
        $model = new ProductModel();

        $file = $this->request->getFile('thumbnail');
        $namaFile = null;

        if ($file && $file->isValid()) {
            $namaFile = $file->getRandomName();
            $file->move(FCPATH . 'uploads', $namaFile);
        }

        $model->save([
            'thumbnail' => $namaFile,
            'kategori'  => $this->request->getPost('kategori'),
            'produk'    => $this->request->getPost('produk'),
            'harga'     => $this->request->getPost('harga')
        ]);

        return redirect()->to('/admin/produk');
    }

    public function edit($id)
    {
        $model = new ProductModel();
        return view('edit_produk', [
            'produk' => $model->find($id)
        ]);
    }

    public function update($id)
    {
        $model = new ProductModel();

        $data = [
            'kategori' => $this->request->getPost('kategori'),
            'produk'   => $this->request->getPost('produk'),
            'harga'    => $this->request->getPost('harga')
        ];

        $file = $this->request->getFile('thumbnail');
        if ($file && $file->isValid()) {
            $namaFile = $file->getRandomName();
            $file->move(FCPATH . 'uploads', $namaFile);
            $data['thumbnail'] = $namaFile;
        }

        $model->update($id, $data);

        return redirect()->to('/admin/produk');
    }

    public function delete($id)
    {
        $model = new ProductModel();
        $model->delete($id);

        return redirect()->to('/admin/produk');
    }


    /* ================= LAPORAN HTML ================= */

    public function report()
    {
        $model = new ProductModel();
        $produk = $model->findAll();

        return view('report_page', [
            'produk' => $produk,
            'tanggal' => date('d M Y')
        ]);
    }


    /* ================= EXPORT PDF ================= */

    public function reportPdf()
    {
        $model = new ProductModel();
        $produk = $model->findAll();

        $html = view('report_pdf', [
            'produk'  => $produk,
            'tanggal' => date('d M Y')
        ]);

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return $this->response
            ->setContentType('application/pdf')
            ->setBody($dompdf->output());
    }

}
