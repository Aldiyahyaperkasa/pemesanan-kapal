<?php

namespace App\Controllers;

use App\Models\KapalModel;
use App\Models\PemesanModel;
use App\Models\PemesananModel;
use App\Models\PemilikKapalModel;
use CodeIgniter\Controller;

class PesanController extends BaseController
{
    protected $kapalModel;
    protected $pemesanModel;
    protected $pemesananModel;

    public function __construct()
    {
        $this->kapalModel = new KapalModel();
        $this->pemesanModel = new PemesanModel();
        $this->pemesananModel = new PemesananModel();
    }

    // 2. Check apakah user sudah login atau belum, dari tombol "Pesan Sekarang"
        public function cek_akun($id_kapal)
    {

        return view('pesan/cek_akun', ['id_kapal' => $id_kapal]);
        
    }

    public function login($id_kapal)
    {
        return view('pesan/login', ['id_kapal' => $id_kapal]);
    }

    public function proses_login($id_kapal)
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $pemesan = $this->pemesanModel->where('username', $username)->first();

        if ($pemesan && password_verify($password, $pemesan['password'])) {
            // Simpan session pemesan
            session()->set([
                'pemesan_id' => $pemesan['id_pemesan'],
                'pemesan_username' => $pemesan['username'],
                'pemesan_logged_in' => true,
                'role' => 'pemesan'
            ]);

            return redirect()->to('/pesan/form_pemesanan/' . $id_kapal);
        } else {
            return view('pesan/login', [
                'id_kapal' => $id_kapal,
                'error' => 'Username atau Password salah.'
            ]);
        }
    }

    public function reset($id_kapal)
    {
        // Hapus session pemesan saja supaya tidak mempengaruhi admin
        session()->remove([
            'pemesan_id',
            'pemesan_username',
            'pemesan_logged_in',
            'role'
        ]);

        return redirect()->to('/pesan/cek_akun/' . $id_kapal);
    }

    // 3 & 4. Form pemesanan sekaligus registrasi (jika belum punya akun)
// Form registrasi + pemesanan untuk user belum punya akun
public function form_registrasi($id_kapal)
{
    helper('form');
    $kapal = $this->kapalModel->find($id_kapal);
    if (!$kapal) return redirect()->to('/')->with('error','Kapal tidak ditemukan');

    return view('pesan/form_registrasi', [
        'kapal' => $kapal,
        'validation' => \Config\Services::validation()
    ]);
}

public function simpan_registrasi($id_kapal)
{
    $kapal = $this->kapalModel->find($id_kapal);
    if (!$kapal) {
        return redirect()->to('/')->with('error', 'Kapal tidak ditemukan');
    }

    $session = session();
    $rules = [
        'username'          => 'required|is_unique[pemesan.username]',
        'password'          => 'required|min_length[6]',
        'nama_lengkap'      => 'required',
        'email'             => 'required|valid_email',
        'no_hp'             => 'required',
        'tanggal_berangkat' => 'required|valid_date[Y-m-d\TH:i]',
        'tanggal_kembali'   => 'required|valid_date[Y-m-d\TH:i]',
        'jumlah_penumpang'  => "required|integer|greater_than[0]|less_than_equal_to[{$kapal['max_penumpang']}]"
    ];

    if (!$this->validate($rules)) {
        return redirect()->back()->withInput()->with('validation', $this->validator);
    }

    $tglBrg = date('Y-m-d H:i:s', strtotime($this->request->getPost('tanggal_berangkat')));
    $tglKmb = date('Y-m-d H:i:s', strtotime($this->request->getPost('tanggal_kembali')));

    if (strtotime($tglKmb) <= strtotime($tglBrg)) {
        $this->validator->setError('tanggal_kembali', 'Tanggal kembali harus selepas keberangkatan');
        return redirect()->back()->withInput()->with('validation', $this->validator);
    }

    // Simpan akun pemesan
    $this->pemesanModel->save([
        'username'     => $this->request->getPost('username'),
        'password'     => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        'nama_lengkap' => $this->request->getPost('nama_lengkap'),
        'email'        => $this->request->getPost('email'),
        'no_hp'        => $this->request->getPost('no_hp'),
    ]);

    $id_pemesan = $this->pemesanModel->getInsertID();

    $jumlah_penumpang = (int)$this->request->getPost('jumlah_penumpang');

    if ($kapal['jenis_kapal'] == 'perorangan') {
        $total_harga = $kapal['harga'] * $jumlah_penumpang;
    } else {
        $total_harga = $kapal['harga']; // Harga tetap, selama jumlah penumpang tidak melebihi max
    }

    // Simpan data pemesanan
    $this->pemesananModel->save([
        'id_pemesan'        => $id_pemesan, // <- GUNAKAN kolom yang konsisten
        'id_kapal'          => $id_kapal,
        'jumlah_penumpang'  => $this->request->getPost('jumlah_penumpang'),
        'total_harga'       => $total_harga,
        'tanggal_berangkat' => $tglBrg,
        'tanggal_kembali'   => $tglKmb,
        'status_pemilik'    => 'menunggu',
        'status_admin'      => 'menunggu'
    ]);

    // Auto-login
    $session->set([
        'pemesan_logged_in' => true,
        'id_pemesan'        => $id_pemesan,
        'username'          => $this->request->getPost('username'),
        'nama_lengkap'      => $this->request->getPost('nama_lengkap')
    ]);

    return redirect()->to('/')->with('success', 'Registrasi & Pemesanan berhasil.');
}




// Form pemesanan untuk user yang sudah login
public function form_pemesanan($id_kapal)
{
    helper('form');
    $kapal = $this->kapalModel->find($id_kapal);
    if (!$kapal) return redirect()->to('/')->with('error', 'Kapal tidak ditemukan');

    $session = session();

    if (!$session->get('pemesan_logged_in')) {
        // debug: user belum login
        return redirect()->to("/pesan/cek_akun/$id_kapal");
    }

    $user = $this->pemesanModel->find($session->get('pemesan_id'));

    if (!$user) {
        // debug: session pemesan_id tidak valid
        return redirect()->to("/pesan/reset/$id_kapal");
    }

    return view('pesan/form_pemesanan', [
        'kapal' => $kapal,
        'user' => $user,
        'validation' => \Config\Services::validation()
    ]);
}





    public function simpan_pemesanan($id_kapal)
    {
        $kapal = $this->kapalModel->find($id_kapal);
        if (!$kapal) return redirect()->to('/')->with('error', 'Kapal tidak ditemukan');

        $session = session();
        if (!$session->get('pemesan_logged_in')) {
            return redirect()->to("/pesan/cek_akun/$id_kapal");
        }

        $user = $this->pemesanModel->find($session->get('pemesan_id'));


        if (!$user) return redirect()->to("/pesan/reset/$id_kapal");

        $rules = [
            'jumlah_penumpang'  => "required|integer|greater_than[0]|less_than_equal_to[{$kapal['max_penumpang']}]",
            'tanggal_berangkat' => 'required|valid_date[Y-m-d\TH:i]',
            'tanggal_kembali'   => 'required|valid_date[Y-m-d\TH:i]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('validation', $this->validator);
        }

        $tglBrg = date('Y-m-d H:i:s', strtotime($this->request->getPost('tanggal_berangkat')));
        $tglKmb = date('Y-m-d H:i:s', strtotime($this->request->getPost('tanggal_kembali')));

        if (strtotime($tglKmb) <= strtotime($tglBrg)) {
            return redirect()->back()
                ->withInput()
                ->with('validation', $this->validator->setError('tanggal_kembali','Tanggal kembali harus setelah keberangkatan'));
        }
       
        $jumlah_penumpang = (int)$this->request->getPost('jumlah_penumpang');

        if ($kapal['jenis_kapal'] == 'perorangan') {
            $total_harga = $kapal['harga'] * $jumlah_penumpang;
        } else {
            $total_harga = $kapal['harga']; // tetap
        }
        
        $data = [
            'id_pemesan'        => $session->get('pemesan_id'),
            'id_kapal'          => $id_kapal,
            'jumlah_penumpang'  => $this->request->getPost('jumlah_penumpang'),
            'total_harga'       => $total_harga,
            'tanggal_berangkat' => $tglBrg,
            'tanggal_kembali'   => $tglKmb,
            'status_pemilik'    => 'menunggu',
            'status_admin'      => 'menunggu'
        ];

        if ($this->pemesananModel->save($data)) {
            return redirect()->to('/')->with('success','Pemesanan berhasil dikirim.');
        } else {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menyimpan pemesanan.');
        }
    }









// public function form($id_kapal)
// {
//     $kapal = $this->kapalModel->find($id_kapal);
//     if (!$kapal) {
//         return redirect()->to('/')->with('error', 'Kapal tidak ditemukan');
//     }

//     $session = session();

//     if (!$session->get('pemesan_logged_in')) {
//         // Jika user belum login, baik GET maupun POST sama-sama ditangani di sini
//         if ($this->request->getMethod() == 'post') {
//             // Proses registrasi + pemesanan

//             $rules = [
//                 'username' => 'required|is_unique[pemesan.username]',
//                 'password' => 'required|min_length[6]',
//                 'nama_lengkap' => 'required',
//                 'email' => 'required|valid_email',
//                 'no_hp' => 'required',
//                 'tanggal_berangkat' => 'required',
//                 'tanggal_kembali' => 'required',
//                 'jumlah_penumpang' => 'required|integer|greater_than[0]',
//             ];

//             if (!$this->validate($rules)) {
//                 return view('pesan/form_registrasi', [
//                     'kapal' => $kapal,
//                     'validation' => $this->validator
//                 ]);
//             }

//             // Simpan data registrasi dan pemesanan
//             $passwordHash = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
//             $this->pemesanModel->save([
//                 'username' => $this->request->getPost('username'),
//                 'password' => $passwordHash,
//                 'nama_lengkap' => $this->request->getPost('nama_lengkap'),
//                 'email' => $this->request->getPost('email'),
//                 'no_hp' => $this->request->getPost('no_hp'),
//             ]);
//             $id_pemesan = $this->pemesanModel->getInsertID();

//             $this->pemesananModel->save([
//                 'id_pemesan' => $id_pemesan,
//                 'id_kapal' => $id_kapal,
//                 'jumlah_penumpang' => $this->request->getPost('jumlah_penumpang'),
//                 'tanggal_berangkat' => $this->request->getPost('tanggal_berangkat'),
//                 'tanggal_kembali' => $this->request->getPost('tanggal_kembali'),
//                 'status_pemilik' => 'menunggu',
//                 'status_admin' => 'menunggu'
//             ]);

//             // Auto-login
//             $session->set([
//                 'pemesan_logged_in' => true,
//                 'id_pemesan' => $id_pemesan,
//                 'username' => $this->request->getPost('username'),
//                 'nama_lengkap' => $this->request->getPost('nama_lengkap'),
//             ]);

//             return redirect()->to('/dashboard_pemesan');
//         } else {
//             // Jika GET, tampilkan form registrasi + pemesanan
//             return view('pesan/form_registrasi', ['kapal' => $kapal]);
//         }
//     } else {
//         // Jika sudah login
//         if ($session->get('pemesan_logged_in')) {
//             $user = $this->pemesanModel->find($session->get('id_pemesan'));
//             if (!$user) {
//                 return redirect()->to('/logout'); // Atau redirect ke halaman login, karena data pemesan tidak ditemukan
//             }

//             if ($this->request->getMethod() == 'post') {
//                 // Proses pemesanan tanpa registrasi
//                 $rules = [
//                     'jumlah_penumpang' => 'required|integer|greater_than[0]',
//                     'tanggal_berangkat' => 'required',
//                     'tanggal_kembali' => 'required'
//                 ];

//                 if (!$this->validate($rules)) {
//                     return view('pesan/form_pemesanan', [
//                         'kapal' => $kapal,
//                         'validation' => $this->validator,
//                     ]);
//                 }

//                 // Format tanggal menjadi standar DATETIME
//                 $tglBerangkat = str_replace('T', ' ', $this->request->getPost('tanggal_berangkat'));
//                 $tglKembali   = str_replace('T', ' ', $this->request->getPost('tanggal_kembali'));                
//                 $tglBerangkat = str_replace('T', ' ', $this->request->getPost('tanggal_berangkat'));
//                 $tglKembali   = str_replace('T', ' ', $this->request->getPost('tanggal_kembali'));


//                 $data = [
//                     'id_pemesan'       => $session->get('id_pemesan'),
//                     'id_kapal'         => $id_kapal,
//                     'jumlah_penumpang' => $this->request->getPost('jumlah_penumpang'),
//                     'tanggal_berangkat'=> $tglBerangkat,
//                     'tanggal_kembali'  => $tglKembali,
//                     'status_pemilik'   => 'menunggu',
//                     'status_admin'     => 'menunggu'
//                 ];

//                 // Debug log untuk verifikasi data
//                 log_message('debug', 'Form Pemesanan POST payload: ' . json_encode($data));

//                 $this->pemesananModel->save($data);

//                 return redirect()->to('/dashboard_pemesan');
//             } else {
//                 // Tampilkan form pemesanan saja
//                 return view('pesan/form_pemesanan', [
//                     'kapal' => $kapal,
//                     'user' => $user,
//                     'validation' => $this->validator ?? null
//                 ]);
//             }
//         }
//     }
// }


    // 5. Dashboard pemilik kapal melihat semua permintaan dan bisa terima/tolak
    public function dashboardPemilik()
    {
        $session = session();

        // Pastikan login sebagai pemilik kapal
        if (!$session->get('pemilik_logged_in')) {
            return redirect()->to('/login_pemilik');
        }

        $id_pemilik = $session->get('id_pemilik');
        $pemesananModel = new PemesananModel();

        // Query semua pemesanan untuk kapal milik pemilik ini dengan status_pemilik menunggu/diterima
        $data['pemesanan'] = $pemesananModel->select('pemesanan.*, kapal.nama_kapal, pemesan.nama_lengkap as nama_pemesan')
            ->join('kapal', 'pemesanan.id_kapal = kapal.id_kapal')
            ->join('pemesan', 'pemesanan.id_pemesan = pemesan.id_pemesan')
            ->where('kapal.id_pemilik', $id_pemilik)
            ->whereIn('status_pemilik', ['menunggu', 'diterima'])
            ->findAll();

        return view('pemilik/dashboard', $data);
    }

    // 5a. Terima pemesanan
    public function terima($id_pemesanan)
    {
        $session = session();
        if (!$session->get('pemilik_logged_in')) {
            return redirect()->to('/login_pemilik');
        }
        $this->pemesananModel->update($id_pemesanan, ['status_pemilik' => 'diterima']);
        return redirect()->to('/dashboard_pemilik');
    }

    // 5b. Tolak pemesanan
    public function tolak($id_pemesanan)
    {
        $session = session();
        if (!$session->get('pemilik_logged_in')) {
            return redirect()->to('/login_pemilik');
        }
        $this->pemesananModel->update($id_pemesanan, ['status_pemilik' => 'ditolak']);
        return redirect()->to('/dashboard_pemilik');
    }
}
