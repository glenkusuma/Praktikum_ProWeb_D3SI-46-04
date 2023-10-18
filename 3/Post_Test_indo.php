<?php

/**
 * Kelas MataKuliah mewakili sebuah mata kuliah.
 */
class MataKuliah {
    /** @var string Kode mata kuliah. */
    public $kode;

    /** @var string Nama mata kuliah. */
    public $nama;

    /** @var int Jumlah sks (sistem kredit semester) mata kuliah. */
    public $sks;

    /** @var string Nilai yang diperoleh untuk mata kuliah. */
    public $nilai;

    /** @var int Semester ketika mahasiswa mengambil mata kuliah. */
    public $semester;
    
    /**
     * Konstruktor MataKuliah.
     *
     * @param string $kode Kode mata kuliah.
     * @param string $nama Nama mata kuliah.
     * @param int $sks Jumlah sks (sistem kredit semester).
     * @param string $nilai Nilai yang diperoleh untuk mata kuliah.
     * @param int $semester Semester ketika mahasiswa mengambil mata kuliah.
     */
    public function __construct(string $kode, string $nama, int $sks, string $nilai, int $semester) {
        $this->kode = $kode;
        $this->nama = $nama;
        $this->sks = $sks;
        $this->nilai = $nilai;
        $this->semester = $semester;
    }

}

/**
 * Kelas Mahasiswa mewakili seorang mahasiswa.
 */
class Mahasiswa {
    /** @var string NIM (Nomor Induk Mahasiswa) mahasiswa. */
    public string $nim;

    /** @var string Nama mahasiswa. */
    public string $nama;

    /** @var array<MataKuliah> Array dari mata kuliah yang diambil oleh mahasiswa. */
    public array $mataKuliahList = [];

    /**
     * Konstruktor Mahasiswa.
     *
     * @param string $nim NIM (Nomor Induk Mahasiswa) mahasiswa.
     * @param string $nama Nama mahasiswa.
     */
    public function __construct($nim, $nama) {
        $this->nim = $nim;
        $this->nama = $nama;
    }

    /**
     * Menambahkan mata kuliah ke daftar mata kuliah mahasiswa.
     *
     * @param MataKuliah $mataKuliah Mata kuliah yang akan ditambahkan.
     */
    public function tambahMataKuliah(MataKuliah $mataKuliah): void {
        $this->mataKuliahList[] = $mataKuliah;
    }

    /**
     * Menambahkan mata kuliah ke daftar mata kuliah mahasiswa menggunakan array.
     *
     * @param array<MataKuliah> $arrayMataKuliah Mata kuliah yang akan ditambahkan.
     */
    public function tambahBanyakMataKuliah(array $arrayMataKuliah): void {
        foreach ($arrayMataKuliah as $matakuliah) {
            $this->tambahMataKuliah($matakuliah);
        }
    }

    /**
     * Menghitung IPK (Indeks Prestasi Kumulatif) mahasiswa berdasarkan mata kuliah dan nilai yang diperoleh.
     *
     * @return float IPK yang dihitung.
     */
    public function hitungIPK(): float {
        $total_sks = 0;
        $total_bobot = 0;

        foreach ($this->mataKuliahList as $mataKuliah) {
            $total_sks += $mataKuliah->sks;
            $total_bobot += $mataKuliah->sks * $this->getBobotNilai($mataKuliah->nilai);
        }

        if ($total_sks > 0) {
            return $total_bobot / $total_sks;
        } else {
            return 0; // Untuk menghindari pembagian dengan nol.
        }
    }

    /**
     * Mendapatkan bobot IPK untuk nilai tertentu.
     *
     * @param string $nilai Nilai.
     * @return float Bobot IPK.
     */
    private function getBobotNilai($nilai): float {
        switch ($nilai) {
            case 'A':
                return 4.0;
            case 'AB':
                return 3.5;
            case 'B':
                return 3.0;
            case 'BC':
                return 2.5;
            case 'C':
                return 2.0;
            case 'D':
                return 1.0;
            default:
                return 0.0; // Default ke E (Fail) dengan IPK 0.0
        }
    }

}

// Membuat array object MataKuliah
$mataKuliah_semester_1 = [
    new MataKuliah("UKI1A2", "Kewarganegaraan", 2, "A", 1),
    new MataKuliah("UWI1A2", "Bahasa Inggris", 2, "A", 1),
    new MataKuliah("UWI1E1", "Pembentukan Karakter", 1, "A", 1),
    new MataKuliah("VPI1M2", "Olahraga", 2, "AB", 1),
    new MataKuliah("VSI1A4", "Algoritma dan Pemrograman Komputer", 4, "A", 1),
    new MataKuliah("VSI1C3", "Dasar Manajemen dan Sistem Informasi", 3, "A", 1),
    new MataKuliah("VSI1F3", "Logika Matematika", 3, "AB", 1),
    new MataKuliah("VSI1H3", "Rekayasa Perangkat Lunak", 3, "A", 1),
    ];

  // Menampilkan array MataKuliah
echo '<h2>mataKuliah_semester_1</h2><pre>';
echo json_encode($mataKuliah_semester_1, JSON_PRETTY_PRINT);
echo "</pre>";

// Contoh penggunaan Mahasiswa;
$mahasiswa = new Mahasiswa('6701213049','Glen Davis Kusuma');

$mahasiswa->tambahBanyakMataKuliah($mataKuliah_semester_1);

$ipk = $mahasiswa->hitungIPK();
echo "<br>";
echo "IPK {$mahasiswa->nama} (NIM: {$mahasiswa->nim}): $ipk";

?>