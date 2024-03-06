<?php

include('db.php');

if(isset($_POST['submit'])){
	$produs = $_POST['produs'];
	$descriere = $_POST['descriere'];
	$status = $_POST['status'];
	$categorie = $_POST['categorie'];
	$pret = $_POST['pret'];
	$actualizare = $_POST['actualizare'];
	$manopera_produs = $_POST['manopera_produs'];
	$timp_montare = $_POST['timp_montare'];


	// $show_price = number_format((float)$pret, 2, ',', '');
	// $show_price2 = floatval($show_price);


	//image upload

	$msg = "";
	$image = $_FILES['image']['name'];
	$target = "upload_images/".basename($image);

	if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
  		$msg = "Image uploaded successfully";
  	}else{
  		$msg = "Failed to upload image";
  	}

  	$insert_data = "INSERT INTO products(db_produs,db_descriere,db_status,db_categorie,db_pret,image,db_actualizare,db_manopera,db_timp) VALUES ('$produs','$descriere','$status','$categorie','$pret','$image',NOW(),'$manopera_produs','$timp_montare')";
  	$run_data = mysqli_query($con,$insert_data);

  	if($run_data){
  		header('location:produse.php');
  	}else{
  		echo "Data not insert";
  	}

}

?>