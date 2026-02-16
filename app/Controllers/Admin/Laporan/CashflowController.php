<?php

namespace App\Controllers\Admin\Laporan;

use App\Controllers\BaseController;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class CashflowController extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $builder = $this->db->table('pembayaran pb');
        $builder->select("
            DATE(pb.created_at) as tanggal,
            COUNT(pb.id_pembayaran) as total_transaksi,
            SUM(pb.jumlah_bayar) as total_cash_in
        ");
        $builder->where('pb.status_verifikasi','valid');
        $builder->groupBy('DATE(pb.created_at)');
        $builder->orderBy('tanggal','DESC');

        $data['rows'] = $builder->get()->getResult();

        return view('admin/laporan/cashflow/index',$data);
    }

    public function export()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->fromArray([
            'Tanggal','Total Transaksi','Total Cash In'
        ], NULL, 'A1');

        $builder = $this->db->table('pembayaran pb');
        $builder->select("
            DATE(pb.created_at),
            COUNT(pb.id_pembayaran),
            SUM(pb.jumlah_bayar)
        ");
        $builder->where('pb.status_verifikasi','valid');
        $builder->groupBy('DATE(pb.created_at)');

        $rows = $builder->get()->getResultArray();
        $sheet->fromArray($rows,NULL,'A2');

        $writer = new Xlsx($spreadsheet);
        $filename = 'Cashflow_Report_'.date('YmdHis').'.xlsx';

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }
}
