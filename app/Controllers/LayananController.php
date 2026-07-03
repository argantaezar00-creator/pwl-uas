<?php

namespace App\Controllers;

use App\Models\LayananModel;
use Dompdf\Dompdf;
use Dompdf\Options;

class LayananController extends BaseController
{
    protected $layananModel;
    protected $validation;

    public function __construct()
    {
        $this->layananModel = new LayananModel();
        $this->validation   = \Config\Services::validation();
    }

    /**
     * Daftar Layanan dengan Search & Pagination
     */
    public function index()
    {
        $keyword = $this->request->getGet('q');
        $perPage = 10;

        if ($keyword) {
            $layanan = $this->layananModel->like('nama_layanan', $keyword)->paginate($perPage, 'layanan');
        } else {
            $layanan = $this->layananModel->paginate($perPage, 'layanan');
        }

        $data = [
            'title'   => 'Data Layanan',
            'layanan' => $layanan,
            'pager'   => $this->layananModel->pager,
            'keyword' => $keyword,
        ];

        return view('layanan/index', $data);
    }

    /**
     * Form Tambah Layanan
     */
    public function create()
    {
        return view('layanan/create', ['title' => 'Tambah Layanan']);
    }

    /**
     * Simpan Layanan Baru
     */
    public function store()
    {
        $rules = [
            'nama_layanan'  => 'required|min_length[3]|max_length[100]',
            'harga'         => 'required|numeric|greater_than[0]',
            'estimasi_hari' => 'required|integer|greater_than[0]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->layananModel->save([
            'nama_layanan'  => $this->request->getPost('nama_layanan'),
            'harga'         => $this->request->getPost('harga'),
            'estimasi_hari' => $this->request->getPost('estimasi_hari'),
        ]);

        return redirect()->to('/layanan')->with('success', 'Layanan berhasil ditambahkan.');
    }

    /**
     * Form Edit Layanan
     */
    public function edit(int $id)
    {
        $layanan = $this->layananModel->find($id);

        if (!$layanan) {
            return redirect()->to('/layanan')->with('error', 'Layanan tidak ditemukan.');
        }

        return view('layanan/edit', [
            'title'   => 'Edit Layanan',
            'layanan' => $layanan,
        ]);
    }

    /**
     * Update Layanan
     */
    public function update(int $id)
    {
        $rules = [
            'nama_layanan'  => 'required|min_length[3]|max_length[100]',
            'harga'         => 'required|numeric|greater_than[0]',
            'estimasi_hari' => 'required|integer|greater_than[0]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->layananModel->update($id, [
            'nama_layanan'  => $this->request->getPost('nama_layanan'),
            'harga'         => $this->request->getPost('harga'),
            'estimasi_hari' => $this->request->getPost('estimasi_hari'),
        ]);

        return redirect()->to('/layanan')->with('success', 'Layanan berhasil diperbarui.');
    }

    /**
     * Soft Delete
     */
    public function delete(int $id)
    {
        $layanan = $this->layananModel->find($id);

        if (!$layanan) {
            return redirect()->to('/layanan')->with('error', 'Layanan tidak ditemukan.');
        }

        $this->layananModel->delete($id);
        return redirect()->to('/layanan')->with('success', 'Layanan berhasil dihapus (dipindah ke tong sampah).');
    }

    /**
     * Halaman Trash (Data Terhapus)
     */
    public function trash()
    {
        $data = [
            'title'   => 'Tong Sampah - Layanan',
            'layanan' => $this->layananModel->getTrash(),
        ];

        return view('layanan/trash', $data);
    }

    /**
     * Restore Layanan
     */
    public function restore(int $id)
    {
        $this->layananModel->restore($id);
        return redirect()->to('/layanan/trash')->with('success', 'Layanan berhasil dipulihkan.');
    }

    /**
     * Force Delete (Hapus Permanen)
     */
    public function forceDelete(int $id)
    {
        $this->layananModel->forceDelete($id);
        return redirect()->to('/layanan/trash')->with('success', 'Layanan berhasil dihapus secara permanen.');
    }

    /**
     * Export PDF menggunakan DomPDF
     */
    public function exportPdf()
    {
        $layanan = $this->layananModel->findAll();

        $html = view('layanan/pdf', ['layanan' => $layanan]);

        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $options->set('defaultFont', 'DejaVu Sans');

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream('daftar-layanan-' . date('Ymd') . '.pdf', ['Attachment' => false]);
        exit;
    }
}
