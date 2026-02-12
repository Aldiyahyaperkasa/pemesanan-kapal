<?php
namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\KapalModel;
use App\Models\PemesanModel;
use App\Models\PemilikKapalModel;
use App\Models\PemesananModel;

class AdminController extends BaseController
{

public function index()
{
    return view('admin/dashboard_admin');
}

}