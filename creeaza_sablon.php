<?php
include('db.php');
// adaug numele sablonului nou creat in lista de sabloane
$nume_sablon = strtolower($_POST['nume_sablon']);
$insert_data = "INSERT INTO sabloane(nume) VALUES ('$nume_sablon')";  //val input creere
$run_data = mysqli_query($con,$insert_data);
if(!$run_data){
    die('Nu am putut insera numele sablonului in baza de date!').mysqli_error($con);
}

//creeaza un nou tabel pentru sablonul nou creat care sa contina toate id-urile produselor
$creeaza_tabel = "CREATE TABLE  sablon_$nume_sablon (
    id_produs int,
    cantitate int UNSIGNED NOT NULL DEFAULT '1',
    -- prioritate int NOT NULL AUTO_INCREMENT, ADD INDEX prioritate(`prioritate`), 
    prioritate int NOT NULL AUTO_INCREMENT, INDEX `prioritate` (`prioritate`),
    PRIMARY KEY (id_produs),
);";
$run_data = mysqli_query($con,$creeaza_tabel);
if(!$run_data){
    die('Eroare la creearea tabelului<br>'.mysqli_error($con));
}


// insereaza in tabelul nou creat toate produsele selectate
if(!empty($_POST['check_list'])) {
    foreach($_POST['check_list'] as $id_checked) {
        $insert_data = "INSERT INTO sablon_$nume_sablon(id_produs) VALUES('$id_checked')";
        $run_data = mysqli_query($con,$insert_data);
        if(!$run_data){
            die('<br>Eroare la inserarea datelor in tabelul sablon din baza de date!<br>'.mysqli_error($con));
        }
    }
}
header('location:index.php');

?>