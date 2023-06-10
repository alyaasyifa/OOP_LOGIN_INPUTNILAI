<?php 
include 'koneksi.php';

$hapus = mysqli_query($server, "DELETE FROM kalkulator_nilai WHERE nis='$_GET[nis]'");
 if($hapus){
   echo "<script>alert('Data berhasil di hapus!');window.location = 'tampil.php';</script>";
 }
?>
