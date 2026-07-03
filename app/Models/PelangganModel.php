<?php

namespace App\Models;

use CodeIgniter\Model;

class PelangganModel extends Model
{
    protected $table            = 'pelanggan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $allowedFields    = ['nama', 'alamat', 'no_hp'];
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
    protected $deletedField     = 'deleted_at';

    // Validation rules
    protected $validationRules = [
        'nama'  => 'required|min_length[2]|max_length[100]',
        'alamat' => 'permit_empty|max_length[500]',
        'no_hp' => 'permit_empty|min_length[8]|max_length[20]',
    ];

    protected $validationMessages = [
        'nama' => [
            'required'   => 'Nama pelanggan wajib diisi.',
            'min_length' => 'Nama minimal 2 karakter.',
        ],
        'no_hp' => [
            'min_length' => 'No. HP minimal 8 karakter.',
            'max_length' => 'No. HP maksimal 20 karakter.',
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
        return $this->like('nama', $keyword)
            ->orLike('no_hp', $keyword)
            ->paginate($perPage);
    }
}
