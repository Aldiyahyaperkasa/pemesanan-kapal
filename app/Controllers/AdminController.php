<?php
namespace App\Controllers;

use App\Models\AdminModel;

class AdminController extends BaseController
{
    public function index()
    {
        return view('admin/dashboard_admin');
    }
}