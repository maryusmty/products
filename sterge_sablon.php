<?php
include "db.php";

if(isset($_GET['delete_sablon'])){
    $nume = $_GET['sablon_de_sters'];
    echo $nume;
//   aici se sterge sablonul din tabelul SABLOANE
    $delete_row = "DELETE FROM sabloane WHERE nume = '$nume' ";
    $delete_query = mysqli_query($con,$delete_row);if(!$delete_query)   {die('PROBLEM!' . mysqli_error($con));}
//  aici se sterge TABELUL sablonului respectiv
    $drop_table = "DROP TABLE sablon_$nume";
    $drop_query = mysqli_query($con, $drop_table); if(!$drop_query) {die('DROP problem!'.mysqli_error($con));}
    }

header("location: sabloane.php");

?>