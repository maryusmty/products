<?php
include('db.php');

$get_data = "SELECT * FROM sabloane order by id DESC";
$run_data = mysqli_query($con,$get_data);
session_start();
  if (isset($_SESSION['user_id']) && isset($_SESSION['user_email'])) { 
?>

<!DOCTYPE html>
<html>
<head>
	<title>Operare baza de date - Produse</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->
	 <!-- core style css -->
    <link href="css/style.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->


    <!-- bootstrap 5 -->
    <!-- css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</head>
<body>
	<div class="container big_container">
    <img src="logo_rostil.png" alt=""  style="margin-top:2%; margin-bottom:-5px;"><br><br>
    


<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php" style="text-decoration: none;" >Editare baza de date</a></li>
        <li class="breadcrumb-item active" aria-current="page">Vizualizeaza sabloane</li>
      </ol>
    </nav>
  </div>
</nav><br>


<!-- ###ADAUGARE PAGINARE### -->
<?php
$carduriPePagina = 24;

$get_data = "SELECT COUNT(*) as id FROM sabloane ";
$run_data = mysqli_query($con,$get_data);
$row = mysqli_fetch_assoc($run_data);
$totalCarduri = $row['id'];

$totalPagini = ceil($totalCarduri / $carduriPePagina);

if (!isset ($_GET['pagina']) ) {  
  $paginaCurenta  = 1;  
} else {  
  $paginaCurenta = $_GET['pagina'];  
}  

$limita = ($paginaCurenta - 1) * $carduriPePagina;
$offset = $carduriPePagina;

$get_data = "SELECT * FROM sabloane ORDER BY id DESC LIMIT $limita, $offset";
$result = mysqli_query($con,$get_data);
?>
  <div class='row'>
    <?php 
        $i = 0;
        while($row = mysqli_fetch_assoc($result)){
            $sl = ++$i;
            $id = $row['id'];
            $nume_sablon = strtolower($row['nume']);
            $header_sablon = $row['header_sablon'];
            $footer_sablon = $row['footer_sablon'];
            $time = $row['oferta_actualizata'];
            echo "
            
                <div class='col-sm-2 mb-3'>
                <div class='card'>
                <div class='card-body'>
                    <h5 class='card-title'>$nume_sablon</h5>
                    <input type='hidden' name='sablon_de_sters' value='$id'>
                    <p class='card-text'>ACTUALIZAT: $time<br>OFERTA: $id</p>
                    <a href='sablon.php?nume_sablon=$nume_sablon' class='btn btn-primary'>Vizualizeaza</a>
                    <span class='pull-right'>
                    <a href='#' class='btn btn-danger' data-bs-toggle='modal'  data-bs-target='#stergeSablon_$nume_sablon' aria-hidden='true' title='Delete' ><i class='fa fa-trash-o fa-sm'></i></a>
                    <a href='#' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#copiazaSablon_$nume_sablon' aria-hidden='true' title='Copy' ><i class='fa fa-clone fa-sm'></i></a>
                    </span>
              </div>
              </div>
              </div>";

};
?> </div> 
<?php
echo '<center>';
echo '<nav aria-label="Pagini">';
echo '<ul class="pagination justify-content-center">';
for ($p = 1; $p <= $totalPagini; $p++) {
    // Adaugă clasa "active" pentru pagina curentă
    if ($p == $paginaCurenta) {
        echo '<li class="page-item active" aria-current="page">';
    } else {
        echo '<li class="page-item">';
    }
    echo '<a class="page-link" href="sabloane.php?pagina=' . $p . '">' . $p . '</a>';
    echo '</li>';
}
echo '</ul>';
echo '</nav>';
echo '</center>';
?>
<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  

<!-- Modal pentru stergerea de sablon -->

<?php
$get_data = "SELECT * FROM sabloane order by 1";
$run_data = mysqli_query($con,$get_data);

while($row = mysqli_fetch_array($run_data))
{
    $id = $row['id'];
	$nume_sablon = strtolower($row['nume']);
  $header_sablon = $row['header_sablon'];
  $footer_sablon = $row['footer_sablon'];
  

?>


<div class="modal fade" id="stergeSablon_<?php echo $nume_sablon;?>" tabindex="-1" aria-labelledby="stergesablonModalLabel" aria-hidden="true" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title text-center" id="stergesablonModalLabel">Sterge acest sablon</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form action="sterge_sablon.php" method="GET" enctype="multipart/form-data">
          <center><h4>Esti sigur ca vrei sa stergi acest sablon?</h4></center>
          <input type="hidden" name="sablon_de_sters" value="<?php echo $nume_sablon; ?>">
        
        <div class="modal-footer">
        <input type="submit" name="delete_sablon" class="btn btn-danger" style="margin-left:10px;" value="Sterge sablon">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- modal pentru copierea unui sablon -->
<div class="modal fade" id="copiazaSablon_<?php echo $nume_sablon?>" tabindex="-1" aria-labelledby="copiazasablonModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
      <!-- modal content -->
    <div class="modal-content">
      <div class="modal-header">
         <!-- <center><img src="logo_rostil.png"  alt=""></center> -->
        <h5 class="modal-title text-center" id="copiazasablonModalLabel">Copiaza acest sablon</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
      <form action="copy_sablon.php" method="POST" enctype="multipart/form-data">
		<input type="hidden" name="sablon_actual" value="<?php echo $nume_sablon ?>">
    <input type="hidden" name="sablon_actual_header" value="<?php echo $header_sablon ?>">
    <input type="hidden" name="sablon_actual_footer" value="<?php echo $footer_sablon ?>">
		<!-- <label for="nume_sablon">Introdu numele noului sablon:<input required type='text' style='width:300px; margin:15px; padding:0; font-size: 16px;'name='nume_sablon' placeholder='Numele sablonului'></label> -->
        <div class="form-floating">
            <input type="text" class="form-control" id="nume_sablon" name="nume_sablon" placeholder="Numele sablonului nou" required >
            <label for="nume_sablon">Numele sablonului nou</label>
        </div>
    </div>
      <div class="modal-footer">
      <input type="submit" name="copy_sablon" class="btn btn-primary" style="margin-left:10px;" value="Copiaza sablon">
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- terminarea modalului de copiere -->

<?php } ?>


<!-- custom scripts -->
<script src="js/main.js"></script>
  <!-- Java script -->


</body>
</html>
<?php 
}else {
   header("Location: login.php");
}
 ?>