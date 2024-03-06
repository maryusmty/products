<?php

include('db.php');

$nume_sablon = $_POST['nume_sablon_value'];
$link = $_POST['link'];
$get_data_sablon_tmp = "SELECT * FROM sablon_$nume_sablon";
$run_data_sablon_tmp = mysqli_query($con, $get_data_sablon_tmp);
$i = 0;
while($row = mysqli_fetch_array($run_data_sablon_tmp)) {
    $id_produs = $row['id_produs'];
    $cantitate_id = "cantitate_".$id_produs;
    $prioritate_id = "nr_produs_".$id_produs;   
    
    $update = "UPDATE sablon_$nume_sablon SET cantitate='$_POST[$cantitate_id]', prioritate='$_POST[$prioritate_id]' WHERE id_produs = $id_produs ";
    $run_update = mysqli_query($con,$update);
    if(!$run_update){
        echo "Data not update".mysqli_error($con);
    }
}
if(!empty($_POST['check_list'])) {
    foreach($_POST['check_list'] as $id_produs) {
        $delete_data = "DELETE FROM sablon_$nume_sablon WHERE id_produs = $id_produs";
        echo $delete_data;
        $run_data = mysqli_query($con,$delete_data);
        if(!$run_data){
            die('Eroare la stergerea datelor in tabelul sablon din baza de date!').mysqli_error($con);
        }
    }
}
    $text_header = trim($_POST['text_header']);
	$text_footer = trim($_POST['text_footer']);
	$comision = $_POST['comision'];
    $timp_lucru = $_POST['ore_manopera'];
	$salriu_ora = $_POST['manopera'];
    $adaos_comercial = $_POST['adaos_comercial'];
    $current_time = date("Y-m-d H:i:s", strtotime('+1 hour'));
    $time = $current_time;

	
	$salvare_header ="UPDATE `sabloane` SET `header_sablon`='$text_header',`footer_sablon`='$text_footer', `comision`='$comision', `timp_lucru`='$timp_lucru', `salariu_ora`='$salriu_ora', `oferta_actualizata` = '$time', `adaos_comercial`='$adaos_comercial' WHERE nume= '$nume_sablon' ";
	
	$header_query = mysqli_query($con, $salvare_header);
	if(!$header_query){
		echo "Data not update".mysqli_error($con);
    }

echo $salvare_header;
header('location:'. $link);
?> 
<!-- sabloane.php -->