<?php

/**
 * Class MataKuliah represents a course.
 */
class MataKuliah {
    /** @var string The course code. */
    public $kode;

    /** @var string The course name. */
    public $nama;

    /** @var int The number of credit hours (sks) for the course. */
    public $sks;

    /** @var string The grade received for the course. */
    public $nilai;

    /** @var int The semester of the student's took. */
    public $semester;
    
    /**
     * MataKuliah constructor.
     *
     * @param string $kode The course code.
     * @param string $nama The course name.
     * @param int $sks The number of credit hours (sks).
     * @param string $nilai The grade received for the course.
     * @param int $semester The semester of the student's took course (matakuliah).
     */
    public function __construct(string $kode, string $nama, int $sks, string $nilai, int $semester) {
        $this->kode = $kode;
        $this->nama = $nama;
        $this->sks = $sks;
        $this->nilai = $nilai;
        $this->semester = $semester;
    }

    /**
     * Get MataKuliah as an array.
     * 
     * @return array<string, mixed>
     */
    public function toArray() : array {
        return [
                "kode"=> $this->kode,
                "nama"=> $this->nama,
                "sks"=> $this->sks,
                "nilai"=> $this->nilai,
                "semester" => $this->semester
            ];
    }
}

/**
 * Class Mahasiswa represents a student.
 */
class Mahasiswa {
    /** @var string The student's NIM (student ID). */
    public string $nim;

    /** @var string The student's name. */
    public string $nama;

    /** @var array<MataKuliah> An array of courses taken by the student. */
    public array $mataKuliahList = [];

    /**
     * Mahasiswa constructor.
     *
     * @param string $nim The student's NIM (student ID).
     * @param string $nama The student's name.
     */
    public function __construct($nim, $nama) {
        $this->nim = $nim;
        $this->nama = $nama;
    }

    /**
     * Add a course to the student's course list.
     *
     * @param MataKuliah $mataKuliah The course to be added.
     */
    public function tambahMataKuliah(MataKuliah $mataKuliah): void {
        $this->mataKuliahList[] = $mataKuliah;
    }

    /**
     * Calculate the GPA (Grade Point Average) of the student based on their courses and grades.
     *
     * @return float The calculated GPA.
     */
    public function hitungGPA(): float {
        $total_sks = 0;
        $total_bobot = 0;

        foreach ($this->mataKuliahList as $mataKuliah) {
            $total_sks += $mataKuliah->sks;
            $total_bobot += $mataKuliah->sks * $this->getBobotNilai($mataKuliah->nilai);
        }

        if ($total_sks > 0) {
            return $total_bobot / $total_sks;
        } else {
            return 0; // To avoid division by zero.
        }
    }

    /**
     * Get the GPA weight for a given grade.
     *
     * @param string $nilai The grade.
     * @return float The GPA weight.
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
                return 0.0; // Default to F (Fail) with a GPA of 0.0
        }
    }

    /**
     *  Convert matakuliah to an array
     * 
     * @return array<array<string, mixed>>
     */
    private function mataKuliahToArray() : array {
        $array = array();
        foreach ($this->mataKuliahList as $mataKuliah) {
            $array[] = $mataKuliah->toArray();
        }
        return $array;
    }

    /**
     * Generate a string representation of the student's courses and grades.
     * 
     * @return string A string with the student's course information.
     */
    public function printMataKuliah() : string {
        $return = "";
        
        // sort matakuliah into the specify column.
        $all_matkul = $this->mataKuliahToArray();

        // genereate string return
        foreach ($all_matkul as $matkul) {
            foreach ($matkul as $key => $value) {
                $return = $return . $key . "=>" . $value . ", ";
            }
            $return = $return . "<br>";
        }
        return $return;
    }
}

// Usage example:
$mahasiswa = new Mahasiswa('12345', 'John Doe');

$mataKuliah1 = new MataKuliah('MAT101', 'Mathematics 101', 3, 'A', 1);
$mataKuliah2 = new MataKuliah('PHY201', 'Physics 201', 4, 'B', 4);
$mataKuliah3 = new MataKuliah('ENG102', 'English 102', 2, 'C', 3);

$mahasiswa->tambahMataKuliah($mataKuliah1);
$mahasiswa->tambahMataKuliah($mataKuliah2);
$mahasiswa->tambahMataKuliah($mataKuliah3);

$gpa = $mahasiswa->hitungGPA();
echo $mahasiswa->printMataKuliah();
echo "<br>";
echo "GPA of {$mahasiswa->nama} (NIM: {$mahasiswa->nim}): $gpa";
