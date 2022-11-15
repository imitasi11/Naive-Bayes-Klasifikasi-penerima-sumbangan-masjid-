
<?php 
include '../koneksi.php';
$id = $_GET['id'];
$delete_id= "DELETE FROM responden where id_responden ='$id' ";
$id_result = $db->query($delete_id);
$delete_data= "DELETE FROM data where id_responden ='$id' ";
$data_result = $db->query($delete_data);
header("location:../data-training.php");
?>