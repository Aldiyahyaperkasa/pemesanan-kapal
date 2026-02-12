<?php

namespace App\Controllers;
use App\Models\KapalModel;


class Home extends BaseController
{
    public function index()
    {
        $kapalModel = new \App\Models\KapalModel();
        $data['kapal'] = $kapalModel->where('tersedia', true)->findAll();

        return view('landing_page', $data);
    }
}
