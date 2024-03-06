<?php
include 'db.php';
if(isset($_POST['submitconfig']))
$val_euro = $_POST['val_euro'];
$val_adaos = $_POST['adaos_com'];
$upate_data = "UPDATE valori SET val_euro ='$val_euro', val_adaos= '$val_adaos'";
$run_data = mysqli_query($con,$upate_data);
if(!$run_data){
	die('Error'.mysqli_error($con));
}
header('location: index.php');
?>