<?php
include('db.php');

function console_log($output, $with_script_tags = true) {
    $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . 
');';
    if ($with_script_tags) {
        $js_code = '<script>' . $js_code . '</script>';
    }
    echo $js_code;
}

$id = $_GET['id'];

if(isset($_POST['submit']))
{	
	$current_time = date("Y-m-d H:i:s", strtotime('+1 hour'));
	$produs = addslashes($_POST['produs']);
	$descriere = addslashes($_POST['descriere']);
	$status = $_POST['status'];
	$categorie = $_POST['categorie'];
	$pret = $_POST['pret'];
	$actualizare = $current_time;
	$manopera_produs = $_POST['manopera_produs'];  
	$timp_montare = $_POST['timp_montare']; 		
	// $show_price = number_format((float)$pret, 2, ',', '');
	// $show_price2 = floatval($show_price);

	$msg = "";
	$image = $_FILES['image']['name'];
	$target = "upload_images/".basename($image);
	if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
  		$msg = "Image uploaded successfully";
  	}else{
  		$msg = "Failed to upload image";
	  }
	if (!empty($image)){
		$update = "UPDATE products SET db_produs='$produs', db_descriere = '$descriere',db_status = '$status',db_categorie = '$categorie',db_pret = '$pret', image='$image', db_actualizare = '$actualizare',  db_manopera = '$manopera_produs', db_timp = '$timp_montare'  WHERE id=$id ";
	} else {
		$update = "UPDATE products SET db_produs='$produs', db_descriere = '$descriere',db_status = '$status',db_categorie = '$categorie',db_pret = '$pret', db_actualizare = '$actualizare', db_manopera = '$manopera_produs', db_timp = '$timp_montare'  WHERE id=$id ";
	}
	$run_update = mysqli_query($con,$update);

	if($run_update){
		header('location:produse.php');
	}else{
		echo "Data not update".mysqli_error($con);
	}
}

?>