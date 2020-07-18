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
<table class="table" border="1">
  <tr>
    <td>ID</td>
    <td>Title</td>
    <td>Proposal Date</td>
    <td>Closing Date</td>
    <td>Proposal Posted By</td>
    <td>Doc</td>
  </tr>
<?php
if($_SESSION["p"]==1){
  $ss=3;
}
if($_SESSION["p"]==2){
  $ss=1;
}
if($_SESSION["p"]==3){
  $ss=2;
}
if($_SESSION["p"]==4){
  $ss=121;
}
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "mp1";
$conn = new mysqli($servername, $username, $password, $dbname);
$sql = "SELECT * FROM proposal where stage=$ss;";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
   while($row = $result->fetch_assoc()) {
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
     echo $row['cdate'];
     echo "</td><td>";
     ?>
     <a href="download.php?id=<?php echo $row['id'] ?>">Download</a>
     <?php
     //echo "</td><td>";
     //echo $row['dpdf'];
     echo "</td></tr>";
   }
}
 ?>
</table>
<br>
<form method="post" >
  <input type="number" name="ii" id="ii">
  <input  class="btn btn-primary" type="submit" name="Approve" value="Approve"/>

</form>
<?php
if(isset($_POST['Approve'])){
  $conn=new PDO("mysql:host=localhost;dbname=mp1","root","root");
  $iii=$_POST['ii'];
  if($_SESSION["p"]==4){
    echo "You donnt have permission to give the approval";
  }
  else{
    if($_SESSION["p"]==1){
      $as=4;
    }
    else{
      if($_SESSION["p"]==2){
        $as=2;
      }
      else{
        if($_SESSION["p"]=3){
          $as=3;
        }
      }
    }
    $stmt= $conn->prepare("update proposal set stage='$as' where id=$iii");
    $stmt->execute();
    header("location: approval1.php");
  }

}
 ?>

 <br>
 <form method="post" >
   <input type="number" name="dd" id="dd">
   <input  class="btn btn-primary" type="submit" name="Decline" value="Decline"/>

 </form>
 <?php
 if(isset($_POST['Decline'])){
   $conn=new PDO("mysql:host=localhost;dbname=mp1","root","root");
   $iii=$_POST['dd'];
   if($_SESSION["p"]==4){
     echo "You donnt have permission to decline";
   }
   else{
     if($_SESSION["p"]==1){
       $as=23;
     }
     else{
       if($_SESSION["p"]==2){
         $as=21;
       }
       else{
         if($_SESSION["p"]=3){
           $as=22;
         }
       }
     }
     $stmt= $conn->prepare("update proposal set stage='$as' where id=$iii");
     $stmt->execute();
     header("location: approval1.php");
   }

 }
  ?>
  </body>
</html>
