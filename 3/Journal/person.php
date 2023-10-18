<?php
class Person {
    private string $name; // property string nama pribadi
    private int $age; // property integer umur pribadi
    public function __construct(string $name, int $age) { // konstruktor publik
        $this->name = $name;
        $this->age = $age;
    }
    public function getName(): string { // getter publik untuk nama
        return $this->name;
    }
    public function getAge(): int { // getter publik untuk umur
        return $this->age;
    }
    public function setName(string $name): void { // setter publik untuk string nama
        $this->name = $name;
    }
    public function setAge(int $age): void { // setter publik untuk integer umur
        $this->age = $age;
    }
    public static function greet(): void { // fungsi static publik untuk menyapa
        echo "Halo dari kelas Person!";
    }
}

$person = new Person("Glen", 20); // membuat objek Person baru dengan nama Glen dan umur 20

/** 
  * Coba akses properti private secara langsung
  * ini akan menghasilkan error
  */
// echo '<br> $person->name; <br>';
// echo $person->name; // Error: Property Person::$name is not accessible from outside the class

// Gunakan metode getter publik untuk mengakses properti private
echo '$person->getName(): <br>';
echo $person->getName(); // Glen
echo '<br> $person->getAge(): <br>';
echo $person->getAge(); // 21

/**
 * Coba set properti private secara langsung
 * Ini juga akan menghasilkan error
 */
// echo '<br> $person->name = "Andri": <br>';
// $person->name = "Andri"; // Error: Property Person::$name is not writable from outside the class

// Gunakan metode setter publik untuk set properti private
echo '<br> $person->setName("Andri"): <br>';
$person->setName("Andri");
echo '<br>$person->getName():<br>';
echo $person->getName(); // Andri
echo "<br>";
// Panggil metode static greet()
echo '<br> Person::greet():<br>';
Person::greet(); // Halo dari kelas Person!

?>