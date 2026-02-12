<?php

namespace App\Models;

use CodeIgniter\Model;

class Doctor extends Model
{
    protected $table            = 'tbl_doctor';
    protected $primaryKey       = 'id_doctor';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama_doctor', 'profil', 'foto'];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    /**
     * Get spesialis for this doctor
     */
    public function getSpesialis($id_doctor)
    {
        return $this->db->table('tbl_doctor_spesialis')
            ->select('tbl_spesialis.*')
            ->join('tbl_spesialis', 'tbl_spesialis.id_spesialis = tbl_doctor_spesialis.id_spesialis')
            ->where('tbl_doctor_spesialis.id_doctor', $id_doctor)
            ->get()
            ->getResultArray();
    }

    /**
     * Get poli for this doctor
     */
    public function getPoli($id_doctor)
    {
        return $this->db->table('tbl_doctor_poli')
            ->select('tbl_poli.*')
            ->join('tbl_poli', 'tbl_poli.id_poli = tbl_doctor_poli.id_poli')
            ->where('tbl_doctor_poli.id_doctor', $id_doctor)
            ->get()
            ->getResultArray();
    }

    /**
     * Get jadwal for this doctor
     */
    public function getJadwal($id_doctor)
    {
        $db = \Config\Database::connect();
        return $db->table('tbl_jadwal')
            ->where('id_doctor', $id_doctor)
            ->get()
            ->getResultArray();
    }
}
