<?php

namespace App\Controllers;

use App\Models\userModel;

class Auth extends BaseController
{
    protected $users;
    public function __construct()
    {
        $this->users = new userModel();
    }
    public function index()
    {
        return view('login/auth');
    }

    public function auth()
    {
        if ($this->request->isAJAX()) {
            $username = $this->request->getVar('username');
            $password = $this->request->getVar('password');

            $validation = \Config\Services::validation();

            $doValid = $this->validate([
                'username' => [
                    'label'  => 'Username',
                    'rules'  => 'required',
                    'errors' => [
                        'required'  => '{field} Can\'t be empty',
                    ]
                ],
                'password' => [
                    'label'  => 'Password',
                    'rules'  => 'required',
                    'errors' => [
                        'required'  => '{field} Can\'t be empty',
                    ]
                ],
            ]);

            if (!$doValid) {
                $msg = [
                    'error' => [
                        'errorUserName' => $validation->getError('username'),
                        'errorPassword' => $validation->getError('password'),
                    ]
                ];
            } else {
                $auth = $this->users->login($username, $password);
                if ($auth) {
                    session()->set([
                        'isLoggedIn' => true,
                        'username'    => $auth['username'],
                        'level'  => $auth['level'],
                    ]);

                    $msg = ['success' => 'Login Successful'];
                } else {
                    $msg = ['failed' => 'Login Credential Doesn\'t Match'];
                }
            }

            echo json_encode($msg);
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
