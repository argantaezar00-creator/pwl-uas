<?php

namespace App\Controllers;

use App\Models\LayananModel;
use App\Models\PelangganModel;

class DashboardController extends BaseController
{
    public function index()
    {
        $layananModel   = new LayananModel();
        $pelangganModel = new PelangganModel();
        $cart           = \Config\Services::cart();

        $data = [
            'title'           => 'Dashboard',
            'jumlah_layanan'  => $layananModel->countAll(),
            'jumlah_pelanggan' => $pelangganModel->countAll(),
            'jumlah_cart'     => count($cart->contents()),
        ];

        return view('dashboard/index', $data);
    }
}
