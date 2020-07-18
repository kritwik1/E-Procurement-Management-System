<?php
session_start();

$aaa=$_SESSION["p"];
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
<form method="post">
  <label>Enter Tender ID</label>
  <input type="number" name="tid">
  <input type="submit" class="btn btn-primary" name="sb" value="OK">
</form>
<br>
<table  class="table"border="1">
  <tr>
    <td>Bid ID</td>
    <td>Tender ID</td>
    <td>Company Name</td>
    <td>Bidder ID</td>
    <td>Description</td>
    <td>Bid Document</td>
  </tr>
<?php
if(isset($_POST['sb'])){

  $servername = "localhost";
  $username = "root";
  $password = "root";
  $dbname = "mp1";
  $pid=$_POST['tid'];
  $conn = new mysqli($servername, $username, $password, $dbname);
  $sql = "select * from bids where tid=$pid";
  $result = $conn->query($sql);
  if($result->num_rows>0){
    while($row=$result->fetch_assoc()){
      echo "<tr><td>";
      echo $row['bid'];
      echo "</td><td>";
      echo $row['tid'];
      echo "</td><td>";
      echo $row['cname'];
      echo "</td><td>";
      echo $row['proby'];
      echo "</td><td>";
      echo $row['title'];
      echo "</td><td>";
      ?>
      <a href="downloadbid.php?id=<?php echo $row['bid'] ?>">Download</a>
      <?php
      echo "</td></tr>";
    }
  }
}
 ?>
</table>
<br>
<br>
<br>
<br>
<form method="post">
  <label>Bidder ID</label>
  <input type="email" name="bid">
  <input type="submit" class="btn btn-primary" name="sb2" value="OK">
</form>
<br>
<table  class="table" border="1">
  <tr>
    <td>Name</td>
    <td>Gender</td>
    <td>EMail</td>
    <td>Contact</td>
    <td>Address</td>
  </tr>
  <?php
  if(isset($_POST['sb2'])){

    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "mp1";
    $pid=$_POST['bid'];
    $conn = new mysqli($servername, $username, $password, $dbname);
    $sql = "select * from login2 where uname='$pid'";
    $result = $conn->query($sql);
    if($result->num_rows>0){
      while($row=$result->fetch_assoc()){
        echo "<tr><td>";
        echo $row['name'];
        echo "</td><td>";
        echo $row['gender'];
        echo "</td><td>";
        echo $row['uname'];
        echo "</td><td>";
        echo $row['contact'];
        echo "</td><td>";
        echo $row['address'];

        echo "</td></tr>";
      }
    }
  }
   ?>
</table>
<br><br><br>
   <form method="post">
     <label>Enter Bidder ID for PO Generation</label>
     <input type="number" name="po" placeholder="Bidder ID">
     <input type="number" name="ti" placeholder="Tender ID">
     <input type="submit" class="btn btn-primary" name="sb3" value="OK">
   </form>

<?php
if($aaa==2){
  if(isset($_POST['sb3'])){
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "mp1";
    $po=$_POST['po'];
    $ti=$_POST['ti'];
    $conn = new mysqli($servername, $username, $password, $dbname);
    $sql = "update proposal set pog='Tender Closed' where id=$ti";
    $result = $conn->query($sql);
    $sql = "update bids set pog='DENIED' where tid=$ti";
    $result = $conn->query($sql);
    $sql = "update bids set pog='GRANTED' where bid=$po";
    $result = $conn->query($sql);
    echo "PO has been generated";
  }
}
else{
  echo "You are not Authorised to generate PO";
}
 ?>
</body>
</html>
