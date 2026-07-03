<?php

namespace App\Models;

use CodeIgniter\Model;

class LayananModel extends Model
{
    protected $table            = 'layanan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $allowedFields    = ['nama_layanan', 'harga', 'estimasi_hari'];
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
    protected $deletedField     = 'deleted_at';

    // Validation rules
    protected $validationRules = [
        'nama_layanan'  => 'required|min_length[3]|max_length[100]',
        'harga'         => 'required|numeric|greater_than[0]',
        'estimasi_hari' => 'required|integer|greater_than[0]',
    ];

    protected $validationMessages = [
        'nama_layanan' => [
            'required'   => 'Nama layanan wajib diisi.',
            'min_length' => 'Nama layanan minimal 3 karakter.',
        ],
        'harga' => [
            'required'      => 'Harga wajib diisi.',
            'numeric'       => 'Harga harus berupa angka.',
            'greater_than'  => 'Harga harus lebih dari 0.',
        ],
        'estimasi_hari' => [
            'required'      => 'Estimasi hari wajib diisi.',
            'integer'       => 'Estimasi hari harus berupa angka.',
            'greater_than'  => 'Estimasi hari harus lebih dari 0.',
        ],
    ];

    /**
     * Get data yang sudah dihapus (trash)
     */
    public function getTrash()
    {
        return $this->onlyDeleted()->findAll();
    }

    /**
     * Restore data dari trash
     */
    public function restore(int $id)
    {
        return $this->db->table($this->table)
            ->where('id', $id)
            ->update(['deleted_at' => null]);
    }

    /**
     * Force delete permanent
     */
    public function forceDelete(int $id)
    {
        return $this->db->table($this->table)
            ->where('id', $id)
            ->delete();
    }

    /**
     * Search dengan pagination
     */
    public function search(string $keyword, int $perPage = 10)
    {
        return $this->like('nama_layanan', $keyword)
            ->paginate($perPage);
    }
}
