<?php

namespace App\Controllers;

use App\Models\LayananModel;

class CartController extends BaseController
{
    protected $cart;
    protected $layananModel;

    public function __construct()
    {
        $this->cart         = \Config\Services::cart();
        $this->layananModel = new LayananModel();
    }

    /**
     * Tampilkan halaman keranjang
     */
    public function index()
    {
        $data = [
            'title'    => 'Keranjang',
            'contents' => $this->cart->contents(),
            'total'    => $this->cart->total(),
        ];

        return view('cart/index', $data);
    }

    /**
     * Tambah item ke keranjang (insert)
     */
    public function add()
    {
        $id  = $this->request->getPost('layanan_id');
        $qty = (int) $this->request->getPost('qty');

        $layanan = $this->layananModel->find($id);

        if (!$layanan) {
            return redirect()->to('/layanan')->with('error', 'Layanan tidak ditemukan.');
        }

        if ($qty < 1) {
            $qty = 1;
        }

        $item = [
            'id'      => $layanan['id'],
            'qty'     => $qty,
            'price'   => $layanan['harga'],
            'name'    => $layanan['nama_layanan'],
            'options' => ['estimasi_hari' => $layanan['estimasi_hari']],
        ];

        $this->cart->insert($item);

        return redirect()->to('/cart')->with('success', 'Layanan "' . $layanan['nama_layanan'] . '" berhasil ditambahkan ke keranjang.');
    }

    /**
     * Update quantity item keranjang
     */
    public function update()
    {
        $rowid = $this->request->getPost('rowid');
        $qty   = (int) $this->request->getPost('qty');

        if ($qty < 1) {
            // Jika qty 0, hapus item
            $this->cart->remove($rowid);
            return redirect()->to('/cart')->with('success', 'Item berhasil dihapus dari keranjang.');
        }

        $this->cart->update([
            'rowid' => $rowid,
            'qty'   => $qty,
        ]);

        return redirect()->to('/cart')->with('success', 'Keranjang berhasil diperbarui.');
    }

    /**
     * Hapus item dari keranjang (remove)
     */
    public function remove(string $rowid)
    {
        $this->cart->remove($rowid);
        return redirect()->to('/cart')->with('success', 'Item berhasil dihapus dari keranjang.');
    }

    /**
     * Kosongkan keranjang (destroy)
     */
    public function destroy()
    {
        $this->cart->destroy();
        return redirect()->to('/cart')->with('success', 'Keranjang berhasil dikosongkan.');
    }
}
