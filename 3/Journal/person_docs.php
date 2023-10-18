<?php 
/**
 * Kelas Person
 *
 * Kelas ini mewakili seorang individu dengan nama dan usia.
 */
class Person {
    /** @var string Properti pribadi untuk nama individu. */
    private string $name;

    /** @var int Properti pribadi untuk usia individu. */
    private int $age;

    /**
     * Konstruktor untuk kelas Person.
     *
     * @param string $name Nama individu.
     * @param int $age Usia individu.
     */
    public function __construct(string $name, int $age) {
        $this->name = $name;
        $this->age = $age;
    }

    /**
     * Dapatkan nama individu.
     *
     * @return string Nama individu.
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * Dapatkan usia individu.
     *
     * @return int Usia individu.
     */
    public function getAge(): int {
        return $this->age;
    }

    /**
     * Setel nama individu.
     *
     * @param string $name Nama baru individu.
     */
    public function setName(string $name): void {
        $this->name = $name;
    }

    /**
     * Setel usia individu.
     *
     * @param int $age Usia baru individu.
     */
    public function setAge(int $age): void {
        $this->age = $age;
    }

    /**
     * Metode statis untuk memberi salam dari kelas Person.
     */
    public static function greet(): void {
        echo "Hello from the Person class!";
    }
}

$person = new Person("Glen", 20);

/** 
  * Cobalah mengakses properti pribadi secara langsung. 
  * Ini akan menghasilkan kesalahan.
  */
// echo '<br> $person->name; <br>';
// echo $person->name; // Error: Property Person::$name is not accessible from outside the class

// Gunakan metode getter publik untuk mengakses properti pribadi
echo '$person->getName(): <br>';
echo $person->getName(); // Glen
echo '<br> $person->getAge(): <br>';
echo $person->getAge(); // 21

/**
 * Cobalah untuk mengatur properti pribadi secara langsung.
 * Ini juga akan menghasilkan kesalahan.
 */
// echo '<br> $person->name = "Andri": <br>';
// $person->name = "Andri"; // Error: Property Person::$name is not writable from outside the class

// Gunakan metode setter publik untuk mengatur properti pribadi
echo '<br> $person->setName("Andri"): <br>';
$person->setName("Andri");
echo '<br>$person->getName():<br>';
echo $person->getName(); // Andri
echo "<br>";

// Panggil metode statis greet
echo '<br> Person::greet():<br>';
Person::greet(); // Hello from the Person class!
?>
