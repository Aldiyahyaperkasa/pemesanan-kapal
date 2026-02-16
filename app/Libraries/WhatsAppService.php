<?php

namespace App\Libraries;

class WhatsAppService
{
    protected $token;

    public function __construct()
    {
        $this->token = 'WMHP9kPQQHm37f9dUJTt';
    }

    public function kirim($nomor, $pesan)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => array(
                'target' => $nomor,
                'message' => $pesan,
                'countryCode' => '62'
            ),
            CURLOPT_HTTPHEADER => array(
                'Authorization: ' . $this->token
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }

    public function kirimDokumen($no, $fileUrl, $caption)
    {
        // CONTOH jika pakai API seperti Fonnte
        $data = [
            'target'   => $no,
            'document' => $fileUrl,
            'caption'  => $caption,
        ];

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.fonnte.com/send",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => [
                "Authorization: WMHP9kPQQHm37f9dUJTt"
            ],
        ]);

        curl_exec($curl);
        curl_close($curl);
    }

}
