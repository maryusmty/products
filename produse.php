<?php
include('db.php');
include('currency.php');

$update = false;
if (isset($_REQUEST['add_sablon'])){
	$update = true;
} else {
	$update = false;
}

$get_valori = "SELECT * FROM valori";
$run_valori = mysqli_query($con,$get_valori);
while($row = mysqli_fetch_array($run_valori)){

	$val_euro = $row['val_euro'];
	$val_adaos = $row['val_adaos']; 

}
session_start();
if (isset($_SESSION['user_id']) && isset($_SESSION['user_email'])) { 
?>

<!DOCTYPE html>
<html>
<head>
	<title>Operare baza de date - Produse</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" media="all">
	 <!-- core style css -->
    <link href="css/style.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> 

</head>
<body>
	<?php include('inc/header.php') ?>
	<div class="container big_container">
	<!-- <img src="logo_rostil.png" alt=""  style="margin-top:2%; margin-bottom:-5px; ">--><br><br>
  <!-- <h3><br><b>Editare baza de date</b></h3> -->
  <br><nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page"><h3>Editare baza de date</h3></li>
      </ol>
    </nav>
    <a class="btn btn-danger btn-lg" role="button" href="index.php"><i class="fa fa-arrow-left"></i> Inapoi</a>
  </div>
</nav>


  <?php 
		if($update){
			echo "
			<form action='creeaza_sablon.php' method='post'>
			<input required type='text' style='width:250px; margin-top: 10px; font-size: 16px;'name='nume_sablon' placeholder='Numele sablonului'>
			<a class='btn btn-sm btn-danger' name ='renunta_sablon' href='index.php'> <i class='fa fa-back'></i>Renunta</a>
			<button class='btn btn-sm btn-success' type='submit'> <i class='fa fa-save'></i> Salveaza</button>";
			
		}
	?>
		<table class="table table-bordered table-striped table-hover" id="myTable">
		<thead style="background-color:#bfbdbd;">
			<tr>
				<th style="vertical-align: middle;" class="text-center" scope="col">Nr.<br>Crt</th>
			   	<th style="vertical-align: middle;" class="text-center" scope="col">Imagine</th>
				<th style="vertical-align: middle;" class="text-center" scope="col">Produs</th>
				<th style="vertical-align: middle;" class="text-center" scope="col">Descriere</th>
				<th style="vertical-align: middle;" class="text-center" scope="col">U.M</th>
				<th style="vertical-align: middle;" class="text-center" scope="col">Categorie</th>
				<th style="vertical-align: middle; min-width:100px;" class="text-center" scope="col">Pret de achizitie<br>(Lei fara TVA)</th>
				<th style="vertical-align: middle; min-width:200px;" class="text-center" scope="col4">Actiuni</th>
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
			
        		if($update == false){
				echo "
				<tr>
				<td style='vertical-align:middle;'class='text-center'>$sl</td>
				<td style='vertical-align:middle;'class='text-center'><img src='upload_images/$image' alt='' width = 100;></td>
				<td style='vertical-align:middle; text-align: center;; min-width:200px;'class='text-left'>$produs</td>
				<td style='vertical-align:middle; min-width:300px; max-width:400px;'class='text-left'><p>$descriere</p></td>
				<td style='vertical-align:middle; text-align: center;'class='text-left'>$status</td>
				<td style='vertical-align:middle;'class='text-center'>$categorie</td> 
				<td style='vertical-align:middle;'class ='text-center'>$price</td> 
				<td style='vertical-align:middle;'class='text-center'>
					<span>
					<a href='#' class='btn btn-success mr-3 profile' data-toggle='modal' data-target='#view$id' title='Details'><i class='fa fa-address-card-o' aria-hidden='true'></i></a>
					</span>
					<span>
					<a href='#' class='btn btn-warning mr-3 edituser' data-toggle='modal' data-target='#edit$id' title='Edit'><i class='fa fa-pencil-square-o fa-md'></i></a>
					</span>
					<span>
					<a href='#' class='btn btn-danger deleteuser' data-toggle='modal' data-target='#$id' aria-hidden='true' title='Delete' ><i class='fa fa-trash-o fa-md'></i></a>
					</span>
					<span>
					<a href='#' class='btn btn-primary copyprodus' data-toggle='modal' data-target='#copy$id' aria-hidden='true' title='Copy' ><i class='fa fa-clone s fa-md'></i></a>
					</span>
				</td>
			</tr>";}
			else{
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
						<input type='checkbox' class='addsablon' name='check_list[]' value='$id' autocomplete='off' style='display:none;'> <i class='fa fa-plus'></i>
                        </label>
					</span>
				</td>
			</tr>";}
			}
			

        	?>
		</table>
    <?php
		if($update){
			echo '</form>';
		}
	?>
	<!-- <form method="post" action="export.php">
     	<input type="submit" name="export" class="btn btn-success" value="Export Data" />
    </form> -->
	</div>


	<!---Adauga produs modal---->

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
		<center><img src="logo_rostil.png" alt=""></center>
        <h4 class="modal-title text-center">Adauga un produs nou</h4>
      </div>
      <div class="modal-body">
        <form action="add.php" method="POST" enctype="multipart/form-data">
			
			<!-- #add.php  -->
			<!-- ADAUGI UN PRODUS IN BAZA DE DATE  -->

<div class="form-row">
<div class="form-group col-md-6">
<label for="produs">Nume Produs</label>
<input type="text" class="form-control" name="produs" id="produs" placeholder="Introdu numele produsului"  required>
</div>
<div class="form-group col-md-6">
<label for="pret">Pret de achizitie (Lei fara TVA)</label>
<input type="text" class="form-control" name="pret"  id="pret" placeholder="Introdu pretul produsului" maxlength="10" required>
</div>
</div>

<!-- UPDATE NOU 16/08 -->
<div class="form-row">
<div class="form-group col-md-6">
<label for="manopera_produs">Manopera produs (Lei cu TVA)</label>
<input type="text" class="form-control" name="manopera_produs" id="manopera_produs" placeholder="Introdu manopera produsului"  required>
</div>
<div class="form-group col-md-6">
<label for="timp_montare">Timp de montare (Ore)</label> 
<input type="text" class="form-control" name="timp_montare"  id="timp_montare" placeholder="Introdu timpul de montare" maxlength="10" required>
</div>
</div>
<!-- SFARSIT UPDATE NOU 16/08 -->

<div class="form-group col-md-12">
<label for="descriere">Descriere produs</label>
    <textarea class="form-control" name="descriere" id="descriere" rows="3" placeholder="Introdu o descriere" required></textarea>
</div>

<div class="form-row">
<div class="form-group col-lg-6">
<label for="categorie">Categorie</label>
<select name="categorie" id="categorie" class="form-control">
  <option selected>Choose...</option>
									<option value="Boilere">Boilere</option>
									<option value="PDC">PDC</option>
									<option value="Puffere">Puffere</option>
									<option value="Pompe de circulatie">Pompe de circulatie</option>
									<option value="Chillere">Chillere</option>
									<option value="Automatizari">Automatizari</option>
									<option value="Ventiloconvectoare">Ventiloconvectoare</option>
									<option value="Teava si fiting-uri PP-R">Teava si fiting-uri PP-R</option>
									<option value="Teava si fiting-uri cupru">Teava si fiting-uri cupru</option>
									<option value="Robinete din alama">Robinete din alama</option>
									<option value="Fiting-uri din alama">Fiting-uri din alama</option>
									<option value="Filtre pentru apa">Filtre pentru apa</option>
									<option value="Incalzire in pardoseala">Incalzire in pardoseala</option>
									<option value="Racorduri flexibile">Racorduri flexibile</option>
									<option value="Instrumente de masura">Instrumente de masura</option>
									<option value="Vase de expansiune">Vase de expansiune</option>
									<option value="Radiatoare">Radiatoare</option>
									<option value="Proiecte">Proiecte</option>
									<option value="Suruburi si sisteme de fixare">Suruburi si sisteme de fixare</option>
									<option value="Izolatii termice">Izolatii termice</option>
									<option value="Diverse acesorii">Diverse acesorii</option>
				
</select>
</div>
<div class="form-group col-lg-6">
<label for="status">U.M</label>
<select name="status" id="status" class="form-control">
  <option selected>Choose...</option>
  									<option value="buc">Bucata</option>
									<option value="Pachet">Pachet</option>
									<option value="Set">Set</option>
									<option value="m">Metru liniar</option>
									<option value="mp">Metru patrat</option>
                                    <option value= "kg">KG</option>
</select>
		</div>






<div class="form-group col-md-12">
        		<label>Image</label>
        		<input type="file" name="image" id="image" class="form-control" >
        	</div>


	</div>

<div class="modal-footer">
		<a href="produse.php"><input type="submit" name="submit" class="btn btn-info btn-large pull-left" value="Submit"></a>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </form>
		</div> 
		  </div>  
	  </div>
	</div>
</div>


	<!---Config in modal---->

<!-- Modal -->
<div id="myConfig" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
		<center><img src="logo_rostil.png" alt=""></center>
        <h4 class="modal-title text-center">Configurari pagina</h4>
      </div>

        <form action="configurari.php" method="POST" enctype="multipart/form-data">
			

<div class="form-row">
<div class="form-group col-md-6">
<label for="adaos_com">Adaos comercial</label>
<input type="text" class="form-control" name="adaos_com" placeholder="Introdu adaos" value="10" required>
</div>
<div class="form-group col-md-6">
<label for="val_euro">Valoare euro:</label>
<input type="phone" class="form-control" name="val_euro" placeholder="Introdu pretul produsului" value="<?php echo $val_euro; ?>" required>
</div>
</div>
	

<div class="modal-footer">
		<input type="submit" name="submitconfig" class="btn btn-info btn-large pull-left" value="Submit">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </form>
		</div> 
		  </div>  
	  </div>
	</div>
</div>


<!------DELETE modal---->
<!-- Modal -->
<?php
$get_data = "SELECT * FROM products";
$run_data = mysqli_query($con,$get_data);

while($row = mysqli_fetch_array($run_data))
{
	$id = $row['id'];
	echo "
	<div id='$id' class='modal fade' role='dialog'>
  	<div class='modal-dialog'>

    <!-- Modal content-->
    <div class='modal-content'>
      <div class='modal-header'>
        <button type='button' class='close' data-dismiss='modal'>&times;</button>
        <h4 class='modal-title text-center'>ESTI SIGUR CA VREI SA STERGI PRODUSUL DIN BAZA DE DATE?</h4>
      </div>
      <div class='modal-body'>
        <a href='delete.php?id=$id' class='btn btn-danger' style='margin-left:250px'>Sterge</a>
      </div>
    </div>
  </div>
</div>";	
}?>

<!-- View modal  -->

<?php
// <!-- profile modal start -->
$get_data = "SELECT * FROM products";
$run_data = mysqli_query($con,$get_data);

while($row = mysqli_fetch_array($run_data))
{
	$id = $row['id'];
	$produs = $row['db_produs'];
	$status = $row['db_status'];
	$categorie = $row['db_categorie'];
	$pret = $row['db_pret'];
	$actualizare = $row['db_actualizare'];
	$image = $row['image'];
	$tva = 1.19;
	$pret_tva_adaos =  $pret * $val_adaos * $tva;
	$pret_euro = $pret/$val_euro;

	$pret_adaos = $pret * ($val_adaos - 1);  


	$show_pret_euro = number_format((float)$pret_euro, 2, ',', '');
	$show_pret_lei = number_format((float)$pret_tva_adaos, 2, ',', '');

	echo "

		<div class='modal fade' id='view$id' tabindex='-1' role='dialog' aria-labelledby='userViewModalLabel' aria-hidden='true'>
		<div class='modal-dialog'>
			<div class='modal-content'>
			<div class='modal-header'>
				<h2 class='modal-title' id='exampleModalLabel'>Fisa produs:</h2>
				<button type='button' class='close' data-dismiss='modal' aria-label='Close'>
				<span aria-hidden='true'>&times;</span>
				</button>
			</div>
			<div class='modal-body'>
			<div class='container big_container' id='profile'> 
				<div class='row'>
					<div class='col-sm-1'>
						<img src='upload_images/$image' alt='' style='width: 150px; height: 150px;' ><br>  
		
						<i class='fa fa-archive' aria-hidden='true'></i> <strong>$produs</strong><br>
					</div>
					<div class='col-sm-3 col-md-6'>
						
						<p class='text-secondary'>
						<i class='fa fa-money' aria-hidden='true'></i><strong> Preturi</strong><br><strong> Pret de achizitie :</strong> $pret (Lei fara TVA)<br>
						<strong>Pret de vanzare:</strong> $show_pret_lei (Lei cu TVA)<br><strong>Pret de vanzare:</strong> $show_pret_euro (Euro fara TVA)<br><strong>Valoare adaos:</strong> $pret_adaos (Lei fara TVA)
						<br><br>
						<strong>U.M:</strong> $status <br>
						<i class='fa fa-folder-open' aria-hidden='true'></i><strong> Categorie:</strong> $categorie <br>
						<i class='fa fa-calendar' aria-hidden='true'><strong> Actualizat:</strong> $actualizare </i>
					</p>
						<!-- Split button -->
					</div>
				</div>

			</div>   
			</div>
			<div class='modal-footer'>
				<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
			</div>
			</form>
			</div>
		</div>
		</div> 


    ";
}


// <!-- profile modal end -->


?>



<!----edit Data--->

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
        <form action='edit.php?id=$id' method='post' enctype='multipart/form-data'>

		<div class='form-row'>
		<div class='form-group col-md-6'>
		<label for='inputEmail4'>Produs</label>
		<input type='text' class='form-control' name='produs' placeholder='Introdu numele produsului' value='$produs' required>
		</div>
		<div class='form-group col-md-6'>
		<label for='inputPassword4'>Pret de achizitie (Lei fara TVA)</label>
		<input type='phone' class='form-control' name='pret' placeholder='Introdu pretul produsului' value='$pret' required>
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


<!------Copy modal---->
<!-- Modal -->
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

  echo "<div id='copy$id' class='modal fade' role='dialog'>
  <div class='modal-dialog'>

    <!-- Modal content-->
	<form action='copy_produs.php' method='post'>
    <div class='modal-content'>
      <div class='modal-header'>
        <button type='button' class='close' data-dismiss='modal'>&times;</button>
        <h4 class='modal-title text-center'>Doresti sa copiezi produsul ($produs)</h4>
		<center><label for='number_copy'>De cate ori copiezi produsul pentru editare: <input style='max-width:40px;' min='1' max='10'  type='number' name='number_copy' id='number_copy' value='1'></label></center>
      </div>
      <div class='modal-body'>
	  
	  <input type='hidden' name='produs_copy' value='$produs'>
	  <input type='hidden' name='descriere_copy' value='$descriere'>
	  <input type='hidden' name='status_copy' value='$status'>
	  <input type='hidden' name='categorie_copy' value='$categorie'>
	  <input type='hidden' name='pret_copy' value='$pret'>
	  <input type='hidden' name='actualizare_copy' value='$actualizare'>
	  <input type='hidden' name='image_copy' value='$image'>
	 
	  <center><button class='btn btn-primary' name='copy_produs' id='copy_produs'>Copiaza</button></center>
	  </form>
      </div>
    </div>
  </div>
</div>";	
}?>

<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

<!-- custom scripts -->
<script src="js/main.js"></script>
  <!-- Java script -->
  <script>
$(document).ready(function () {
    if (window.location.href === 'http://localhost/products/sablon.php?' && sessionStorage.scrollTop != "undefined") {
        $(window).scrollTop(sessionStorage.scrollTop);
    }
});


// Page 2, and not on page 1
window.onload = function () {
    delete sessionStorage.scrollTop;
};

window.onbeforeunload = function () {
    delete sessionStorage.scrollTop;
    return;
}

    </script>

</body>
</html>
<?php 
}else {
   header("Location: login.php");
}
 ?>