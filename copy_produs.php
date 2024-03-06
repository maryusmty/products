<?php
include('db.php');
$numar_copieri = $_POST['number_copy'];
$produs = $_POST['produs_copy'];
$produs_edit = addslashes ($produs." <b><font color='red'>SPRE EDITARE</font></b>");
$descriere = $_POST['descriere_copy'];
$status = $_POST['status_copy'];
$categorie = $_POST['categorie_copy'];
$pret = $_POST['pret_copy'];
$actualizare = $_POST['actualizare_copy'];
$image = $_POST['image_copy'];
$i = 0;
for ($i=0; $i < $numar_copieri;$i++){
$insert_copy = "INSERT INTO products(db_produs,db_descriere,db_status,db_categorie,db_pret,image,db_actualizare) VALUES ('$produs_edit','$descriere','$status','$categorie','$pret','$image',NOW())";
$run_data[$i] = mysqli_query($con,$insert_copy);
}
if($run_data){
	header('location:produse.php');
}else{
	die("Copierea produsului a esuat".mysqli_error($con));
}
?>