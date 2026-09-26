<?php

namespace App\Controllers;

use App\Models\ModelNilai;
use App\Models\ModelStatus;
use App\Models\ModelAkun3;
use App\Models\ModelTransaksi;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use TCPDF;

class JurnalUmum extends BaseController
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

        $rowdata = $this->objTransaksi->get_jurnalumum($tglawal, $tglakhir);
        $i = 0;
        $temp1 = '';
        $temp2 = '';

        foreach ($rowdata as $row) {
            $tgl = ($temp1 == $row->tanggal && $temp2 == $row->kwitansi) ? '' : $row->tanggal;
            $temp1 = $row->tanggal;
            $temp2 = $row->kwitansi;
            $rowdata[$i]->tanggal = $tgl;
            $i++;
        }

        $data['dttransaksi'] = $rowdata;
        $data['tglawal'] = $tglawal;
        $data['tglakhir'] = $tglakhir;
        return view('jurnalumum/index', $data);
    }

    public function cetakjupdf()
    {
        $tglawal = $this->request->getVar('tglawal') ? $this->request->getVar('tglawal') : "";
        $tglakhir = $this->request->getVar('tglakhir') ? $this->request->getVar('tglakhir') : "";

        $rowdata = $this->objTransaksi->get_jurnalumum($tglawal, $tglakhir);
        $i = 0;
        $temp1 = '';
        $temp2 = '';

        foreach ($rowdata as $row) {
            $tgl = ($temp1 == $row->tanggal && $temp2 == $row->kwitansi) ? '' : $row->tanggal;
            $temp1 = $row->tanggal;
            $temp2 = $row->kwitansi;
            $rowdata[$i]->tanggal = $tgl;
            $i++;
        }

        $data = [
            'dttransaksi' => $rowdata,
            'tglawal' => $tglawal,
            'tglakhir' => $tglakhir,
        ];

        $html = view('jurnalumum/cetakjupdf', $data);
        // create new PDF document
        $pdf = new TCPDF('P', PDF_UNIT, 'A4', true, 'UTF-8', false);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        // set margin
        $pdf->SetMargins(30, 4, 3);

        // set font
        $pdf->SetFont('helvetica', '', 8);

        // add a page
        $pdf->AddPage();

        // Print text using writenHTMLCall()
        $pdf->writeHTML($html, true, false, true, false, '');

        $this->response->setContentType('application/pdf');
        $pdf->Output('jurnalumum.pdf', 'I');
    }
}
