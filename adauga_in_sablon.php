<?php

include('db.php');

if(isset($_POST['submit'])){
    $nume_sablon = $_POST['nume_sablon'];

    // insereaza in tabelul nou creat toate produsele selectate
    if(!empty($_POST['check_list'])) {
        foreach($_POST['check_list'] as $id_checked) {
            $insert_data = "INSERT INTO sablon_$nume_sablon(id_produs) VALUES('$id_checked')";
            $run_data = mysqli_query($con,$insert_data);
            if(!$run_data){
                die('Eroare la inserarea datelor in tabelul sablon din baza de date!'.mysqli_error($con));
            }
        }
    }
    header('location:sablon.php?nume_sablon='.$nume_sablon); 
}

?>