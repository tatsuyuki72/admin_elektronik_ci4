<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Database\Config;

class Auth extends BaseController
{

    /* ================= LOGIN PAGE ================= */
    public function login()
    {
        // Jika sudah login, redirect ke dashboard
        if (session()->get('isLogin')) {
            return redirect()->to('/admin');
        }

        return view('login');
    }

    /* ================= PROCESS LOGIN ================= */
    public function process()
    {
        $db = Config::connect();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $db->table('users')
                   ->where('username', $username)
                   ->get()
                   ->getRow();

        // Verifikasi user & password hash
        if ($user && password_verify($password, $user->password)) {

            session()->set([
                'isLogin'  => true,
                'username' => $user->username
            ]);

            return redirect()->to('/admin');
        }

        return redirect()
                ->back()
                ->with('error', 'Username atau Password salah');
    }

    /* ================= LOGOUT ================= */
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
