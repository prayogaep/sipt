<?php

namespace App\Controllers;

use App\Models\m_produk;

class HomeController extends BaseController
{
    protected $produk;

    public function __construct()
    {
        $this->produk = new m_produk();
    }
    public function index()
    {
        $data = [
            'title' => 'Home',
            'products' => $this->produk->findAll()
        ];
        return view('home/index', $data);
    }
}
