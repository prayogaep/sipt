<?php

namespace App\Controllers;

use App\Models\m_role;
use App\Models\m_user;

class UserController extends BaseController
{
    protected $user; // variable global yang bisa di akses oleh semua function
    protected $role; // variable global yang bisa di akses oleh semua function
    public function __construct()
    {
        $this->user = new m_user(); // jalur untuk berkomunikasi ke model m_user
        $this->role = new m_role(); // jalur untuk berkomunikasi ke model m_user
    }
    public function index() // ini yang dituju oleh routes.php
    {
        $data = [
            'title' => 'Kelola User', // title untuk di tampilkan di tab browser
            'users' => $this->user->getFullData(), // ini berangkat ke model m_user dan masuk ke function getFullData()
        ];
        return view('user/index', $data); // ini akan mengarahkan ke folder views->user->index dengan membawa $data
    }
    public function create() // ini yang dituju oleh routes.php
    {
        $data = [
            'title' => 'Tambah User', // title untuk di tampilkan di tab browser
            'roles' => $this->role->findAll(), // ini mengambil semua data ke model m_role
        ];
        return view('user/create', $data); // ini akan mengarahkan ke folder views->user->create dengan membawa $data
    }
    public function save() // ini yang dituju oleh routes.php
    {
        // Menangkap nilai yang dikirim dari inputan dibungkus dalam 1 variable yaitu $data
        $data = [
            // username yang kiri adalah yang sesuai dengan kolom yang ada di tbl_user
            'username' => $this->request->getPost('username'), // username yang kanan menangkap nilai dari input yang name nya username

            // password yang kiri adalah yang sesuai dengan kolom yang ada di tbl_user
            'password' => md5($this->request->getPost('password')), // password yang kanan menangkap nilai dari input yang name nya password dan nilai aslinya disembunyikan oleh md5

            // role_id yang kiri adalah yang sesuai dengan kolom yang ada di tbl_user
            'role_id' => $this->request->getPost('role_id'), // role_id yang kanan menangkap nilai dari input yang name nya role_id
        ];

        $this->user->save($data); // mengirim data ke model m_user untuk disimpan ke database


        return redirect()->to('/user')->with('success', 'Data berhasil disimpan'); // ini mengarahkan ke file routes.php dengan method get ke alamat /user
        // dengan membawa pesan
    }
    public function edit($id) // ini yang dituju oleh routes.php dan membawa data yang dipilih dari tabel
    {
        $data = [
            'title' => 'Edit User', // title untuk di tampilkan di tab browser
            'roles' => $this->role->findAll(), // ini mengambil semua data ke model m_role
            'user' => $this->user->find($id), // ini mengambil semua data ke model m_user
        ];
        return view('user/edit', $data); // ini akan mengarahkan ke folder views->user->edit dengan membawa $data
    }

    public function update($id) // ini yang dituju oleh routes.php dengan membawa parameter
    {
        // Menangkap nilai yang dikirim dari inputan dibungkus dalam 1 variable yaitu $data
        $data = [
            // username yang kiri adalah yang sesuai dengan kolom yang ada di tbl_user
            'username' => $this->request->getPost('username'), // username yang kanan menangkap nilai dari input yang name nya username

            // role_id yang kiri adalah yang sesuai dengan kolom yang ada di tbl_user
            'role_id' => $this->request->getPost('role_id'), // role_id yang kanan menangkap nilai dari input yang name nya role_id
        ];

        //kondisi jika password pada form edit diisi maka akan menambahkan ke dalam $data
        if ($this->request->getPost('password')) {
            // password yang kiri adalah yang sesuai dengan kolom yang ada di tbl_user 
            $data['password'] =  md5($this->request->getPost('password')); // password yang kanan menangkap nilai dari input yang name nya password dan nilai aslinya disembunyikan oleh md5

        }

        $this->user->update($id, $data); // mengirim data ke model m_user untuk diubah ke database berdasarkan id yang dipilih


        return redirect()->to('/user')->with('success', 'Data berhasil diubah'); // ini mengarahkan ke file routes.php dengan method get ke alamat /user
        // dengan membawa pesan
    }
    public function delete($id) // ini yang dituju oleh routes.php 
    {
        $this->user->delete($id); // menghapus data ke model m_user berdasarkan id yang dipilih


        return redirect()->to('/user')->with('success', 'Data berhasil dihapus'); // ini mengarahkan ke file routes.php dengan method get ke alamat /user
        // dengan membawa pesan
    }
}
