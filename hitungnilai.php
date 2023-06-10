<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>HITUNG NILAI !!! </title>
</head>
<body>
    <img src="https://media.tenor.com/-Y2YOay3_JoAAAAM/its-friday-dancing.gif" alt=""> 
    <div class="contactForm" >
    <h1>Masukan Nis Anda</h1>
    <form action="" method="post">
    <div class="inputBox" >
    <input type="number" name="nis" placeholder="NIS"><br></br>
    </div>

    <h1>Masukan Nilai Anda</h1>
        <div class="inputBox" >
        <input type="number" name="matematika" placeholder="MATEMATIKA"><br></br>

        <div class="inputBox" >
        <input type="number" name="pipas" placeholder="PIPAS"><br></br>
        </div>

        <div class="inputBox" >
        <input type="number" name="sejarah" placeholder="SEJARAH"><br></br>
        </div>

        <div class="inputBox" >
        <input type="number" name="produktif" placeholder="PRODUKTIF"><br></br>
        </div>

        <div class="inputBox" >
        <input type="number" name="bahasaindonesia" placeholder="BAHASA INDONESIA"><br></br>
        </div>

        <div class="inputBox" >
        <input type="number" name="bahasainggris" placeholder="BAHASA INGGRIS"><br></br>
        </div>

        <div class="inputBox" >
        <input type="submit" name="submit"><hr>   
        </div>

</div>
    </form>
    
    <br>
    <div class="inputBox" >
    <a class="logout" href="logout.php">Logout</a> |
    <a href="tampil.php">Tampilkan</a><br>
    </div>
<?php

session_start();

if( !isset($_SESSION["login"])){
    header("location: login.php");
    exit;
}

class GradeCalculator {
    private $matematika;
    public $pipas;
    protected $sejarah;
    private $produktif;
    public $bahasaindonesia;
    private $bahasainggris;
    protected $nis;

    public function __construct($matematika, $pipas, $sejarah, $produktif, $bahasaindonesia, $bahasainggris, $nis) {
        $this->matematika = $matematika;
        $this->pipas = $pipas;
        $this->sejarah = $sejarah;
        $this->produktif = $produktif;
        $this->bahasaindonesia = $bahasaindonesia;
        $this->bahasainggris = $bahasainggris;
        $this->nis = $nis;
    }

    public function calculateTotal() {
        $grades = [$this->matematika, $this->pipas, $this->sejarah, $this->produktif, $this->bahasaindonesia, $this->bahasainggris];
        return array_sum($grades);
    }

    public function calculateAverage() {
        $total = $this->calculateTotal();
        return $total / 6;
    }

    public function getMaximumGrade() {
        $grades = [$this->matematika, $this->pipas, $this->sejarah, $this->produktif, $this->bahasaindonesia, $this->bahasainggris];
        return max($grades);
    }

    public function getMinimumGrade() {
        $grades = [$this->matematika, $this->pipas, $this->sejarah, $this->produktif, $this->bahasaindonesia, $this->bahasainggris];
        return min($grades);
    }

    public function calculateGrade() {
        $total = $this->calculateTotal();
        if ($total >= 540) {
            return 'A';
        } elseif ($total >= 480) {
            return 'B';
        } elseif ($total >= 420) {
            return 'C';
        } else {
            return 'D';
        }
    }
}

if (isset($_POST['submit'])) {
    include "koneksi.php";

    $nis = $_POST['nis'];
    $matematika = $_POST['matematika'];
    $pipas = $_POST['pipas'];
    $sejarah = $_POST['sejarah'];
    $produktif = $_POST['produktif'];
    $bahasaindonesia = $_POST['bahasaindonesia'];
    $bahasainggris = $_POST['bahasainggris'];

    if ($_POST["nis"] == null) {
        echo "Isi Dulu Datanya Mas!";
        die;
    }

    $gradeCalculator = new GradeCalculator($matematika, $pipas, $sejarah, $produktif, $bahasaindonesia, $bahasainggris, $nis);
    
    $sql = "INSERT INTO `kalkulator_nilai`(`matematika`, `pipas`, `sejarah`, `produktif`, `bahasaindonesia`, `bahasainggris`, `nis`) VALUES ('$matematika', '$pipas', '$sejarah', '$produktif', '$bahasaindonesia', '$bahasainggris', '$nis')";
    $apakah = mysqli_query($server, $sql);
    echo "<br>";
    if ($apakah) {
        echo "Done !! ";
    }

    echo "<br>";
    echo "Jumlah Nilai: " . $gradeCalculator->calculateTotal();
    echo "<br>";
    echo "Rata - Rata Nilai: " . $gradeCalculator->calculateAverage();
    echo "<br>";
    echo "Nilai Maximal: " . $gradeCalculator->getMaximumGrade();
    echo "<br>";
    echo "Nilai Minimal: " . $gradeCalculator->getMinimumGrade();
    echo "<br>";
    echo "Grade Nilai Kamu Adalah: " . $gradeCalculator->calculateGrade();
}
?>

</body>
</html>