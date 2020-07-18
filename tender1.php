<?php
session_start();
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <title></title>
  </head>
  <body>
    <ul class="nav nav-pills nav-fill">
  <li class="nav-item">
    <a class="nav-link " href="tender1.php">welcome User</a>
  </li>
  <li class="nav-item">
    <a class="nav-link " href="des.php">Add Products</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="approval1.php">update request progress</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="sbids.php">Bids</a>
  </li>
  <li class="nav-item">
    <a class="nav-link " href="logout.php" >logout</a>
  </li>
</ul>
<table  class="table" border="1">
  <tr>
    <td scope="col">ID</td>
    <td scope="col">Title</td>
    <td scope="col">Proposal Date</td>
    <td scope="col">Closing Date</td>
    <td scope="col">Proposal Posted By</td>
    <td scope="col">Stage</td>
    <td scope="col">Status</td>
  </tr>
<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "mp1";
$conn = new mysqli($servername, $username, $password, $dbname);
$sql = "SELECT * FROM proposal";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
   while($row = $result->fetch_assoc()) {
     if($row['stage']==1){
       $vvv="Waiting Purchase Section Approval";
     }
     if($row['stage']==2){
       $vvv="Waiting Finance Section Approval";
     }
     if($row['stage']==3){
       $vvv="Waiting Approval by Director";
     }
     if($row['stage']==21){
       $vvv="Declined by Purchase Section";
     }
     if($row['stage']==22){
       $vvv="Declined dy Finnce Section";
     }
     if($row['stage']==23){
       $vvv="Declined by Director";
     }
     if($row['stage']==4){
       $vvv="Tender Posted for Bidding";
     }

     echo "<tr><td>";
     echo $row['id'];
     echo "</td><td>";
     echo $row['title'];
     echo "</td><td>";
     echo $row['pdate'];
     echo "</td><td>";
     echo $row['cdate'];
     echo "</td><td>";
     echo $row['proby'];
     echo "</td><td>";
     echo $vvv;
     echo "</td><td>";
     echo $row['pog'];
     echo "</td><td>";
     ?>
     <a href="download.php?id=<?php echo $row['id'] ?>">Download</a>
     <?php
     echo "</td></tr>";
   }
}
 ?>
</table>
  </body>
</html>
