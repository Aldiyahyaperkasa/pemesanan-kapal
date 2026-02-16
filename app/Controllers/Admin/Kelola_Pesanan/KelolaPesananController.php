<?php

namespace App\Controllers\Admin\Kelola_Pesanan;

use App\Controllers\BaseController;
use App\Models\TiketModel;
use Dompdf\Dompdf;
use Dompdf\Options;

use App\Libraries\WhatsAppService;

class KelolaPesananController extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

public function index()
{
    $filter = $this->request->getGet('filter');

    $builder = $this->db->table('pemesanan');
    $builder->select('
        pemesanan.*, 
        kapal.nama_kapal,
        pembayaran_terakhir.id_pembayaran,
        pembayaran_terakhir.bukti_bayar,
        pembayaran_terakhir.status_verifikasi,
        pembayaran_terakhir.alasan_penolakan as alasan_penolakan_dp
    ');

    $builder->join('kapal', 'kapal.id_kapal = pemesanan.id_kapal');

    // =========================
    // SUBQUERY AMBIL DP TERAKHIR
    // =========================
    $builder->join(
        '(SELECT p1.*
          FROM pembayaran p1
          INNER JOIN (
              SELECT id_pemesanan, MAX(id_pembayaran) as max_id
              FROM pembayaran
              WHERE jenis_pembayaran = "dp"
              GROUP BY id_pemesanan
          ) p2 ON p1.id_pembayaran = p2.max_id
        ) as pembayaran_terakhir',
        'pembayaran_terakhir.id_pemesanan = pemesanan.id_pemesanan',
        'left'
    );

    // =========================
    // FILTER LOGIC BARU
    // =========================

    if ($filter == 'baru') {
        $builder->where('pemesanan.status_booking', 'menunggu_konfirmasi');
    }

    elseif ($filter == 'menunggu_dp') {
        $builder->where('pemesanan.status_booking', 'menunggu_dp');
        $builder->where('pembayaran_terakhir.id_pembayaran IS NULL', null, false);
    }

    elseif ($filter == 'verifikasi_dp') {
        $builder->where('pemesanan.status_booking', 'dp_dibayar');
        $builder->where('pembayaran_terakhir.status_verifikasi', 'menunggu');
    }

    elseif ($filter == 'dp_ditolak') {
        $builder->where('pemesanan.status_booking', 'menunggu_dp');
        $builder->where('pembayaran_terakhir.status_verifikasi', 'ditolak');
    }

    elseif ($filter == 'selesai') {
        $builder->where('pemesanan.status_booking', 'disetujui');
    }

    elseif ($filter == 'ditolak') {
        $builder->where('pemesanan.status_booking', 'ditolak');
    }



    $builder->orderBy('pemesanan.created_at', 'DESC');

    $data['pemesanan'] = $builder->get()->getResultArray();
    $data['current_filter'] = $filter;

    return view('admin/kelola_pesanan/index', $data);
}

    // ======================================================
    // 1. LIST DATA PEMESANAN (MASUK KE ADMIN)
    // ======================================================
    // public function index()
    // {
    //     $builder = $this->db->table('pemesanan');
        // $builder->select('
        //     pemesanan.*, 
        //     kapal.nama_kapal, 
        //     kapal.id_pemilik,
        //     pemilik_kapal.nama_lengkap as nama_pemilik,
        //     pemilik_kapal.no_hp as no_hp_pemilik
        // ');
        // $builder->join('kapal', 'kapal.id_kapal = pemesanan.id_kapal');
        // $builder->join('pemilik_kapal', 'pemilik_kapal.id_pemilik = kapal.id_pemilik');
        // $builder->orderBy('pemesanan.created_at', 'DESC');
    //     $builder->select('pemesanan.*, kapal.nama_kapal, pembayaran.bukti_bayar, pembayaran.status_verifikasi');
    //     $builder->join('kapal', 'kapal.id_kapal = pemesanan.id_kapal');
    //     $builder->join('pembayaran', 'pembayaran.id_pemesanan = pemesanan.id_pemesanan AND pembayaran.jenis_pembayaran = "dp"', 'left');
    //     $builder->orderBy('pemesanan.created_at', 'DESC');
    //    $builder->groupBy('pemesanan.id_pemesanan');



    //     $data['pemesanan'] = $builder->get()->getResultArray();

    //     return view('admin/kelola_pesanan/index', $data);
    // }

    // ======================================================
    // 2. SETUJUI PEMESANAN
    // ======================================================
    public function setujui($id)
    {
        $pemesanan = $this->db->table('pemesanan')
            ->select('pemesanan.*, kapal.nama_kapal')
            ->join('kapal', 'kapal.id_kapal = pemesanan.id_kapal')
            ->where('id_pemesanan', $id)
            ->get()
            ->getRowArray();

        if (!$pemesanan) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        $nominalDP = 300000;

        // Update status
        $this->db->table('pemesanan')
            ->where('id_pemesanan', $id)
            ->update([
                'status_booking' => 'menunggu_dp',
                'nominal_dp'     => $nominalDP,
                'batas_waktu_dp' => date('Y-m-d H:i:s', strtotime('+1 day'))
            ]);

        // ===============================
        // FORMAT NOMOR WA PEMESAN
        // ===============================
        $no_hp = $pemesanan['no_hp'];
        if (substr($no_hp, 0, 1) == "0") {
            $no_hp = "62" . substr($no_hp, 1);
        }

        $link = base_url('cek-booking/' . $pemesanan['kode_booking']);

        $pesan = "Halo {$pemesanan['nama_pemesan']},\n\n"
            . "Pemesanan Anda dengan kode booking {$pemesanan['kode_booking']} telah DITERIMA.\n\n"
            . "Kapal: {$pemesanan['nama_kapal']}\n"
            . "Tanggal Berangkat: {$pemesanan['tanggal_berangkat']}\n"
            . "Total: Rp " . number_format($pemesanan['total_harga'], 0, ',', '.') . "\n\n"
            . "Silakan melakukan pembayaran DP sebesar Rp "
            . number_format($nominalDP, 0, ',', '.') . " ke rekening berikut:\n\n"
            . "Bank BRI\n"
            . "a.n Admin Beras Basah\n"
            . "123456789\n\n"
            . "Upload bukti pembayaran melalui link berikut:\n"
            . $link;

        // Kirim otomatis via API (bukan redirect wa.me)
        $wa = new WhatsAppService();
        $wa->kirim($no_hp, $pesan);

        return redirect()->to(site_url('admin/kelola-pesanan'))
            ->with('success', 'Pemesanan disetujui & WA terkirim');        
    }

    // ======================================================
    // 3. TOLAK PEMESANAN
    // ======================================================
    public function tolak($id)
    {
        $alasan = trim($this->request->getPost('alasan_penolakan'));

        if (!$alasan) {
            return redirect()->back()->with('error', 'Alasan penolakan wajib diisi');
        }

        $pemesanan = $this->db->table('pemesanan')
            ->where('id_pemesanan', $id)
            ->get()
            ->getRowArray();

        if (!$pemesanan) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        if ($pemesanan['status_booking'] === 'ditolak') {
            return redirect()->back()->with('error', 'Pemesanan sudah ditolak sebelumnya');
        }

        $this->db->table('pemesanan')
            ->where('id_pemesanan', $id)
            ->update([
                'status_booking'   => 'ditolak',
                'alasan_penolakan' => $alasan
            ]);

        $no_hp = $pemesanan['no_hp'] ?? '';

        if (substr($no_hp, 0, 1) == "0") {
            $no_hp = "62" . substr($no_hp, 1);
        }

        $pesan = "Halo {$pemesanan['nama_pemesan']},\n\n"
            . "Mohon maaf, pemesanan Anda dengan kode booking "
            . "{$pemesanan['kode_booking']} DITOLAK.\n\n"
            . "Alasan penolakan:\n{$alasan}\n\n"
            . "Silakan melakukan pemesanan ulang melalui website kami.\n\n"
            . base_url();

        $wa = new WhatsAppService();
        $wa->kirim($no_hp, $pesan);

        return redirect()->to(site_url('admin/kelola-pesanan'))
            ->with('success', 'Pemesanan ditolak & WA terkirim');
    }

    public function dpValid($id)
    {
        $pemesanan = $this->db->table('pemesanan')
            ->select('pemesanan.*, kapal.nama_kapal')
            ->join('kapal', 'kapal.id_kapal = pemesanan.id_kapal')
            ->where('id_pemesanan', $id)
            ->get()
            ->getRowArray();

        if (!$pemesanan) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        $pembayaran = $this->db->table('pembayaran')
            ->where('id_pemesanan', $id)
            ->where('jenis_pembayaran', 'dp')
            ->orderBy('id_pembayaran', 'DESC')
            ->get()
            ->getRowArray();

        if (!$pembayaran) {
            return redirect()->back()->with('error', 'Data pembayaran tidak ditemukan');
        }

        // Update pembayaran
        $this->db->table('pembayaran')
            ->where('id_pembayaran', $pembayaran['id_pembayaran'])
            ->update([
                'status_verifikasi' => 'valid'
            ]);

        // Update status booking
        $this->db->table('pemesanan')
            ->where('id_pemesanan', $id)
            ->update([
                'status_booking' => 'disetujui'
            ]);

        // Generate tiket
        $tiketModel = new TiketModel();

        $kodeTiket = 'TIK-' . $pemesanan['kode_booking'];

        $cekTiket = $tiketModel->where('id_pemesanan', $id)->first();

        if (!$cekTiket) {
            $tiketModel->insert([
                'id_pemesanan' => $id,
                'kode_tiket'   => $kodeTiket,
                'file_tiket'   => null
            ]);
        }

        // ==========================
        // BUAT FILE PDF TIKET
        // ==========================

        // Ambil data lengkap tiket
        $dataTiket = $this->db->table('tiket')
            ->select('tiket.*, pemesanan.*, kapal.nama_kapal')
            ->join('pemesanan', 'pemesanan.id_pemesanan = tiket.id_pemesanan')
            ->join('kapal', 'kapal.id_kapal = pemesanan.id_kapal')
            ->where('tiket.kode_tiket', $kodeTiket)
            ->get()
            ->getRowArray();

        // Load view jadi HTML
        $html = view('admin/kelola_pesanan/tiket/index', [
            'tiket' => $dataTiket
        ]);

        $options = new Options();
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $output = $dompdf->output();

        // Buat folder jika belum ada
        $folderPath = FCPATH . 'tiket/';
        if (!is_dir($folderPath)) {
            mkdir($folderPath, 0777, true);
        }

        $namaFile = $kodeTiket . '.pdf';
        $filePath = $folderPath . $namaFile;

        // Simpan file PDF
        file_put_contents($filePath, $output);

        // Update database
        $this->db->table('tiket')
            ->where('kode_tiket', $kodeTiket)
            ->update([
                'file_tiket' => $namaFile
            ]);
                
        // Format nomor
        $no_hp = $pemesanan['no_hp'];
        if (substr($no_hp, 0, 1) == "0") {
            $no_hp = "62" . substr($no_hp, 1);
        }

        $ngrokUrl = 'https://subconchoidal-celestine-crackly.ngrok-free.dev/';

        $linkTiket = $ngrokUrl . 'admin/kelola-pesanan/tiket/' . $kodeTiket;

        // Pesan WA
        $pesan = "Halo {$pemesanan['nama_pemesan']},\n\n"
            . "Tiket resmi Anda telah diterbitkan.\n\n"
            . "Silakan mengakses tiket melalui URL berikut:\n"
            . $linkTiket . "\n\n"
            . "Pada halaman tersebut Anda dapat melihat dan mengunduh tiket.\n\n"
            . "Tunjukkan tiket saat hari keberangkatan.\n\n"
            . "Terima kasih.";

        // opsi 1
        // $fileUrl = base_url('tiket/' . $namaFile);

        // opsi 2
        // $ngrokUrl = 'https://subconchoidal-celestine-crackly.ngrok-free.dev/';
        // $fileUrl  = $ngrokUrl . 'tiket/' . $namaFile;

        $wa = new WhatsAppService();
        $wa->kirim($no_hp, $pesan);

        return redirect()->to(site_url('admin/kelola-pesanan'))
            ->with('success', 'DP valid & tiket berhasil diterbitkan');
    }

    public function dpTolak($id)
    {
        $alasan = trim($this->request->getPost('alasan_penolakan_dp'));

        if (!$alasan) {
            return redirect()->back()->with('error', 'Alasan penolakan DP wajib diisi');
        }

        $pemesanan = $this->db->table('pemesanan')
            ->where('id_pemesanan', $id)
            ->get()
            ->getRowArray();

        if (!$pemesanan) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        // UPDATE pembayaran (BUKAN INSERT)
        $this->db->table('pembayaran')
            ->where('id_pemesanan', $id)
            ->where('jenis_pembayaran', 'dp')
            ->update([
                'status_verifikasi' => 'ditolak',
                'alasan_penolakan'  => $alasan
            ]);

        // Status booking kembali ke menunggu_dp
        $this->db->table('pemesanan')
            ->where('id_pemesanan', $id)
            ->update([
                'status_booking' => 'menunggu_dp'
            ]);

        // Format nomor WA
        $no_hp = $pemesanan['no_hp'];
        if (substr($no_hp, 0, 1) == "0") {
            $no_hp = "62" . substr($no_hp, 1);
        }

        // Kirim WA
        $pesan = "Halo {$pemesanan['nama_pemesan']},\n\n"
            . "Pembayaran DP untuk kode booking {$pemesanan['kode_booking']} DITOLAK.\n\n"
            . "Alasan:\n{$alasan}\n\n"
            . "Silakan upload ulang bukti pembayaran yang valid.\n\n"
            . base_url();

        $wa = new WhatsAppService();
        $wa->kirim($no_hp, $pesan);

        return redirect()->to(site_url('admin/kelola-pesanan'))
            ->with('success', 'DP ditolak & WA terkirim');

    }


}
