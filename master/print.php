<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>constructo</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <link rel="manifest" href="site.webmanifest"> -->
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.png">
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/themify-icons.css">
    <link rel="stylesheet" href="css/gijgo.css">
    <link rel="stylesheet" href="css/nice-select.css">
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/slicknav.css">

    <link rel="stylesheet" href="css/style.css">
    <!-- <link rel="stylesheet" href="css/responsive.css"> -->
     
<script src="jquery.js"></script> 
    
    <script> 
   
    function printContent(el){
    var restorepage = document.body.innerHTML;
    var printcontent = document.getElementById(el).innerHTML;
    document.body.innerHTML = printcontent;
    window.print();
    document.body.innerHTML = restorepage;
}
    </script> 
    <?php
$layak = 0;
$tidaklayak = 0;
$nomor = 1;
$probtidaklayak= 0;
$problayak= 0;
$jml_kriteria= 0;
$sum = 0;
$tambah= 0;

$isi=array();
include "koneksi.php";
$count=1;


$sql = 'SELECT * FROM kriteria';
$result = $db->query($sql);
//-- menyiapkan variable penampung berupa array
$kriteria=array();
//-- melakukan iterasi pengisian array untuk tiap record data yang didapat
foreach ($result as $row) {
    $kriteria[$row['id_kriteria']]=$row['kriteria'];
    $jml_kriteria=$jml_kriteria+1 ;
    $nokriteria[$count]=$row['id_kriteria'];
    $count=$count+1;
    }
?>

<?php
//-- query untuk mendapatkan semua data kriteria di tabel kriteria
$sql = 'SELECT * FROM parameter ORDER BY id_kriteria,id_parameter';
$result = $db->query($sql);
//-- menyiapkan variable penampung berupa array
$parameter=array();
$id_kriteria=0;
//-- melakukan iterasi pengisian array untuk tiap record data yang didapat
foreach ($result as $row) {
    if($id_kriteria!=$row['id_kriteria']){
        $parameter[$row['id_kriteria']]=array();
        $id_kriteria=$row['id_kriteria'];
    }
    $parameter[$row['id_kriteria']][$row['nilai']]=$row['parameter'];
}

?>

<?php

//-- query untuk mendapatkan semua data training di tabel responden dan data
$sql = 'SELECT * FROM data_test a JOIN responden_test b USING(id_responden) ORDER BY b.id_responden';
$result = $db->query($sql);
//-- menyiapkan variable penampung berupa array
$data=array();
$responden=array();
$id_responden=0;
//-- melakukan iterasi pengisian array untuk tiap record data yang didapat
foreach ($result as $row) {
    if($id_responden!=$row['id_responden']){
        $responden[$row['id_responden']]=$row['responden'];
        $alamat[$row['id_responden']]=$row['alamat'];
        $data[$row['id_responden']]=array();
        $id_responden=$row['id_responden'];
    }
    $data[$row['id_responden']][$row['id_kriteria']]=$row['id_parameter'];
}
//print_r($data);
//-- menampilkan data training dalam bentuk tabel

?>

              </head>

<body>
    <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

    <!-- header-start -->
    <header>
        <div class="header-area ">
            <div style="padding-top: 35px;">
            </div>
            <div id="sticky-header" class="main-header-area" style="border-bottom: 3px solid black">
                <div class="container">
                    <div class="white_bg_bar">
                        <div class="row align-items-center">
                            <div class="col-12 d-lg-none">
                                <div class="logo ">
                                    <a href="#">
                                        <img src="img/logo.png" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-8 col-lg-8">
                                <div class="main-menu  d-none d-lg-block">
                                    <nav>
                                        <ul id="navigation">
                                            <li><a href="halaman-awal.php">Home</a></li>
                                            <li><a class="active" href="#">Training<i class="ti-angle-down"></i></a>
                                                <ul class="submenu">
                                                    <li><a href="data-training.php">Data Training</a></li>
                                                    <li><a href="probabilitas.php">Tabel Probabilitas</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="#">Testing<i class="ti-angle-down"></i></a>
                                                <ul class="submenu">
                                                    <li><a href="data-testing.php">Data Testing</a></li>
                                                    <li><a href="print.php">Print Data</a></li>
                                                </ul>
                                            </li>
                                            
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 d-none d-lg-block">
                                <div class="Appointment d-flex justify-content-end">
                                    <div class="search_icon">
                                       
                                            Nama Web Disini gan
                                       
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mobile_menu d-block d-lg-none">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </header>
    <!-- header-end -->

    <!-- features_area_start -->
    <div class="features_area" style="margin-top: 40px;">
        <div class="container" style="padding-top: 100px;">
            <div class="row align-items-center justify-content-center">
                        <div class="col-xl-9 col-md-9 col-md-12">
                            <div align="center">
                 <a class="button button-contactForm btn_1 boxed-btn" onclick="printContent('div1')" href="#">Print</a>
              </header>
              <div id="div1" style="height: 300px;" align="center">
              <table class="table table-striped" align="center" style="margin-top: 21px;">

                 
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Responden</th>
                    <th>Alamat</th>
                    <?php 
                        //-- menampilkan header table
                        for($i=2;$i<=$jml_kriteria;$i++){ 
                            echo "<th style='text-align:center'>{$kriteria[$i]}</th>";
                        }
                        ?>
                        <th style="text-align:center"><?php echo $kriteria[1];?></th>
                  </tr>
                </thead>
                   <tbody>

                        <?php

                        //-- menampilkan data secara literal
                        foreach($data as $id_responden=>$dt_kriteria){
                            echo "<tr><td>$nomor</td>
                            <td style='text-align:center'>{$responden[$id_responden]}</td>
                            <td style='text-align:center'>{$alamat[$id_responden]}</td>";
                            for($i=2;$i<=$jml_kriteria;$i++){ 
                                echo "<td style='text-align:center'>{$parameter[$nokriteria[$i]][$dt_kriteria[$nokriteria[$i]]]}</td>";
                            }
                            echo "<td style='text-align:center'>{$parameter[1][$dt_kriteria[1]]}</td>";
                        ?>  </tr> <?php
                            $nomor=$nomor+1;
                            }

                        ?>
                 </tbody>
              </table>
           </div>
           <script>
           
        
    </script>