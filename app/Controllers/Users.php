<?php

namespace App\Controllers;

use App\Models\UserManagementModel;

class Users extends BaseController
{
    public function __construct()
    {
        // Cek apakah pengguna sudah login dan levelnya admin
        if (!session()->get('isLoggedIn') || session()->get('level') !== 'admin') {
            return redirect()->to('/')->with('message', 'Access Denied');
        }
    }

    public function index()
    {
        $model = new UserManagementModel();
        $data['users'] = $model->findAll();
        return view('users/manage', $data);
    }

    public function edit($id)
    {
        $model = new UserManagementModel();
        $data['user'] = $model->find($id);
        $data['users'] = $model->findAll();
        return view('users/manage', $data);
    }

    public function save()
    {
        $model = new UserManagementModel();
        $data = [
            'username' => $this->request->getPost('username'),
            'level' => $this->request->getPost('level'),
        ];

        if ($this->request->getPost('id')) {
            // Update
            if ($this->request->getPost('password')) {
                $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
            }
            $model->update($this->request->getPost('id'), $data);
        } else {
            // Insert
            $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
            $model->insert($data);
        }

        return redirect()->to('/users');
    }

    public function delete($id)
    {
        $model = new UserManagementModel();
        $model->delete($id);
        return redirect()->to('/users');
    }
} 