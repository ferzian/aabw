<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelTransaksi extends Model
{
    protected $table = 'tbl_transaksi';
    protected $primaryKey = 'id_transaksi';
    // protected $useAutoIncrement = true;
    protected $returnType = 'object';
    // protected $useSoftDeletes   = false;
    // protected $protectFields    = true;
    protected $allowedFields = ['kwitansi', 'tanggal', 'deskripsi', 'ketjurnal'];

    // protected bool $allowEmptyInserts = false;
    // protected bool $updateOnlyChanged = true;

    // protected array $casts = [];
    // protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    // protected $dateFormat = 'datetime';
    // protected $createdField = 'created_at';
    // protected $updatedField = 'updated_at';
    // protected $deletedField = 'deleted_at';

    // Validation
    // protected $validationRules = [];
    // protected $validationMessages = [];
    // protected $skipValidation = false;
    // protected $cleanValidationRules = true;

    // Callbacks
    // protected $allowCallbacks = true;
    // protected $beforeInsert = [];
    // protected $afterInsert = [];
    // protected $beforeUpdate = [];
    // protected $afterUpdate = [];
    // protected $beforeFind = [];
    // protected $afterFind = [];
    // protected $beforeDelete = [];
    // protected $afterDelete = [];

    public function noKwitansi()
    {
        $number = $this->db->table('tbl_transaksi')->select('RIGHT(tbl_transaksi.kwitansi,4) as kwitansi', FALSE)
            ->orderBy('kwitansi', 'DESC')->limit(1)->get()->getRowArray();

        if ($number == null) {
            $no = 1;
        } else {
            $no = intval($number['kwitansi']) + 1;
        }
        $nomor_kwitansi = str_pad($no, 4, "0", STR_PAD_LEFT);
        return $nomor_kwitansi;
    }

    public function get_jurnalumum($tglawal, $tglakhir)
    {
        $sql = $this->db->table('tbl_nilai')
            ->join('tbl_transaksi', 'tbl_transaksi.id_transaksi=tbl_nilai.id_transaksi')
            ->join('akun3s', 'akun3s.kode_akun3=tbl_nilai.kode_akun3')
            ->orderBy('id_nilai');
        if ($tglawal && $tglakhir) {
            $sql->where('tanggal >=', $tglawal)->where('tanggal <=', $tglakhir);
        }
        return $sql->get()->getResultObject();
    }

    public function get_posting($tglawal, $tglakhir, $kode_akun3)
    {
        $sql = $this->db->table('tbl_nilai')
            ->join('tbl_transaksi', 'tbl_transaksi.id_transaksi=tbl_nilai.id_transaksi')
            ->join('akun3s', 'akun3s.kode_akun3=tbl_nilai.kode_akun3')
            ->orderBy('akun3s.kode_akun3');
        if ($tglawal && $tglakhir) {
            $sql->where('tanggal >=', $tglawal)->where('tanggal <=', $tglakhir)->where('tbl_nilai.kode_akun3=', $kode_akun3);
        }

        // Filter tanggal (jika diisi)
        // if (!empty($tglawal) && !empty($tglakhir)) {
        //     $sql->where('tanggal >=', $tglawal)->where('tanggal <=', $tglakhir);
        // }

        // Filter kode akun (jika dipilih)
        // if (!empty($kode_akun3) && $kode_akun3 !== 'Pilih Kode Akun') {
        //     $sql->where('tbl_nilai.kode_akun3', $kode_akun3);
        // }

        return $sql->get()->getResultObject();
    }
}