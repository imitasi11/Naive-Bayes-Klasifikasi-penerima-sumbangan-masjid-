  
<?php 

include "../koneksi.php";
$jalan=0;
$jml_kriteria=0;
$count=1;
$well="";
$sql = 'SELECT * FROM kriteria order by id_kriteria';
$result = $db->query($sql);
$nokriteria=array();
foreach ($result as $row) {
    $nokriteria[$count]=$row['id_kriteria'];
    $jml_kriteria=$jml_kriteria+1 ;
    $count=$count+1;
    }

$tampung=array();
for($i=1;$i<=$jml_kriteria;$i++){
    $tampung[$i] = $_POST[$nokriteria[$i]];
}

$nama = $_POST['name'];
$alamat = $_POST['alamat'];

$id_responden=rand(1,300);
$cek_result = mysqli_query($connect,"SELECT * FROM responden where id_responden ='$id_responden' ")or die(mysqli_error());
$numrow = mysqli_num_rows($cek_result);


while($numrow > 0){
    $id_responden=0;
    $id_responden=rand(1,300);
    $cek_id= "SELECT * FROM responden where id_responden ='$id_responden' ";
    $cek_result = mysqli_query($connect,"SELECT * FROM responden where id_responden ='$id_responden' ")or die(mysqli_error());
$numrow = mysqli_num_rows($cek_result);

}
    if($numrow == 0){
        $input_responden = "INSERT INTO responden VALUES('$id_responden','$nama','$alamat') ";
    $responden_result = $db->query($input_responden);
    for($i=1;$i<=$jml_kriteria;$i++){
        $a=$nokriteria[$i];
        $b=$tampung[$i];
    $input_data = "INSERT INTO data (id_data,id_responden,id_kriteria,id_parameter) VALUES(NULL,'$id_responden','$a','$b') ";
    $data_result = $db->query($input_data);
        
    }
    header('Location: ../data-training.php');
    }



     

?>