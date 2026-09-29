<?php

namespace App\Controllers;

use App\Models\ModelNilai;
use App\Models\ModelStatus;
use App\Models\ModelAkun3;
use App\Models\ModelTransaksi;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use TCPDF;

class JurnalPenyesuaian extends BaseController
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

        $rowdata = $this->objTransaksi->get_jpenyesuaian($tglawal, $tglakhir);
        $data['dttransaksi'] = $rowdata;
        $data['tglawal'] = $tglawal;
        $data['tglakhir'] = $tglakhir;

        return view('jurnalpenyesuaian/index', $data);
    }

    public function cetak_jppdf()
    {
        $tglawal = $this->request->getVar('tglawal') ? $this->request->getVar('tglawal') : "";
        $tglakhir = $this->request->getVar('tglakhir') ? $this->request->getVar('tglakhir') : "";

        $rowdata = $this->objTransaksi->get_jpenyesuaian($tglawal, $tglakhir);
        $data = [
            'dttransaksi' => $rowdata,
            'tglawal' => $tglawal,
            'tglakhir' => $tglakhir,
        ];

        $html = view('jurnalpenyesuaian/cetak_jppdf', $data);
        $pdf = new TCPDF('P', PDF_UNIT, 'A4', true, 'UTF-8', false);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetMargins(30, 4, 3);
        $pdf->SetFont('helvetica', '', 8);
        $pdf->AddPage();
        $pdf->writeHTML($html, true, false, true, false, '');
        $this->response->setContentType('application/pdf');
        $pdf->Output('jurnalpenyesuaian.pdf', 'I');
    }
}
