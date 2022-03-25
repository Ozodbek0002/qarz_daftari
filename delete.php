<?php
include 'baza.php';



$q_idd=$_GET['id'];

//$sql = "select * from qarzdor where id = '$q_idd' ";
//$result = mysqli_query($conn, $sql);
//$d = mysqli_fetch_assoc($result);


$desc = " To`landi!..";

date_default_timezone_set("Asia/Tashkent");
$date = date(" Y-m-d "); // Y,y/F,M,m/D,d,l---> yil oy kun formatlari

$sql_top = "select * from history where qarzdor_id = '$q_idd' ";
$result_top = mysqli_query($conn, $sql_top);
$d = mysqli_fetch_assoc($result_top);
$sum = $d['sum'];





$sql="insert into  history ( qarzdor_id, sum, descc, dataa)       
values (  '$q_idd', '$sum', '$desc', '$date')  ";
$result = mysqli_query($conn, $sql);


$sql_up="UPDATE qarzlar   SET sum = '0'   WHERE qarzdor_id = '$q_idd' ";
$result_update = mysqli_query($conn, $sql_up);


header("Location:show.php");

?>



