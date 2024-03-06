<?php  
//export.php  
include 'db.php';
$output = '';
if(isset($_POST["export"]))
{
 $query = "SELECT * FROM products order by 1 desc";
 $result = mysqli_query($con, $query);
 if(mysqli_num_rows($result) > 0)
 {
  $output .= '
   <table class="table" bordered="1">  
                    <tr>  
                         <th>Nr.Crt</th>
                         <th>Imagine</th>   
                         <th>Produs</th>  
                         <th>Descriere</th>  
                         <th>Status</th>  
                         <th>Categorie</th>  
                         <th>Pret</th> 
                         <th>Ultima actualizare</th>
                    </tr>
  ';
  $i = 0;
  while($row = mysqli_fetch_array($result))
  {
    $sl = ++$i;
   $output .= '
    <tr>  
                         <td > '.$sl.' </td>
                         <td>'.$row["image"].'</td> 
                         <td>'.$row["db_produs"].'</td>  
                         <td>'.$row["db_descriere"].'</td>  
                         <td>'.$row["db_status"].'</td>  
                         <td>'.$row["db_categorie"].'</td>  
                         <td>'.$row["db_pret"].'</td>  
                         <td>'.$row["db_actualizare"].'</td>  
                    </tr>
   ';
  }
  $output .= '</table>';
  $current_time = date("Y-m-d H:i:s");
  header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
  header('Content-Disposition: attachment; filename='.$current_time.'.xls');
  echo $output;
 }
}
?>