<?php
include('db.php');
if(isset($_POST['copy_sablon'])){
    
    
    $sablon_acutal ="";

    $nume_sablon = strtolower($_POST['nume_sablon']);
    
    $sablon_cerere = $_POST['sablon_actual'];
    $sablon_header = $_POST['sablon_actual_header'];
    $sablon_footer = $_POST['sablon_actual_footer'];
    
    
    $sablon_acutal = "sablon_".$sablon_cerere;
   


    // aici se creeaza sablonul in TABELUL de sabloane 
    $insert_data = "INSERT INTO sabloane(nume , header_sablon , footer_sablon) VALUES ('$nume_sablon' , '$sablon_header' , '$sablon_footer')";  //val input creere
    $run_data = mysqli_query($con,$insert_data);
    
    if(!$run_data){
        die('Nu am putut insera numele sablonului in baza de date!').mysqli_error($con);
    }

    // aici se creeaza sablonul in sine
    $creeaza_tabel = "CREATE TABLE  sablon_$nume_sablon (
        id_produs int,
        cantitate int UNSIGNED NOT NULL DEFAULT '1',
        prioritate int NOT NULL AUTO_INCREMENT, INDEX `prioritate` (`prioritate`),
        PRIMARY KEY (id_produs)
    );";
    $run_data = mysqli_query($con,$creeaza_tabel);
    if(!$run_data){
        echo mysqli_error($con);
    }
   
    // aici se copiaza datele din tabelul original si se adauga in copie
    $select_sablon = "SELECT * FROM  $sablon_acutal";
    $select_sablon_query =mysqli_query($con,$select_sablon);

    while($row = mysqli_fetch_array($select_sablon_query)){

        $id_produs = $row['id_produs'];
	    $cantitate = $row['cantitate'];
	    $prioritate = $row['prioritate'];
        
        $insert_sablon_nou = "INSERT INTO sablon_$nume_sablon(id_produs,cantitate,prioritate) VALUES('$id_produs','$cantitate','$prioritate')";
        $run_insert = mysqli_query($con, $insert_sablon_nou);
    }
    header("location: sabloane.php");
}
?>

