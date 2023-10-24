<?php

namespace App\Controllers;

use App\Models\m_responden;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class RespondenController extends BaseController
{
    // protected $conn;
    protected $responden; // variable global yang bisa di akses oleh semua function
    public function __construct()
    {
        $this->responden = new m_responden();
    }
    public function index() // ini yang dituju oleh routes.php
    {
        $p = md5($this->request->getIPAddress());
        $query = "SELECT * FROM tbl_ip WHERE ip_address = '$p'";
        $cekIp = $this->runQuery($query)->getResult();
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

            // pertanyaan_1 yang kiri adalah yang sesuai dengan kolom yang ada di tbl_user
            'pertanyaan_1' => $this->request->getPost('pertanyaan_1'), // pertanyaan_1 yang kanan menangkap nilai dari input yang name nya pertanyaan_1

            // pertanyaan_2 yang kiri adalah yang sesuai dengan kolom yang ada di tbl_user
            'pertanyaan_2' => $this->request->getPost('pertanyaan_2'), // pertanyaan_2 yang kanan menangkap nilai dari input yang name nya pertanyaan_2

            // pertanyaan_3 yang kiri adalah yang sesuai dengan kolom yang ada di tbl_user
            'pertanyaan_3' => $this->request->getPost('pertanyaan_3'), // pertanyaan_3 yang kanan menangkap nilai dari input yang name nya pertanyaan_3

            // pertanyaan_4 yang kiri adalah yang sesuai dengan kolom yang ada di tbl_user
            'pertanyaan_4' => $this->request->getPost('pertanyaan_4'), // pertanyaan_4 yang kanan menangkap nilai dari input yang name nya pertanyaan_4

            // pertanyaan_5 yang kiri adalah yang sesuai dengan kolom yang ada di tbl_user
            'pertanyaan_5' => $this->request->getPost('pertanyaan_5'), // pertanyaan_5 yang kanan menangkap nilai dari input yang name nya pertanyaan_5

            // pertanyaan_6 yang kiri adalah yang sesuai dengan kolom yang ada di tbl_user
            'pertanyaan_6' => $this->request->getPost('pertanyaan_6'), // pertanyaan_6 yang kanan menangkap nilai dari input yang name nya pertanyaan_6

            // pertanyaan_7 yang kiri adalah yang sesuai dengan kolom yang ada di tbl_user
            'pertanyaan_7' => $this->request->getPost('pertanyaan_7'), // pertanyaan_7 yang kanan menangkap nilai dari input yang name nya pertanyaan_7

            // pertanyaan_8 yang kiri adalah yang sesuai dengan kolom yang ada di tbl_user
            'pertanyaan_8' => $this->request->getPost('pertanyaan_8'), // pertanyaan_8 yang kanan menangkap nilai dari input yang name nya pertanyaan_8

            // pertanyaan_9 yang kiri adalah yang sesuai dengan kolom yang ada di tbl_user
            'pertanyaan_9' => $this->request->getPost('pertanyaan_9'), // pertanyaan_9 yang kanan menangkap nilai dari input yang name nya pertanyaan_9

            // pertanyaan_10 yang kiri adalah yang sesuai dengan kolom yang ada di tbl_user
            'pertanyaan_10' => $this->request->getPost('pertanyaan_10'), // pertanyaan_10 yang kanan menangkap nilai dari input yang name nya pertanyaan_10

            // rating yang kiri adalah yang sesuai dengan kolom yang ada di tbl_user
            'rating' => $this->request->getPost('rating'), // rating yang kanan menangkap nilai dari input yang name nya rating
        ];
        $this->responden->save($data); // Proses simpan data ke m_responden
        $this->runQuery("INSERT INTO tbl_ip (ip_address) VALUES ('$p')");
        return redirect()->to('/')->with('success', 'Terima kasih untuk feedback anda!, Jawaban dan Penilaian anda akan membantu peningkatan pelayanan kami'); // ini mengarahkan ke file routes.php dengan method get ke alamat /
    }
    private function runQuery($query)
    {
        $conn = db_connect();
        return $conn->query($query);
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
        $responden = $this->runQuery("SELECT COUNT(rating) rate, rating FROM tbl_responden GROUP BY rating")->getResultArray();

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

        $rasio = $this->getRasio();

        $data = [
            'title' => 'Rasio Pelayanan',
            'count' => json_encode($count),
            'rating' => json_encode($rating),
            'rasio' => number_format(floatval($rasio['rasio']), 2, '.', '')
        ];

        return view('responden/rasio', $data);
        // ini akan mengarahkan ke folder views->responden->index dengan membawa $data
    }
    public function getRasio()
    {
        $rasio = $this->runQuery("SELECT (result/responden) rasio FROM ( SELECT
                SUM(total) result, (SELECT COUNT(*) responden from tbl_responden) responden
                FROM
                    (
                    SELECT
                        (rate * rating) total
                    FROM
                        (
                        SELECT
                            COUNT(rating) rate,
                            rating
                        FROM
                            tbl_responden
                        GROUP BY
                            Rating
                    ) A
                GROUP BY
                    (rate * rating)
                ) A ) A; 
        ")->getRowArray();
        return $rasio;
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
            ->setCellValue('B1', 'Rating')
            ->setCellValue('C1', 'Bagaimana kesan pertama anda saat mengunjungi toko kami ?')
            ->setCellValue('D1', 'Bagaimana penilaian anda terhadap ketersediaan produk yang anda cari selama mengunjungi toko ?')
            ->setCellValue('E1', 'Bagaimana penilaian anda terhadap keramahan dan kesopanan staf toko selama mengunjungi toko ?')
            ->setCellValue('F1', 'Bagaimaan penilaian anda terhadap kecepatan efisiensi proses pembayaran di kasir ?')
            ->setCellValue('G1', 'Sejauh mana anda puas dengan kualitas produk yang anda beli di toko ?')
            ->setCellValue('H1', 'Apakah anda merasa bahwa staff toko memberikan informasi yang cukup tentang produk, harga dan promosi yang berlangsung ?')
            ->setCellValue('I1', 'Apakah anda merasa kebersihan dan kerapihan toko memenuhi standar yang diharapkan ?')
            ->setCellValue('J1', 'Apakah anda puas dengan responsivitas staf toko ketika anda membutuhkan bantuan atau informasi tambahan ?')
            ->setCellValue('K1', 'Apakah anda puas dengan pengalaman berbelanja ?')
            ->setCellValue('L1', 'Apakah anda merekomendasikan toko ini kepada teman atau keluarga berdasarkan pengalaman anda ?');

        $column = 2;
        // tulis data mobil ke cell
        foreach ($responden as $data) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $data['nama_responden'])
                ->setCellValue('B' . $column, $data['rating'])
                ->setCellValue('C' . $column, $data['pertanyaan_1'])
                ->setCellValue('D' . $column, $data['pertanyaan_2'])
                ->setCellValue('E' . $column, $data['pertanyaan_3'])
                ->setCellValue('F' . $column, $data['pertanyaan_4'])
                ->setCellValue('G' . $column, $data['pertanyaan_5'])
                ->setCellValue('H' . $column, $data['pertanyaan_6'])
                ->setCellValue('I' . $column, $data['pertanyaan_7'])
                ->setCellValue('J' . $column, $data['pertanyaan_8'])
                ->setCellValue('K' . $column, $data['pertanyaan_9'])
                ->setCellValue('L' . $column, $data['pertanyaan_10']);
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
