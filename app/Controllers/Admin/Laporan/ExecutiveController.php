<?php

namespace App\Controllers\Admin\Laporan;

use App\Controllers\BaseController;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExecutiveController extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $builder = $this->db->table('pemesanan p');
        $builder->select("
            COUNT(p.id_pemesanan) as total_booking,
            SUM(p.jumlah_penumpang) as total_penumpang,
            SUM(p.total_harga) as total_revenue,
            SUM(CASE WHEN p.status_booking='selesai' THEN p.total_harga ELSE 0 END) as revenue_completed,
            SUM(CASE WHEN p.status_booking='dibatalkan' THEN 1 ELSE 0 END) as total_cancel
        ");

        $data['kpi'] = $builder->get()->getRow();

        return view('admin/laporan/executive/index', $data);
    }

    public function export()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->fromArray([
            ['Executive Business Report'],
            ['Tanggal Cetak : '.date('d-m-Y H:i')],
            [''],
            ['Total Booking','Total Penumpang','Total Revenue','Revenue Completed','Total Cancel']
        ], NULL, 'A1');

        $builder = $this->db->table('pemesanan');
        $builder->select("
            COUNT(id_pemesanan),
            SUM(jumlah_penumpang),
            SUM(total_harga),
            SUM(CASE WHEN status_booking='selesai' THEN total_harga ELSE 0 END),
            SUM(CASE WHEN status_booking='dibatalkan' THEN 1 ELSE 0 END)
        ");

        $data = $builder->get()->getRowArray();

        $sheet->fromArray([$data], NULL, 'A5');

        $writer = new Xlsx($spreadsheet);
        $filename = 'Executive_Report_'.date('YmdHis').'.xlsx';

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }
}
