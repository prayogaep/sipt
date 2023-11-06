<?php

namespace App\Controllers;

use App\Models\m_ip;
use App\Models\m_responden;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class RespondenController extends BaseController
{
    // protected $conn;
    protected $responden; // variable global yang bisa di akses oleh semua function
    protected $ip; // variable global yang bisa di akses oleh semua function
    public function __construct()
    {
        $this->responden = new m_responden();
        $this->ip = new m_ip();
    }
    public function index() // ini yang dituju oleh routes.php
    {
        $p = md5($this->request->getIPAddress());
        $cekIp = $this->responden->checkIpResponden($p);
        if (!empty($cekIp)) {
            return redirect()->to('/')->with('warning', 'Anda sudah mengisi kuisioner, Terima Kasih untuk feedbacknya'); // ini mengarahkan ke file routes.php dengan method get ke alamat /
        }
        return redirect()->to("/responden/create/$p");
    }

    public function create($ip) // ini yang dituju oleh routes.php
    {
        $data = [
            'title' => 'Responden Tulus Company', // title untuk di tampilkan di tab browser
            'ip' => $ip
        ];
        return view('responden/create', $data); // ini akan mengarahkan ke folder views->responden->create dengan membawa $data
    }
    public function save($p)
    {
        $data = [
            'tanggal' => date('Y-m-d'),
            // nama_responden yang kiri adalah yang sesuai dengan kolom yang ada di tbl_user
            'nama_responden' => $this->request->getPost('nama_responden'), // nama_responden yang kanan menangkap nilai dari input yang name nya nama_responden

            // alamat yang kiri adalah yang sesuai dengan kolom yang ada di tbl_user
            'alamat' => $this->request->getPost('alamat'), // alamat yang kanan menangkap nilai dari input yang name nya alamat

            // jenis_kelamin yang kiri adalah yang sesuai dengan kolom yang ada di tbl_user
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'), // jenis_kelamin yang kanan menangkap nilai dari input yang name nya jenis_kelamin

            // umur yang kiri adalah yang sesuai dengan kolom yang ada di tbl_user
            'umur' => $this->request->getPost('umur'), // umur yang kanan menangkap nilai dari input yang name nya umur

            // ks yang kiri adalah yang sesuai dengan kolom yang ada di tbl_user
            'ks' => $this->request->getPost('ks'), // ks yang kanan menangkap nilai dari input yang name nya ks

            // rating yang kiri adalah yang sesuai dengan kolom yang ada di tbl_user
            'rating' => $this->request->getPost('rating'), // rating yang kanan menangkap nilai dari input yang name nya rating
        ];
        $this->responden->save($data); // Proses simpan data ke m_responden
        $this->ip->save(['ip_address' => $p]);
        return redirect()->to('/')->with('success', 'Terima kasih untuk feedback anda!, Jawaban dan Penilaian anda akan membantu peningkatan pelayanan kami'); // ini mengarahkan ke file routes.php dengan method get ke alamat /
    }
    
    public function show()
    {
        if ($this->request->getGet('from')) {
            $responden = $this->responden->filterDate($this->request->getGet('from'));
            if ($this->request->getGet('to')) {
                $responden = $this->responden->filterDate($this->request->getGet('from'), $this->request->getGet('to'));
            }
        } else {
            $responden = $this->responden->findAll();
        }
        $data = [
            'title' => 'Jawaban Responden',
            'responden' => $responden
        ];
        return view('responden/index', $data); // ini akan mengarahkan ke folder views->responden->index dengan membawa $data
    }
    public function rasio()
    {
        $responden = $this->responden->runQuery("SELECT COUNT(rating) rate, rating FROM tbl_responden GROUP BY rating")->getResultArray();

        // Inisialisasi array untuk rating dari 1 hingga 5
        $ratings = [1, 2, 3, 4, 5];

        $ratingCount = [];
        // Inisialisasi semua rating dengan nilai awal 0
        foreach ($ratings as $rating) {
            $ratingCount[$rating] = 0;
        }

        // Mengisi array dengan data yang sesuai
        foreach ($responden as $r) {
            $ratingCount[$r['rating']] = $r['rate'];
        }

        // Konversi data ke dalam format yang sesuai untuk chart JS
        $count = array_values($ratingCount);
        $rating = array_keys($ratingCount);

        $rasio = $this->responden->getRasio();
        $nilai = number_format(floatval($rasio['rasio']), 2, '.', '');
        $data = [
            'title' => 'Rasio Pelayanan',
            'count' => json_encode($count),
            'rating' => json_encode($rating),
            'rasio' => $nilai,
            'penilaian' => $this->responden->penilaianRasio($nilai)
        ];

        return view('responden/rasio', $data);
        // ini akan mengarahkan ke folder views->responden->index dengan membawa $data
    }
    
    public function export()
    {
        if ($this->request->getGet('from')) {
            $responden = $this->responden->filterDate($this->request->getGet('from'));
            if ($this->request->getGet('to')) {
                $responden = $this->responden->filterDate($this->request->getGet('from'), $this->request->getGet('to'));
            }
        } else {
            $responden = $this->responden->findAll();
        }
        $spreadsheet = new Spreadsheet();
        // tulis header/nama kolom 
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Nama')
            ->setCellValue('B1', 'Umur')
            ->setCellValue('C1', 'Jenis kelamin')
            ->setCellValue('D1', 'Alamat')
            ->setCellValue('E1', 'Rating')
            ->setCellValue('F1', 'Dari pengalaman Anda sebagai pelanggan di toko ini, bagaimana penilaian Anda terhadap kualitas keseluruhan pelayanan yang diberikan oleh toko  ?');

        $column = 2;
        // tulis data mobil ke cell
        foreach ($responden as $data) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $data['nama_responden'])
                ->setCellValue('B' . $column, $data['umur'])
                ->setCellValue('C' . $column, $data['jenis_kelamin'])
                ->setCellValue('D' . $column, $data['alamat'])
                ->setCellValue('E' . $column, $data['rating'])
                ->setCellValue('F' . $column, $data['ks']);
            $column++;
        }
        // tulis dalam format .xlsx
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Data Responden_' . date('Ymd') ;

        // Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $fileName . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
}
