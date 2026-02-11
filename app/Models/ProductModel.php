<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table            = 'products';
    protected $primaryKey       = 'id';

    protected $allowedFields = [
        'thumbnail',
        'kategori',
        'produk',
        'harga'
    ];

    /* ================= TIMESTAMP ================= */

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /* ================= RETURN TYPE ================= */

    protected $returnType = 'array';

    /* ================= VALIDATION RULES (Optional) ================= */

    protected $validationRules = [
        'kategori' => 'required|min_length[3]',
        'produk'   => 'required|min_length[3]',
        'harga'    => 'required|numeric'
    ];

    protected $validationMessages = [
        'kategori' => [
            'required'   => 'Kategori wajib diisi.',
            'min_length' => 'Kategori minimal 3 karakter.'
        ],
        'produk' => [
            'required'   => 'Nama produk wajib diisi.',
            'min_length' => 'Nama produk minimal 3 karakter.'
        ],
        'harga' => [
            'required' => 'Harga wajib diisi.',
            'numeric'  => 'Harga harus berupa angka.'
        ]
    ];
}
