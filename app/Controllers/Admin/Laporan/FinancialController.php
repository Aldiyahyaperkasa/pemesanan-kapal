<?php

namespace App\Controllers\Admin\Laporan;

use App\Controllers\BaseController;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class FinancialController extends BaseController
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
            p.kode_booking,
            p.nama_pemesan,
            p.no_hp,
            k.nama_kapal,
            pk.nama_lengkap AS pemilik,
            p.tanggal_berangkat,
            p.jumlah_penumpang,
            p.total_harga,
            IFNULL(SUM(CASE WHEN pb.jenis_pembayaran='dp' 
                AND pb.status_verifikasi='valid' 
                THEN pb.jumlah_bayar END),0) as total_dp,
            IFNULL(SUM(CASE WHEN pb.jenis_pembayaran='pelunasan' 
                AND pb.status_verifikasi='valid' 
                THEN pb.jumlah_bayar END),0) as total_pelunasan,
            p.status_booking,
            p.created_at
        ");

        $builder->join('kapal k','k.id_kapal=p.id_kapal');
        $builder->join('pemilik_kapal pk','pk.id_pemilik=k.id_pemilik');
        $builder->join('pembayaran pb','pb.id_pemesanan=p.id_pemesanan','left');
        $builder->groupBy('p.id_pemesanan');

        $data['rows'] = $builder->get()->getResult();

        return view('admin/laporan/financial/index', $data);
    }

    public function export()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->fromArray([
            'Kode Booking','Nama Pemesan','No HP','Kapal','Pemilik',
            'Tanggal Berangkat','Penumpang','Total Harga',
            'Total DP','Total Pelunasan','Outstanding','Status','Tanggal Booking'
        ], NULL, 'A1');

        $builder = $this->db->table('pemesanan p');
        $builder->select("
            p.kode_booking,
            p.nama_pemesan,
            p.no_hp,
            k.nama_kapal,
            pk.nama_lengkap,
            p.tanggal_berangkat,
            p.jumlah_penumpang,
            p.total_harga,
            IFNULL(SUM(CASE WHEN pb.jenis_pembayaran='dp' 
                AND pb.status_verifikasi='valid' 
                THEN pb.jumlah_bayar END),0) as total_dp,
            IFNULL(SUM(CASE WHEN pb.jenis_pembayaran='pelunasan' 
                AND pb.status_verifikasi='valid' 
                THEN pb.jumlah_bayar END),0) as total_pelunasan,
            (p.total_harga - IFNULL(SUM(CASE WHEN pb.status_verifikasi='valid' THEN pb.jumlah_bayar END),0)) as outstanding,
            p.status_booking,
            p.created_at
        ");

        $builder->join('kapal k','k.id_kapal=p.id_kapal');
        $builder->join('pemilik_kapal pk','pk.id_pemilik=k.id_pemilik');
        $builder->join('pembayaran pb','pb.id_pemesanan=p.id_pemesanan','left');
        $builder->groupBy('p.id_pemesanan');

        $rows = $builder->get()->getResultArray();

        $sheet->fromArray($rows, NULL, 'A2');

        $writer = new Xlsx($spreadsheet);
        $filename = 'Financial_Report_'.date('YmdHis').'.xlsx';

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }
}
