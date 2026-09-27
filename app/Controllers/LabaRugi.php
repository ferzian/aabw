<?php

namespace App\Controllers;

use App\Models\ModelNilai;
use App\Models\ModelStatus;
use App\Models\ModelAkun3;
use App\Models\ModelTransaksi;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use TCPDF;

class LabaRugi extends BaseController
{
    function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->objTransaksi = new ModelTransaksi();
        $this->objNilai = new ModelNilai();
        $this->objStatus = new ModelStatus();
        $this->objAkun3 = new ModelAkun3();
    }

    public function index()
    {
        $tglawal = $this->request->getVar('tglawal') ? $this->request->getVar('tglawal') : "";
        $tglakhir = $this->request->getVar('tglakhir') ? $this->request->getVar('tglakhir') : "";

        $rowdata = $this->objTransaksi->get_labarugi($tglawal, $tglakhir);

        $data['dttransaksi'] = $rowdata;
        $data['tglawal'] = $tglawal;
        $data['tglakhir'] = $tglakhir;
        return view('labarugi/index', $data);
    }
}
