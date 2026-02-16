<?php

namespace App\Controllers\Admin\Laporan;

use App\Controllers\BaseController;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class OperationalController extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $builder = $this->db->table('kapal k');
        $builder->select("
            k.nama_kapal,
            pk.nama_lengkap as pemilik,
            COUNT(p.id_pemesanan) as total_trip,
            SUM(p.jumlah_penumpang) as total_penumpang,
            SUM(p.total_harga) as total_revenue
        ");
        $builder->join('pemesanan p','p.id_kapal=k.id_kapal','left');
        $builder->join('pemilik_kapal pk','pk.id_pemilik=k.id_pemilik');
        $builder->groupBy('k.id_kapal');

        $data['rows'] = $builder->get()->getResult();

        return view('admin/laporan/operational/index',$data);
    }

    public function export()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->fromArray([
            'Nama Kapal','Pemilik','Total Trip',
            'Total Penumpang','Total Revenue'
        ], NULL, 'A1');

        $builder = $this->db->table('kapal k');
        $builder->select("
            k.nama_kapal,
            pk.nama_lengkap,
            COUNT(p.id_pemesanan),
            SUM(p.jumlah_penumpang),
            SUM(p.total_harga)
        ");
        $builder->join('pemesanan p','p.id_kapal=k.id_kapal','left');
        $builder->join('pemilik_kapal pk','pk.id_pemilik=k.id_pemilik');
        $builder->groupBy('k.id_kapal');

        $rows = $builder->get()->getResultArray();
        $sheet->fromArray($rows,NULL,'A2');

        $writer = new Xlsx($spreadsheet);
        $filename = 'Operational_Report_'.date('YmdHis').'.xlsx';

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }
}
