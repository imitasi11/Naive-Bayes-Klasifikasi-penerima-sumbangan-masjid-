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
    <?php 
$nomer=1;
$jml_kriteria=0;
$isi=array();
include "koneksi.php";

$count=1;

$sql = 'SELECT * FROM kriteria ORDER BY id_kriteria' ;
$result = $db->query($sql);
//-- menyiapkan variable penampung berupa array
$kriteria=array();
$nokriteria=array();
//-- melakukan iterasi pengisian array untuk tiap record data yang didapat
foreach ($result as $row) {
    $kriteria[$row['id_kriteria']]=$row['kriteria'];
    $nokriteria[$count]=$row['id_kriteria'];
    $jml_kriteria=$jml_kriteria+1 ;
    $count=$count+1;
    }
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
//-- query untuk mendapatkan semua data training di tabel responden dan data
$sql = 'SELECT * FROM data_test a JOIN responden_test b USING(id_responden) ORDER BY b.id_responden';
$result = $db->query($sql);
//-- menyiapkan variable penampung berupa array
$data=array();
$responden=array();
$alamat=array();
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
                                            <li><a href="#">Training<i class="ti-angle-down"></i></a>
                                                <ul class="submenu">
                                                    <li><a href="data-training.php">Data Training</a></li>
                                                    <li><a href="probabilitas.php">Tabel Probabilitas</a></li>
                                                </ul>
                                            </li>
                                            <li><a class="active" href="#">Testing<i class="ti-angle-down"></i></a>
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
                                <h1>Tabel Data Testing</h1>
                                <table class="table table-striped" style="margin-left:-60px;">
                 
                <thead>
                    <tr>
                   
                    <th colspan="3  "></th>
                    <th></th>
                    <?php 
                        //-- menampilkan header table
                        for($i=1;$i<=$jml_kriteria;$i++){ 
                            echo "<th style='text-align:center'></th>";
                        }
                        ?>
                        <th align="center" style="text-align:center"><a class="btn btn-success" href="data testing/input.php">tambah</a></th>
                  </tr>
                  <tr>
                    <th>#</th>
                    <th>Responden</th>
                    <th>Alamat</th>
                    <?php 
                        //-- menampilkan header table
                        for($i=2;$i<=$jml_kriteria;$i++){ 
                            echo "<th style='text-align:center'>{$kriteria[$nokriteria[$i]]}</th>";
                        }
                        ?>
                        <th style="text-align:center"><?php echo $kriteria[$nokriteria[1]];?></th>
                        <th colspan="2" align="center" style="text-align:center">Aksi</th>
                  </tr>
                </thead>
                   <tbody>
                        <?php
                        
                        //-- menampilkan data secara literal
                        foreach($data as $id_responden=>$dt_kriteria){
                            echo "<tr><td>{$nomer}</td>";
                            $nomer=$nomer+1;
                            echo "<td>{$responden[$id_responden]}</td>";
                            echo "<td>{$alamat[$id_responden]}</td>";
                            for($i=2;$i<=$jml_kriteria;$i++){ 
                                echo "<td>{$parameter[$nokriteria[$i]][$dt_kriteria[$nokriteria[$i]]]}</td>";
                            }
                            
                            echo "<td>{$parameter[1][$dt_kriteria[1]]}</td>";
                        ?>  <td><a class="btn btn-primary" href="data testing/edit.php?id=<?php echo $id_responden; ?>">edit</a></td>
                            <td><a class="btn btn-danger" href="data testing/delete.php?id=<?php echo $id_responden; ?>">delete</a></td></tr> <?php

                            }

                        ?>
                  </tr>
                </tbody>
              </table>
                            </div>
                        </div>
                    </div>
        </div>
    </div>
    <!-- features_area_end -->

    <!-- contact_us_end -->

    <!-- footer_start  -->
    <footer class="footer" style="margin-top: 220px;">
        
        <div class="copy-right_text">
            <div class="container">
                <div class="footer_border"></div>
                <div class="row">
                    <div class="col-xl-12">
                        <p class="copy_right text-center">
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This web is made by Fazjar Sekti AJi supported with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer_end  -->

    <!-- JS here -->
    <script src="js/vendor/modernizr-3.5.0.min.js"></script>
    <script src="js/vendor/jquery-1.12.4.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/isotope.pkgd.min.js"></script>
    <script src="js/ajax-form.js"></script>
    <script src="js/waypoints.min.js"></script>
    <script src="js/jquery.counterup.min.js"></script>
    <script src="js/imagesloaded.pkgd.min.js"></script>
    <script src="js/scrollIt.js"></script>
    <script src="js/jquery.scrollUp.min.js"></script>
    <script src="js/wow.min.js"></script>
    <script src="js/gijgo.min.js"></script>
    <script src="js/nice-select.min.js"></script>
    <script src="js/jquery.slicknav.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/plugins.js"></script>



    <!--contact js-->
    <script src="js/contact.js"></script>
    <script src="js/jquery.ajaxchimp.min.js"></script>
    <script src="js/jquery.form.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/mail-script.js"></script>


    <script src="js/main.js"></script>

    
  
  <!-- Modal -->
  <div class="modal fade custom_search_pop" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="serch_form">
                <input type="text" placeholder="search" >
                <button type="submit">search</button>
            </div>
          </div>
        </div>
      </div>
    <script>
        $('#datepicker').datepicker({
            iconsLibrary: 'fontawesome',
            icons: {
                rightIcon: '<span class="fa fa-calendar-o"></span>'
            }
        });
        $('#datepicker2').datepicker({
            iconsLibrary: 'fontawesome',
            icons: {
                rightIcon: '<span class="fa fa-calendar-o"></span>'
            }

        });
    </script>
</body>

</html>