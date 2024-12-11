<?php

namespace App\Controllers;

class Logout extends BaseController
{
    public function index()
    {
        // Hancurkan semua data sesi
        session()->destroy();

        // Redirect ke halaman login atau halaman lain yang diinginkan
        return redirect()->to('/login');
    }
}
