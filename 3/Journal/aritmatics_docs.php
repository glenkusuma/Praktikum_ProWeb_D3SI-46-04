<?php
/**
 * Kelas Arithmetic
 *
 * Kelas ini menyediakan operasi aritmatika dasar pada dua angka floating-point.
 */
class Arithmetic {
    /** @var float Angka pertama untuk operasi aritmatika. */
    private float $number1;

    /** @var float Angka kedua untuk operasi aritmatika. */
    private float $number2;

    /**
     * Konstruktor untuk kelas Arithmetic.
     *
     * @param float $number1 Angka pertama.
     * @param float $number2 Angka kedua.
     */
    public function __construct($number1, $number2) {
        $this->number1 = $number1;
        $this->number2 = $number2;
    }

    /**
     * Menambahkan dua angka.
     *
     * @return float Hasil penambahan.
     */
    public function add(): float {
        return $this->number1 + $this->number2;
    }

    /**
     * Mengurangkan dua angka.
     *
     * @return float Hasil pengurangan.
     */
    public function subtract(): float  {
        return $this->number1 - $this->number2;
    }

    /**
     * Mengalikan dua angka.
     *
     * @return float Hasil perkalian.
     */
    public function multiply(): float  {
        return $this->number1 * $this->number2;
    }

    /**
     * Membagi dua angka.
     *
     * @return float Hasil pembagian.
     */
    public function divide(): float  {
        return $this->number1 / $this->number2;
    }

    /**
     * Menghitung pangkat suatu angka dengan eksponen tertentu.
     *
     * @param float $base Angka dasar.
     * @param float $exponent Eksponen.
     *
     * @return float Hasil pemangkatan angka dasar dengan eksponen yang diberikan.
     */
    public static function power(float $base, float $exponent): float  {
        $result = 1;
        for ($i = 0; $i < $exponent; $i++) {
            $result *= $base;
        }
        return $result;
    }

    /**
     * Menampilkan hasil dari semua fungsi aritmatika dengan angka yang diberikan.
     *
     * @param float $number1 Angka pertama untuk perhitungan.
     * @param float $number2 Angka kedua untuk perhitungan.
     */
    public static function printAllFunctionsAndResults(float $number1, float $number2): void {
        $arithmetic = new Arithmetic($number1, $number2);
        $functions = [
            'add',
            'subtract',
            'multiply',
            'divide',
        ];
        foreach ($functions as $function) {
            $result = $arithmetic->$function();
            echo "$function($number1, $number2); <br> $result <br>";
        } 
        echo 'Arithmetic::power('."$number1, $number2".');<br>';
        echo Arithmetic::power($number1, $number2);
    } //-> public static function printAllFunctionsAndResults
} //-> class Arithmetic 
echo 'Arithmetic::printAllFunctionsAndResults(10, 5);<br>';
Arithmetic::printAllFunctionsAndResults(10, 5);
?>
