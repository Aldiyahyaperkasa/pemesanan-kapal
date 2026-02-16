<?php

namespace App\Controllers\Pemesanan;

use App\Controllers\BaseController;
use App\Libraries\WhatsAppService;

class PemesananController extends BaseController
{
    protected $kapalModel;
    protected $pemesananModel;

    public function __construct()
    {
        $this->kapalModel = new \App\Models\KapalModel();
        $this->pemesananModel = new \App\Models\PemesananModel();
    }

    // ==============================
    // TAMPILKAN FORM
    // ==============================
    public function form($id_kapal)
    {
        $kapal = $this->kapalModel->find($id_kapal);

        if (!$kapal || !$kapal['tersedia']) {
            return redirect()->to('/')->with('error', 'Kapal tidak tersedia');
        }

        return view('pemesanan/form_pemesanan', [
            'kapal' => $kapal
        ]);
    }

    // ==============================
    // SIMPAN PEMESANAN
    // ==============================
    public function simpan()
    {
        $idKapal = $this->request->getPost('id_kapal');
        $kapal   = $this->kapalModel->find($idKapal);

        if (!$kapal) {
            return redirect()->back()->with('error', 'Kapal tidak ditemukan');
        }

        $jumlahPenumpang = (int)$this->request->getPost('jumlah_penumpang');

        if ($jumlahPenumpang > $kapal['max_penumpang']) {
            return redirect()->back()->with('error', 'Jumlah penumpang melebihi kapasitas kapal');
        }

        // Hitung total harga
        if ($kapal['jenis_kapal'] == 'rombongan') {
            $totalHarga = $kapal['harga'];
        } else {
            $totalHarga = $kapal['harga'] * $jumlahPenumpang;
        }

        // Generate kode booking unik
        $kodeBooking = 'BB-' . date('ymd') . '-' . rand(100,999);

        $data = [
            'kode_booking'      => $kodeBooking,
            'nama_pemesan'      => $this->request->getPost('nama_pemesan'),
            'no_hp'             => $this->request->getPost('no_hp'),
            'email'             => $this->request->getPost('email'),
            'id_kapal'          => $idKapal,
            'jumlah_penumpang'  => $jumlahPenumpang,
            'tanggal_berangkat' => $this->request->getPost('tanggal_berangkat'),
            'tanggal_kembali'   => $this->request->getPost('tanggal_kembali'),
            'total_harga'       => $totalHarga,
            'status_booking'    => 'menunggu_konfirmasi'
        ];

        $this->pemesananModel->insert($data);

        // ==========================
        // KIRIM WHATSAPP OTOMATIS
        // ==========================

        $wa = new WhatsAppService();

        $nomor = $data['no_hp'];

        // Ubah 08xxxx → 628xxxx
        if (substr($nomor, 0, 1) == '0') {
            $nomor = '62' . substr($nomor, 1);
        }

        $linkCek = base_url('cek-booking/' . $kodeBooking);

        $pesan = "Halo {$data['nama_pemesan']},

Pemesanan Anda sedang dalam proses konfirmasi.
Kode Booking: {$kodeBooking}

Admin akan menghubungi Anda melalui WhatsApp.

Anda juga dapat memantau status pesanan melalui link berikut:
{$linkCek}

Terima kasih.";

        $wa->kirim($nomor, $pesan);

        // Redirect ke halaman cek booking
        return redirect()->to('/cek-booking/' . $kodeBooking);
    }

    // ==============================
    // CEK STATUS BOOKING
    // ==============================
    public function cekBooking($kode)
    {
        $booking = $this->pemesananModel
            ->select('pemesanan.*, kapal.nama_kapal')
            ->join('kapal', 'kapal.id_kapal = pemesanan.id_kapal')
            ->where('kode_booking', $kode)
            ->first();

        if (!$booking) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('pemesanan/cek_booking', [
            'booking' => $booking
        ]);
    }
// ==============================
// UPLOAD BUKTI DP
// ==============================
public function uploadBuktiDP()
{
    $kodeBooking = $this->request->getPost('kode_booking');

    $booking = $this->pemesananModel
        ->where('kode_booking', $kodeBooking)
        ->first();

    if (!$booking) {
        return redirect()->back()->with('error', 'Data booking tidak ditemukan');
    }

    $file = $this->request->getFile('bukti_bayar');

    if (!$file->isValid()) {
        return redirect()->back()->with('error', 'File tidak valid');
    }

    // Generate nama file unik
    $newName = 'DP-' . $kodeBooking . '-' . time() . '.' . $file->getExtension();

    // Simpan file ke folder public/uploads/bukti_dp
    $file->move(FCPATH . 'uploads/bukti_dp', $newName);

    // Simpan ke tabel pembayaran
    $this->db = \Config\Database::connect();

    $this->db->table('pembayaran')->insert([
        'id_pemesanan'     => $booking['id_pemesanan'],
        'jenis_pembayaran' => 'dp',
        'jumlah_bayar'     => $booking['nominal_dp'],
        'metode'           => 'transfer',
        'bukti_bayar'      => $newName,
        'status_verifikasi'=> 'menunggu'
    ]);

    // Update status booking jadi dp_dibayar
    $this->pemesananModel->update(
        $booking['id_pemesanan'],
        ['status_booking' => 'dp_dibayar']
    );

    return redirect()->to('/cek-booking/' . $kodeBooking)
                     ->with('success', 'Bukti pembayaran berhasil diupload');
}

}
