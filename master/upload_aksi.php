<!-- www.malasngoding.com -->
 
<?php 
// menghubungkan dengan koneksi
include 'koneksi.php';
// menghubungkan dengan library excel reader
include "excel_reader2.php";
?>
 
<?php
// upload file xls
$target = basename($_FILES['filepegawai']['name']) ;
move_uploaded_file($_FILES['filepegawai']['tmp_name'], $target);
 
// beri permisi agar file xls dapat di baca
chmod($_FILES['filepegawai']['name'],0777);
 
// mengambil isi file xls
$data = new Spreadsheet_Excel_Reader($_FILES['filepegawai']['name'],false);
// menghitung jumlah baris data yang ada
$jumlah_baris = $data->rowcount($sheet_index=0);
 
// jumlah default data yang berhasil di import
$berhasil = 0;
$count=3;
$count2=1;
for ($i=2; $i<=$jumlah_baris; $i++){
 
	// menangkap data dan memasukkan ke variabel sesuai dengan kolumnya masing-masing
	$id=$data->val($i,1);
	$nama	= $data->val($i, 2);
	$alamat	= $data->val($i, 3);
 	$dinding	= $data->val($i, 10);
 	$atap	= $data->val($i, 11);
 	$lantai	= $data->val($i, 12);
 	$penghasilan	= $data->val($i, 13);
 	$anggota	= $data->val($i, 14);
 	$ketentuan	= $data->val($i, 15);
 	$paramdinding	= $data->val($i, 16);
 	$paramatap	= $data->val($i, 17);
 	$paramlantai	= $data->val($i, 18);
 	$parampenghasilan	= $data->val($i, 19);
 	$paramanggota	= $data->val($i, 20);
 	$paramketentuan	= $data->val($i, 21);
 	

	if($nama != "" ){
		mysqli_query($connect,"INSERT INTO responden VALUES('$id','$nama','$alamat')");
		
	}
}
 header("location:upload.php");
// hapus kembali file .xls yang di upload tadi
unlink($_FILES['filepegawai']['name']);
 
// alihkan halaman ke index.php

?>