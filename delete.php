<?php

include('db.php');
$id = $_GET['id'];
$delete = "DELETE FROM products WHERE id = $id";
$run_data = mysqli_query($con,$delete);

if($run_data){
	header('location:produse.php');
}else{
	echo "Do not Delete";
}


?>