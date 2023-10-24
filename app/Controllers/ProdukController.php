<?php

namespace App\Controllers;

use App\Models\m_produk;

class ProdukController extends BaseController
{
    protected $produk; // variable global yang bisa di akses oleh semua function
    public function __construct()
    {
        $this->produk = new m_produk(); // jalur untuk berkomunikasi ke model m_produk
    }
    public function index() // ini yang dituju oleh routes.php
    {
        $data = [
            'title' => 'Kelola Produk', // title untuk di tampilkan di tab browser
            'products' => $this->produk->findAll(), // ini berangkat ke model m_produk dan masuk ke function findAll()
        ];
        return view('produk/index', $data); // ini akan mengarahkan ke folder views->user->index dengan membawa $data
    }
    public function create() // ini yang dituju oleh routes.php
    {
        $data = [
            'title' => 'Kelola Produk', // title untuk di tampilkan di tab browser
        ];
        return view('produk/create', $data); // ini akan mengarahkan ke folder views->user->create dengan membawa $data
    }
    public function save() // ini yang dituju oleh routes.php
    {
        // Menangkap nilai yang dikirim dari inputan dibungkus dalam 1 variable yaitu $data
        $data = [
            // nama_produk yang kiri adalah yang sesuai dengan kolom yang ada di tbl_user
            'nama_produk' => $this->request->getPost('nama_produk'), // nama_produk yang kanan menangkap nilai dari input yang name nya nama_produk

            // deskripsi yang kiri adalah yang sesuai dengan kolom yang ada di tbl_user
            'deskripsi' => $this->request->getPost('deskripsi'), // deskripsi yang kanan menangkap nilai dari input yang name nya deskripsi

        ];
        $file_foto = $this->request->getFile('foto');
        if ($file_foto->getError() == 0) {
            $file_foto->move('img');
            $data['foto'] = $file_foto->getName();
        }

        $this->produk->save($data); // mengirim data ke model m_produk untuk disimpan ke database


        return redirect()->to('/produk')->with('success', 'Data berhasil disimpan'); // ini mengarahkan ke file routes.php dengan method get ke alamat /produk
        // dengan membawa pesan
    }
    public function edit($id) // ini yang dituju oleh routes.php dan membawa data yang dipilih dari tabel
    {
        $data = [
            'title' => 'Edit Produk', // title untuk di tampilkan di tab browser
            'produk' => $this->produk->find($id), // ini mengambil semua data ke model m_produk
        ];
        return view('produk/edit', $data); // ini akan mengarahkan ke folder views->produk->edit dengan membawa $data
    }

    public function update($id) // ini yang dituju oleh routes.php dengan membawa parameter
    {
        // Menangkap nilai yang dikirim dari inputan dibungkus dalam 1 variable yaitu $data
        $data = [
            // nama_produk yang kiri adalah yang sesuai dengan kolom yang ada di tbl_produk
            'nama_produk' => $this->request->getPost('nama_produk'), // nama_produk yang kanan menangkap nilai dari input yang name nya nama_produk

            // deskripsi yang kiri adalah yang sesuai dengan kolom yang ada di tbl_user
            'deskripsi' => $this->request->getPost('deskripsi'), // deskripsi yang kanan menangkap nilai dari input yang name nya deskripsi

        ];
        $file_foto = $this->request->getFile('foto');
        if ($file_foto->getError() == 0) {
            $fotolama = $this->produk->find($id);
            unlink('img/' . $fotolama['foto']);
            $file_foto->move('img');
            $data['foto'] = $file_foto->getName();
        }
        $this->produk->update($id, $data); // mengirim data ke model m_produk untuk diubah ke database berdasarkan id yang dipilih


        return redirect()->to('/produk')->with('success', 'Data berhasil diubah'); // ini mengarahkan ke file routes.php dengan method get ke alamat /produk
        // dengan membawa pesan
    }
    public function delete($id) // ini yang dituju oleh routes.php 
    {
        $fotolama = $this->produk->find($id);
        unlink('img/' . $fotolama['foto']);
        $this->produk->delete($id); // menghapus data ke model m_produk berdasarkan id yang dipilih
        return redirect()->to('/produk')->with('success', 'Data berhasil dihapus'); // ini mengarahkan ke file routes.php dengan method get ke alamat /produk
        // dengan membawa pesan
    }
}
