<?php
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

<nav class="navbar navbar-fixed-top  navbar-inverse">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">ROSTIL</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
      <li><a href="" data-toggle="modal" data-target="#myConfig"><i class="fa fa-cogs"></i> Configurari</a></li>
     <!-- if($update){ 
			echo '<li><a href="" data-toggle="modal" data-target="#myConfig"><i class="fa fa-cogs"></i> Configurari</a></li>
            <li><a href="" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Adauga produs</a></li>
				    <li><a name ="viz_sablon" href="sabloane.php"><i class="fa fa-eye"></i> Vizualizeaza sabloane</a></li>';
      }
      else{
        echo '<li><a href="" data-toggle="modal" data-target="#myConfig"><i class="fa fa-cogs"></i> Configurari</a></li>
              <li><a href="" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Adauga produs</a></li>
              <li><a name ="add_sablon" href="index.php?add_sablon=true"> <i class="fa fa-plus"></i> Adauga sablon</a></li>
				      <li><a name ="viz_sablon" href="sabloane.php"><i class="fa fa-eye"></i> Vizualizeaza sabloane</a></li>';
      }	 -->
	    
       </ul>
       <p style="margin-right: 2%;" class="navbar-text navbar-right">Signed in as <a href="#" class="navbar-link" title="Profile"><?=$_SESSION['user_full_name']?></a> | <a href="logout.php" class="navbar-link" title="Logout">LOGOUT <i class="fa fa-arrow-right"></i></a></p>
       
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
</body>
</html>
<?php 
}else {
   header("Location: login.php");
}
 ?>