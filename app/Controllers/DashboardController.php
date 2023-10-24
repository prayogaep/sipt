<?php

namespace App\Controllers;

use App\Models\m_produk;
use App\Models\m_responden;
use App\Models\m_user;

class DashboardController extends BaseController
{
    protected $responden;
    protected $user;
    protected $product;

    public function __construct() {
        $this->responden = new m_responden();
        $this->user = new m_user();
        $this->product = new m_produk();
    }
    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'responden' => $this->responden->countAllResults(),
            'users' => $this->user->countAllResults(),
            'products' => $this->product->countAllResults()
        ];
        return view('dashboard/index', $data);
    }
}
