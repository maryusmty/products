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
  <div class="jumbotron">
  <h1>Bun venit!</h1>
  <p>Alege o actiune:</p>
  	<p>
	  <!-- <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a></p> -->
	  <?php 
      if($update){ 
			echo '<a class="btn btn-danger btn-lg" role="button" href="" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Adauga produs</a>
			<a class="btn btn-danger btn-lg" role="button" href="produse.php"><i class="fa fa-eye"></i> Vizualizeaza produse</a>
			<a class="btn btn-primary btn-lg" role="button" name ="viz_sablon" href="sabloane.php"><i class="fa fa-eye"></i> Vizualizeaza sabloane</a>';
      }
      else{
        echo '<a class="btn btn-danger btn-lg" role="button" href="" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Adauga produs</a>
			  <a class="btn btn-danger btn-lg" role="button" href="produse.php"><i class="fa fa-eye"></i> Vizualizeaza produse</a>
              <a class="btn btn-primary btn-lg" role="button" name ="add_sablon" href="index.php?add_sablon=true"> <i class="fa fa-plus"></i> Adauga sablon</a>
			  <a class="btn btn-primary btn-lg" role="button" name ="viz_sablon" href="sabloane.php"><i class="fa fa-eye"></i> Vizualizeaza sabloane</a>';
      }	
	    ?>
		<?php 
		if($update){
			echo "
			<form action='creeaza_sablon.php' method='post'>
			<input required type='text' style='width:250px; margin-top: 10px; font-size: 16px;'name='nume_sablon' placeholder='Numele sablonului'>
			<a class='btn btn-sm btn-danger' name ='renunta_sablon' href='index.php'> <i class='fa fa-back'></i>Renunta</a>
			<button class='btn btn-sm btn-success' type='submit'> <i class='fa fa-save'></i> Salveaza</button></form>";
			
		}
	?>
	</p>
</div>
</nav>
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
									<option value="kg">KG</option>
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