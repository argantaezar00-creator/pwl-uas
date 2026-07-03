<?php

namespace App\Controllers;

use App\Models\PelangganModel;

class PelangganController extends BaseController
{
    protected $pelangganModel;

    public function __construct()
    {
        $this->pelangganModel = new PelangganModel();
    }

    /**
     * Daftar Pelanggan dengan Search & Pagination
     */
    public function index()
    {
        $keyword = $this->request->getGet('q');
        $perPage = 10;

        if ($keyword) {
            $pelanggan = $this->pelangganModel
                ->groupStart()
                    ->like('nama', $keyword)
                    ->orLike('no_hp', $keyword)
                ->groupEnd()
                ->paginate($perPage, 'pelanggan');
        } else {
            $pelanggan = $this->pelangganModel->paginate($perPage, 'pelanggan');
        }

        $data = [
            'title'     => 'Data Pelanggan',
            'pelanggan' => $pelanggan,
            'pager'     => $this->pelangganModel->pager,
            'keyword'   => $keyword,
        ];

        return view('pelanggan/index', $data);
    }

    /**
     * Form Tambah Pelanggan
     */
    public function create()
    {
        return view('pelanggan/create', ['title' => 'Tambah Pelanggan']);
    }

    /**
     * Simpan Pelanggan Baru
     */
    public function store()
    {
        $rules = [
            'nama'   => 'required|min_length[2]|max_length[100]',
            'alamat' => 'permit_empty|max_length[500]',
            'no_hp'  => 'permit_empty|min_length[8]|max_length[20]',
        ];

        $messages = [
            'nama' => [
                'required'   => 'Nama pelanggan wajib diisi.',
                'min_length' => 'Nama minimal 2 karakter.',
            ],
            'no_hp' => [
                'min_length' => 'No. HP minimal 8 karakter.',
            ],
        ];

        if (!$this->validate($rules, $messages)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->pelangganModel->save([
            'nama'   => $this->request->getPost('nama'),
            'alamat' => $this->request->getPost('alamat'),
            'no_hp'  => $this->request->getPost('no_hp'),
        ]);

        return redirect()->to('/pelanggan')->with('success', 'Pelanggan berhasil ditambahkan.');
    }

    /**
     * Form Edit Pelanggan
     */
    public function edit(int $id)
    {
        $pelanggan = $this->pelangganModel->find($id);

        if (!$pelanggan) {
            return redirect()->to('/pelanggan')->with('error', 'Pelanggan tidak ditemukan.');
        }

        return view('pelanggan/edit', [
            'title'     => 'Edit Pelanggan',
            'pelanggan' => $pelanggan,
        ]);
    }

    /**
     * Update Pelanggan
     */
    public function update(int $id)
    {
        $rules = [
            'nama'   => 'required|min_length[2]|max_length[100]',
            'alamat' => 'permit_empty|max_length[500]',
            'no_hp'  => 'permit_empty|min_length[8]|max_length[20]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->pelangganModel->update($id, [
            'nama'   => $this->request->getPost('nama'),
            'alamat' => $this->request->getPost('alamat'),
            'no_hp'  => $this->request->getPost('no_hp'),
        ]);

        return redirect()->to('/pelanggan')->with('success', 'Pelanggan berhasil diperbarui.');
    }

    /**
     * Soft Delete
     */
    public function delete(int $id)
    {
        $pelanggan = $this->pelangganModel->find($id);

        if (!$pelanggan) {
            return redirect()->to('/pelanggan')->with('error', 'Pelanggan tidak ditemukan.');
        }

        $this->pelangganModel->delete($id);
        return redirect()->to('/pelanggan')->with('success', 'Pelanggan berhasil dihapus (dipindah ke tong sampah).');
    }

    /**
     * Halaman Trash
     */
    public function trash()
    {
        $data = [
            'title'     => 'Tong Sampah - Pelanggan',
            'pelanggan' => $this->pelangganModel->getTrash(),
        ];

        return view('pelanggan/trash', $data);
    }

    /**
     * Restore Pelanggan
     */
    public function restore(int $id)
    {
        $this->pelangganModel->restore($id);
        return redirect()->to('/pelanggan/trash')->with('success', 'Pelanggan berhasil dipulihkan.');
    }

    /**
     * Force Delete
     */
    public function forceDelete(int $id)
    {
        $this->pelangganModel->forceDelete($id);
        return redirect()->to('/pelanggan/trash')->with('success', 'Pelanggan berhasil dihapus secara permanen.');
    }
}
