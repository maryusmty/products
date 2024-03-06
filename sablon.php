<?php
include('db.php');
include('currency.php');

$nume_sablon = '';
if (isset($_REQUEST['nume_sablon'])){
	$nume_sablon = $_REQUEST['nume_sablon'];
}

$get_valori = "SELECT * FROM valori";
$run_valori = mysqli_query($con,$get_valori);
while($row = mysqli_fetch_array($run_valori)){
	$val_euro = $row['val_euro'];
}
$get_data = "SELECT * FROM `sabloane` WHERE nume= '$nume_sablon'";
$run_data = mysqli_query($con,$get_data);

while($row = mysqli_fetch_array($run_data)){
	$comision = $row['comision'];
    $timp_lucru = $row['timp_lucru'];
    $salariu_ora = $row['salariu_ora'];
	$adaos_comercial = $row['adaos_comercial'];
	$id_oferta = $row['id'];
}


$link = $_SERVER['REQUEST_URI'];
session_start();
  if (isset($_SESSION['user_id']) && isset($_SESSION['user_email'])) { 
?>

<!DOCTYPE html>
<html>
<head>
	<title>Editare/Printare sablon</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="css/style.css" rel="stylesheet"> 	<!-- style.css  -->
	<link href="css/bootstrap.css" rel="stylesheet"> <!-- bootstrap 3.4.1 -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!-- iconite fa fa-icon -->

	<link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"> <!-- js_functii_tabel -->
	<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
	<script	script src="http://code.jquery.com/jquery-migrate-1.2.1.js"></script>
	
	<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.2.4.min.js"></script>
	<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.2.4.js"></script>

	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
	<!-- <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script> -->
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.24/themes/smoothness/jquery-ui.css">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.24/jquery-ui.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container big_container">
	<a id="a_imagine" href='index.php'><img src="logo_rostil.png" alt=""  style="margin-top:2%; margin-bottom:-35px;"></a>
	
	
	
	<br><br>
	<hr>
	
	<div class="div_title" id="title_data" style="visibility: hidden;"><span name="span_title" id ="span_title" class="pull-left"><p>Rostil Tehnoserv<br>RO22179536<br>J/29/1893/2007<br>0723 493 065</p></span></div>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
  <span id="title_page"><nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php" style="text-decoration: none;" >Editare baza de date</a></li>
        <li class="breadcrumb-item"><a href="sabloane.php" style="text-decoration: none;" >Vizualizeaza sabloane</a></li>
		<li class="breadcrumb-item active" aria-current="page">Sablon <?php echo $nume_sablon?></li>
		<li class="breadcrumb-item active" aria-current="page">Numar oferta: <?php echo $id_oferta ?></li>
      </ol>
    </nav>
  </div>
</nav></span>
		<form id="salveaza_sablonform" action="salveaza_sablon.php" method ="post"> 
		<input type='hidden' name="nume_sablon_value" value='<?php echo $nume_sablon ?>'>
		<input type='hidden' name="link" value='<?php echo $link ?>'>
		<span  id="btn_add_prod">
			<a  href="" class="btn btn-info" type="button"  data-toggle="modal" data-target="#adaugaprodusModal" style="margin-left:10px;"><i class="fa fa-plus"></i> Adauga produs in sablon</a>
		</span>


		<div style="justify-text:center;">
			<?php
				$get_data = "SELECT `header_sablon` , `id` FROM `sabloane` WHERE nume= '$nume_sablon'";
				$run_data = mysqli_query($con,$get_data);
                
				while($row = mysqli_fetch_array($run_data))
				{
					$header_sablon = $row['header_sablon'];
					$id_oferta = $row['id'];

					
				}
				$header_combinat = $header_sablon.' NR.'.$id_oferta;
				echo '<textarea class="text-center" name="text_header" id="text_header" cols="250" rows="3" spellcheck=false style="border:none;">'.$header_sablon.'</textarea>';
			?>
		</div>
		<input type='hidden' id='valoare_euro' value='<?php echo $val_euro ?>'> 

		<!-- final header -->
		<table class="table table-bordered table-striped table-hover" style= "border-bottom: none;" id="myTable" name="myTable">
		<thead style="background-color:#bfbdbd;">
			<tr class = "header_tabel">
			   <th  style="vertical-align:  middle; width:50px; " class="text-center" scope="col">Nr.<br>Crt</th>
			   	<th style="vertical-align: middle;" class="text-center" scope="col">Imagine</th>
				<th style="vertical-align: middle;" class="text-center" scope="col">Produs</th>
				<th style="vertical-align: middle;" class="text-center" scope="col">Descriere</th>
				<th style="vertical-align: middle;" class="text-center" scope="col">U.M</th>
				<th style="vertical-align: middle;" class="text-center" scope="col">Cantiate</th> 
				<!-- <th style="vertical-align: middle;" class="text-center" scope="col" >Manopera</th>  -->
				
				<th style="vertical-align: middle;" class="text-center" scope="col" id="pret_th">Pret unitar achizitie<br>(Lei fara TVA)</th>
				<th style="vertical-align: middle; max-width:50px;" class="text-center" id="adaos%_th" scope="col">Adaos<br>[%]</th>
				<th style="vertical-align: middle;"class="text-center" scope="col2" id="adaos_th">Adaos<br> (Lei fara TVA)</th>
				<th style="vertical-align: middle;" class="text-center" scope="col" id="total_th">Pret total achizitie<br> (Lei fara TVA)</th>
				<th style="vertical-align: middle;" class="text-center" scope="col" id="vanzare_th">Valoare<br> (Lei fara TVA)</th>
				<th style="vetical-align:middle;" class="text-center" scope="col3" id="actiuni_th">Actiuni<br>sablon</th> 
				<!-- <th style="vetical-align:middle;" class="text-center" scope="col2" id="move_th">Move</th>   -->  
			</tr>
		</thead>

		 
			<?php
			$sablon_ids = array();
        	$get_data_sablon = "SELECT * FROM sablon_$nume_sablon";
            $run_data_sablon = mysqli_query($con, $get_data_sablon);
			$i = 0;
        	while($row = mysqli_fetch_array($run_data_sablon))
        	{
				$sl = ++$i;
				$id_produs = $row['id_produs'];
				$prioritate = $row['prioritate'];
				array_push($sablon_ids, $id_produs);
				$cantitate_produs = $row['cantitate'];
				$adaos_individual = $row['adaos_produs'];
                $get_data_produs = "SELECT * FROM products WHERE id='$id_produs'";
                $run_data_produs = mysqli_query($con, $get_data_produs);
                $row_produse = mysqli_fetch_array($run_data_produs);
                $produs = $row_produse['db_produs']; // nume produs
				$descriere = $row_produse['db_descriere'];
				$status = $row_produse['db_status']; 
				$categorie = $row_produse['db_categorie'];
				$price = $row_produse['db_pret'];
        		$image = $row_produse['image'];
				$manopera_produs = $row_produse['db_manopera'];
				$timp_montare = $row_produse['db_timp'];
				
				
				echo "
				<tr>
				<td style='vertical-align: middle' class='text-center nr_produs_td' >$prioritate </td> 
				<td style='vertical-align: middle' class='text-center'><img src='upload_images/$image' alt='' width = 110;></td>
				<td style='vertical-align: middle; text-align: center;' class='text-left'>$produs <input class='nr_produs' type='hidden' name='nr_produs_$id_produs' value='$prioritate'></td>
				<td style='vertical-align:middle; min-width:300px; max-width:400px;'class='text-left'><p>$descriere</p></td>
				<td style='vertical-align: middle; text-align:center; ' class='text-left'>$status</td>
				<td style='vertical-align: middle; text-align:center;' class=' text-center tb_cantitate' name='cantitate_td'><input type='number' class='cantitate_produs' style='text-align:center; border:none; background:transparent;' id='cantitate_$id_produs' onchange='subTotal()' name='cantitate_$id_produs' min='1' max='9999' value='$cantitate_produs'></td> 
				

				<td style='vertical-align: middle' class ='text-center' name='tb_pret2'> $price<input type='hidden' name='tb_pret' value='$price'></td>
				<td style='vertical-align: middle; max-width:60px;' class='text-center tb_add' name='adaos_td'> <input style='max-width:50px;' style='text-align:center;' type='number' id='adaos_procent_$id_produs' onchange='subTotal()' name='adaos_procent' min='-100' max='999' step='1' value='$adaos_individual'></td> 
				<td style='vertical-align: middle' class ='text-center' id='tb_adaos' name='tb_adaos'> </td> 
				<td style='vertical-align: middle' class ='text-center' id='tb_total' name='tb_total'> </td> 
				<td style='vertical-align: middle' class ='text-center' id='tb_vanzare' name='tb_vanzare'> </td> 
				<td style='vertical-align: middle' class ='text-center' id='tb_actiuni' name='tb_actiuni'>
				
				<label class='btn btn-danger'>
				<input type='checkbox' class='deletesablon' name='check_list[]' value='$id_produs' autocomplete='off' style='display:none;'> <i class='fa fa-trash'></i> 
				</label>
			
				<span>
			
				<a href='#' class='btn btn-warning mr-3 edituser' data-toggle='modal' data-target='#edit$id_produs' title='Edit'><i class='fa fa-pencil-square-o fa-md'></i></a>
				</span>
			</tr>";
		}
	?>
		<!-- de adaugat !!!!!!!	<td style='vertical-align: middle; text-align:center; ' class='text-left'>Manopera: $manopera_produs lei</td> !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! -->
		</table><br>
		<table  class="table table-bordered table-striped table-hover" id="myTable2" name="myTable2">
		<tr>
			<td style='vertical-align: middle' class ='text-center' id='td_cost' name='td_cost' > 
				<h4><strong>COST TOTAL: <b><span id="vanzare"></span> </b>  
					<span id="moneda_lei"> Lei cu TVA</span> 
						<span hidden id="moneda_euro"> Euro cu TVA</span><strong></h4>

						</td>
	</tr>

		</table>
		<!--	<span><input type='button' value='↑' class='move up btn btn-primary' /> 
        		<span><input type='button' value='↓' class='move down btn btn-primary' /></span>  -->



				<span id='input_salveaza_sablon'><button class="btn btn-success" type="submit" name="salveaza_sablon" id="salveaza_sablon">Salveaza sablon</button></span>
				<span id='print_span'><a class='btn btn-default' name='print_btn' id='print_btn' style='margin-left:5px !important;' href='#'>Printeaza sablon fara preturi</a></span>
 				<span id='print_span_2'><a class='btn btn-default' name='print_btn_2' id='print_btn_2' style='margin-left:5px !important;' href='#'>Printeaza sablon cu preturi</a></span>
<br><br>

<div class ="pull-left" style="width: 30%;">
<?php
$get_data = "SELECT `footer_sablon` FROM `sabloane` WHERE nume= '$nume_sablon'";
$run_data = mysqli_query($con,$get_data);
while($row = mysqli_fetch_array($run_data))
{
	$footer_sablon = $row['footer_sablon'];

	echo '<textarea class="text-left" name="text_footer" id="text_footer" cols="75" rows="15" spellcheck=false style="border:none;">'.$footer_sablon.'</textarea>';
}
?>
</div>	
	 





	 	<!-- INCEPUT AFISAREA SUMELOR -->
		 <div class="pull-right" id="div_profit" style="width:60%;">
		 <span id="total_profit">
			<table class="table table-bordered table-striped table-hover" id="myTable3" name="myTable3">
		<tr>
			<th style='vertical-align: middle' class ='text-center' id='td_cost' name='td_cost' > 
			<h4><strong>Total cheltuieli: <b><u><span id="valoare_totala_cheltuieli"></span></u> </b>  
					<span id="moneda_lei"> Lei fara TVA</span><strong></h4>
			</th>
			<th style='vertical-align: middle' class ='text-center' id='td_cost' name='td_cost' > 
			<h4><strong>Total Venituri: <b><u><span id="total_venituri"></span></u> </b>  
					<span id="moneda_lei"> Lei fara TVA</span><strong></h4>
			</th>
		</tr>
				
		<tr>
			<td><h5>Salarii nete: <input id='manopera' name="manopera" onchange='subTotal()' type='number' style='text-align:center;' type='number' min='0' max='999999' value='<?php echo $salariu_ora;?>' step="5"></input> Lei fara TVA / ora </h5></td>
			<td><h5>Adaos manopera: <input id='adaos_manopera_procent' onchange='subTotal()' type='number' style='text-align:center; width:70px;' type='number' min='0' max='999' value='0.00' step="1"></input> [%]
				&nbsp&nbsp <span id='adaos_manopera_lei'></span> Lei fara TVA</h5></td>

		</tr>
	<tr>
			<td><h5>Timp lucru: <input id='ore_manopera' name="ore_manopera" onchange='subTotal()' type='number' style='text-align:center;' type='number' min='0' max='999999' value='<?php echo $timp_lucru;?>'></input> [ore]</h5></td>
			<td><h5>Manopera: <span id='valoare_manopera_ofertata'></span> Lei fara TVA &nbsp&nbsp||&nbsp&nbsp<span id='valoare_manopera_ofertata_cu_tva'></span> Lei cu TVA</h5></td>
		</tr>
		<tr>
			<td><h5>C.A.S: <input id='taxe_cas' onchange='subTotal()' type='number' style='text-align:center; width:70px;' type='number' min='0' max='100' value='21.25' step=".05"></input> [%]    
				&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspC.A.M: <input id='taxe_cam' onchange='subTotal()' type='number' style='text-align:center; width:70px;' type='number' min='0' max='100' value='2.25' step=".05"> [%]</h5></td> 
			
			<td><h5><strong>Adaos materiale: </strong><span id='adaos_materiale_valoare'></span> Lei fara TVA</h5></td>
		</tr>
	<tr>
		<td><h5><strong>Salarii nete:</strong> <span id='salarii_nete'></span> Lei fara TVA</h5>
				<h5><strong>Salarii brute:</strong> <span id='salarii_brute'></span> Lei fara TVA</h5></td>	
		<td><h5><strong>Pret de vanzare materiale: </strong><span id='total_vanzare'></span> Lei fara TVA</h5></td>
		
	</tr>
	<tr>
		<td><h5>Transport: <input id='transport'  onchange='subTotal()' type='number' style='text-align:center;' type='number' min='0' max='999999' value='0'></input> [KM]</h5>
				<h5><b>Total transport:</b> <span id="total_transport"></span> Lei fara TVA || <span id="total_transport_cu_tva"></span> Lei cu TVA</h5></td>	
		<td><h5><h5><strong>Pret de vanzare materiale cu TVA: </strong><span id='total_materiale_cu_tva'></span> Lei cu TVA</h5></td>
		
	</tr>
	<tr>
		<td ><h5>Comision: <input id='comision' name="comision" onchange='subTotal()' type='number' style='text-align:center;' type='number' min='0' max='999999' value='<?php echo $comision;?>'></input> [Lei cu TVA]</h5>
				<h5><strong>Pret de achizitie materiale:</strong> <span id='ptotal'></span> Lei fara TVA </h5>	
				<h5><strong>Pret de achizitie materiale cu TVA:</strong> <span id='ptotal_materiale_tva'></span> Lei cu TVA </h5></td>
				
		<td>		<strong>Adaos comercial lucrare:</strong> <span id="input_adaos"><input type="number" id="adaos_comercial" style='width:50px;' onchange="updateAdaos()" name="adaos_comercial" min="1" max="999" step='1' value='<?php echo $adaos_comercial ?>'></span></input> <strong> [%]</strong></td>
	</tr>







		</table></span>
		
        <span id="total_profit">
				<!-- <h4><strong>Total venituri:</strong> <span id='total_venituri'></span> Lei fara TVA</h4> -->
				<!-- <h5>Adaos manopera: <input id='adaos_manopera_procent' onchange='subTotal()' type='number' style='text-align:center; width:70px;' type='number' min='0' max='999' value='15.00' step="1"></input> [%]
				&nbsp&nbsp <span id='adaos_manopera_lei'></span> Lei fara TVA</h5> -->
				<!-- <h5>Manopera: <span id='valoare_manopera_ofertata'></span> Lei fara TVA &nbsp&nbsp||&nbsp&nbsp<span id='valoare_manopera_ofertata_cu_tva'></span> Lei cu TVA</h5> -->
				<!-- <hr> -->
				<!-- <h5><strong>Adaos materiale: </strong><span id='adaos_materiale_valoare'></span> Lei fara TVA</h5> -->
				<!-- <h5><strong>Pret de vanzare materiale: </strong><span id='total_vanzare'></span> Lei fara TVA</h5> -->
				<!-- <h5><strong>Pret de vanzare materiale cu TVA: </strong><span id='total_materiale_cu_tva'></span> Lei cu TVA</h5> -->
				<!-- <hr> -->
			</span>	


		</div>
 <!-- INCEPUT COLOANA 2 -->
 		<div class="pull-right" id="div_cheltuieli" style="width:25%;">
			 <span id="total_cheltuieli">
				<!-- <h4><strong>Total cheltuieli: </strong><span id="valoare_totala_cheltuieli"></span> Lei fara TVA</h4> -->
				<!-- <h5>Salarii nete: <input id='manopera' name="manopera" onchange='subTotal()' type='number' style='text-align:center;' type='number' min='0' max='999999' value='<?php echo $salariu_ora;?>' step="5"></input> Lei fara TVA / ora </h5> -->
				<!-- <h5>Timp lucru: <input id='ore_manopera' name="ore_manopera" onchange='subTotal()' type='number' style='text-align:center;' type='number' min='0' max='999999' value='<?php echo $timp_lucru;?>'></input> [ore]</h5> -->
				<!-- <h5>C.A.S: <input id='taxe_cas' onchange='subTotal()' type='number' style='text-align:center; width:70px;' type='number' min='0' max='100' value='21.25' step=".05"></input> [%]    
				&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspC.A.M: <input id='taxe_cam' onchange='subTotal()' type='number' style='text-align:center; width:70px;' type='number' min='0' max='100' value='2.25' step=".05"> [%]</h5> -->
				<!-- <h5><strong>Salarii nete:</strong> <span id='salarii_nete'></span> Lei fara TVA</h5>
				<h5><strong>Salarii brute:</strong> <span id='salarii_brute'></span> Lei fara TVA</h5> -->
				<!-- <h5><b>Total manopera:</b> <span id="total_manopera"></span> Lei fara TVA || <span id="total_manopera_cu_tva"></span> Lei cu TVA</h5> -->
				<!-- <hr> -->
				<!-- <h5>Transport: <input id='transport'  onchange='subTotal()' type='number' style='text-align:center;' type='number' min='0' max='999999' value='0'></input> [KM]</h5>
				<h5><b>Total transport:</b> <span id="total_transport"></span> Lei fara TVA || <span id="total_transport_cu_tva"></span> Lei cu TVA</h5> -->
				<!-- <hr> -->
				<!-- <h5>Comision: <input id='comision' name="comision" onchange='subTotal()' type='number' style='text-align:center;' type='number' min='0' max='999999' value='<?php echo $comision;?>'></input> [Lei cu TVA]</h5>
				<hr>
				<h5><strong>Pret de achizitie materiale:</strong> <span id='ptotal'></span> Lei fara TVA </h5>	
				<h5><strong>Pret de achizitie materiale cu TVA:</strong> <span id='ptotal_materiale_tva'></span> Lei cu TVA </h5> -->
				</span>	
		</div>


	</form>
<!-- SFARSIT COLOANA 2 -->
 		<!-- SFARSIT AFISAREA SUMELOR -->






<!-- Modal pentru adaugare de produse -->
<!-- Modal -->
<div id="adaugaprodusModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
		<center><img src="logo_rostil.png"  alt=""></center>
        <h4 class="modal-title text-center">Adauga un produs nou</h4>
      </div>
      <div class="modal-body">
        <form action="adauga_in_sablon.php" method="POST" enctype="multipart/form-data">
			

            <table class="table table-bordered table-striped table-hover" id="adaugaproduseTable">
            <thead style="background-color:#bfbdbd;">
                <tr>
                    <th style="vertical-align: middle;" class="text-center" scope="col">Nr.<br>Crt</th>
                    <th style="vertical-align: middle;" class="text-center" scope="col">Imagine</th>
                    <th style="vertical-align: middle;" class="text-center" scope="col">Produs</th>
                    <th style="vertical-align: middle;" class="text-center" scope="col">Descriere</th>
                    <th style="vertical-align: middle;" class="text-center" scope="col">U.M</th>
                    <th style="vertical-align: middle;" class="text-center" scope="col">Categorie</th>
                    <th style="vertical-align: middle; min-width:100px;" class="text-center" scope="col">Pret de achizitie<br>(Lei fara TVA)</th>
                    <th style="vertical-align: middle; min-width:200px;" class="text-center" scope="col">Actiuni</th>
                    <!-- <th class="text-center" scope="col">Edit</th>
                    <th class="text-center" scope="col">Delete</th> -->
                </tr>
            </thead>
            <?php 

        	$get_data = "SELECT * FROM products order by 1";
        	$run_data = mysqli_query($con,$get_data);
			$i = 0;
        	while($row = mysqli_fetch_array($run_data))
        	{
				$sl = ++$i;
				$id = $row['id'];
				$descriere = $row['db_descriere'];
				$produs = $row['db_produs']; // nume produs
				$status = $row['db_status']; 
				$categorie = $row['db_categorie'];
				$price = $row['db_pret'];
				$actualizare = $row['db_actualizare'];

				// $u_l_name = $row['u_l_name'];
        		$image = $row['image'];
				if (!in_array($id, $sablon_ids)) {
					echo "
						<tr>
						<td style='vertical-align:middle' class='text-center'>$sl</td>
						<td style='vertical-align:middle' class='text-center'><img src='upload_images/$image' alt='' width = 100;></td>
						<td style='vertical-align:middle; text-align: center; min-width:200px;' class='text-left'>$produs</td>
						<td style='vertical-align:middle; min-width:300px; max-width:400px;'class='text-left'><p>$descriere</p></td>
						<td style='vertical-align:middle; text-align: center;' class='text-left'>$status</td>
						<td style='vertical-align:middle' class='text-center'>$categorie</td> 
						<td style='vertical-align:middle' class ='text-center'>$price</td> 
						<td style='vertical-align:middle' class='text-center'>
							<span>
								<label class='btn btn-info'>
									<input type='checkbox' class='addsablon' name='check_list[]' value='$id' autocomplete='off' style='display:none;'> <i class='fa fa-plus fa-md'></i>
								</label>
							</span>
						</td>
					</tr>";
				}
			}
		?>
        </table>
		</div>
<div class="modal-footer">
		<input type="hidden" name="nume_sablon" value="<?php echo $nume_sablon ?>">	
		<input type="submit" name="submit" class="btn btn-info btn-large pull-left" value="Submit">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </form>
		</div> 
		  </div>  
	  </div>
	</div>
</div>

<!-- END Modal -->



<!-- Modal pentru copiere de sablon -->
<!-- Modal -->
<div id="copiazasablonModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
		<center><img src="logo_rostil.png"  alt=""></center>
        <h4 class="modal-title text-center">Copiaza acest sablon</h4>
      </div>
    <div class="modal-body">
        <form action="copy_sablon.php" method="POST" enctype="multipart/form-data">
		
		<input type="hidden" name="sablon_actual" value="<?php echo $nume_sablon ?>">
		<label for="nume_sablon">Introdu numele noului sablon:<input required type='text' style='width:300px; margin:15px; padding:0; font-size: 16px;'name='nume_sablon' placeholder='Numele sablonului'></label>
		
	<div class="modal-footer">
			<input type="submit" name="copy_sablon" class="btn btn-info" style="margin-left:10px;" value="Copiaza sablon">
        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </form>
		</div> 
		  </div>  
	  </div>
	</div>
</div>

<!-- END Modal -->

<!-- Modal pentru stergerea de sablon -->
<!-- Modal -->
<div id="stergesablonModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
		<center><img src="logo_rostil.png"  alt=""></center>
        <h4 class="modal-title text-center">Sterge acest sablon</h4>
      </div>
    <div class="modal-body">
        <form action="sterge_sablon.php" method="GET" enctype="multipart/form-data">
		<center><h3>Esti sigur ca vrei sa stergi acest sablon?</h3></center>
		<input type="hidden" name="sablon_de_sters" value="<?php echo $nume_sablon ?>">
	<div class="modal-footer">
			<input type="submit" name="delete_sablon" class="btn btn-danger" style="margin-left:10px;" value="Sterge sablon">
        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </form>
		</div> 
		  </div>  
	  </div>
	</div>
</div>

<!-- END Modal -->






<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

<!-- custom scripts -->
<script src="js/main.js"></script>
<!--<script src="js/local_storage.js"></script>-->

  <!-- Java script -->


</body>
</html>
<?php 
}else {
   header("Location: login.php");
}
 ?>


<!-- EDIT MODAL -->
<?php

$get_data = "SELECT * FROM products";
$run_data = mysqli_query($con,$get_data);

while($row = mysqli_fetch_array($run_data))
{
	$id = $row['id'];
	$produs = $row['db_produs'];
	$descriere = $row['db_descriere'];
	$status = $row['db_status'];
	$categorie = $row['db_categorie'];
	$pret = $row['db_pret'];
	$actualizare = $row['db_actualizare'];
	$image = $row['image'];
	$manopera_produs = $row['db_manopera'];
	$timp_montare = $row['db_timp'];
	echo "

<div id='edit$id' class='modal fade' role='dialog'>
  <div class='modal-dialog'>

    <!-- Modal content-->
    <div class='modal-content'>
      <div class='modal-header'>
             <button type='button' class='close' data-dismiss='modal'>&times;</button>
             <h4 class='modal-title text-center'>Editeaza datele</h4> 
      </div>

      <div class='modal-body'>
        <form action='edit_sablon.php?id=$id' method='post' enctype='multipart/form-data'>

		<div class='form-row'>
		<div class='form-group col-md-6'>
		<label for='inputEmail4'>Produs</label>
		<input type='text' class='form-control' name='produs' placeholder='Introdu numele produsului' value='$produs' required>
		</div>
		<div class='form-group col-md-6'>
		<label for='inputPassword4'>Pret de achizitie (Lei fara TVA)</label>
		<input type='phone' class='form-control' name='pret' placeholder='Introdu pretul produsului' value='$pret' required>
		<input type='hidden' name='link_modal' value='$link'>
		</div>
		</div>
		
		<div class='form-row'>
		<div class='form-group col-md-6'>
		<label for='manopera_produs'>Manopera produs (Lei cu TVA)</label>
		<input type='text' class='form-control' name='manopera_produs' id='manopera_produs' placeholder='Introdu manopera produsului' value='$manopera_produs'  required>
		</div>
		<div class='form-group col-md-6'>
		<label for='timp_montare'>Timp de montare (Ore)</label> 
		<input type='text' class='form-control' name='timp_montare'  id='timp_montare' placeholder='Introdu timpul de montare' value='$timp_montare' maxlength='10' required>
		</div>
		</div>



		
		<div class='form-group col-md-12' id='editor2'>
		<label for='family'>Descriere produs</label>
			<textarea class='form-control' name='descriere' rows='3' placeholde='Introdu o descriere'>$descriere</textarea>
		</div>
		
		
		<div class='form-group col-lg-6'>
		<label for='inputState'>Categorie</label>
		<select name='categorie' class='form-control'>
		  <option>$categorie</option>
							<option value='Boilere'>Boilere</option>
							<option value='PDC'>PDC</option>
							<option value='Puffere'>Puffere</option>
							<option value='Pompe de circulatie'>Pompe de circulatie</option>
							<option value='Chillere'>Chillere</option>
							<option value='Automatizari'>Automatizari</option>
							<option value='Ventiloconvectoare'>Ventiloconvectoare</option>
							<option value='Teava si fiting-uri PP-R'>Teava si fiting-uri PP-R</option>
							<option value='Teava si fiting-uri cupru'>Teava si fiting-uri cupru</option>
							<option value='Robinete din alama'>Robinete din alama</option>
							<option value='Fiting-uri din alama'>Fiting-uri din alama</option>
							<option value='Filtre pentru apa'>Filtre pentru apa</option>
							<option value='Incalzire in pardoseala'>Incalzire in pardoseala</option>
							<option value='Racorduri flexibile'>Racorduri flexibile</option>
							<option value='Instrumente de masura'>Instrumente de masura</option>
							<option value='Vase de expansiune'>Vase de expansiune</option>
							<option value='Radiatoare'>Radiatoare</option>
							<option value='Proiecte'>Proiecte</option>
							<option value='Suruburi si sisteme de fixare'>Suruburi si sisteme de fixare</option>
							<option value='Izolatii termice'>Izolatii termice</option>
							<option value='Diverse acesorii'>Diverse acesorii</option>
		</select>
		</div>
		<div class='form-group col-lg-6'>
		<label for='inputState'>Status</label>
		<select name='status' class='form-control'>
		  <option>$status</option>
					<option value='buc'>Bucata</option>
					<option value='Pachet'>Pachet</option>
					<option value='Set'>Set</option>
					<option value='m'>Metru liniar</option>
					<option value='mp'>Metru patrat</option>
					<option value='kg'>KG</option>
		</select>
		</div>

        	<div class='form-group'>
        		<label>Imagine</label>
        		<input type='file' name='image' class='form-control'>
        		<img src = 'upload_images/$image' style='width:15%;'>
        	</div>

        	
        	
			 <div class='modal-footer'>
			 <input type='submit' name='submit' class='btn btn-info btn-large' value='Submit'>
			 <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
		 </div>
        </form>
      </div>
    </div>
  </div>
</div>";
}?>