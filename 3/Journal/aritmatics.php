<?php
class Arithmetic {
    private float $number1;
    private float $number2;

    public function __construct(float $number1, float $number2) {
        $this->number1 = $number1;
        $this->number2 = $number2;
    }

    public function add(): float {
        return $this->number1 + $this->number2;
    }

    public function subtract(): float  {
        return $this->number1 - $this->number2;
    }

    public function multiply(): float  {
        return $this->number1 * $this->number2;
    }

    public function divide(): float  {
        return $this->number1 / $this->number2;
    }

    public static function power(int $base, int $exponent): float  {
        $result = 1;
        for ($i = 0; $i < $exponent; $i++) {
            $result *= $base;
        }
        return $result;
    }

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
            echo "$function($number1,$number2) = $result <br>";
        }
    }
}

$arithmetic = new Arithmetic(10, 5);
$sum = $arithmetic->add();
echo '$arithmetic = new Arithmetic(10, 5); <br>$arithmetic->add()<br>' . " $sum <br><br>";

echo 'Arithmetic::power(1,5);<br>';
echo Arithmetic::power(10,5);

echo '<br><br>Arithmetic::printAllFunctionsAndResults(10,5);<br>';
Arithmetic::printAllFunctionsAndResults(10,5);
?>