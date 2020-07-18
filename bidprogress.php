<?php
session_start();
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <title></title>
  </head>
  <body>
    <ul class="nav nav-pills nav-fill">
  <li class="nav-item">
    <a class="nav-link " href="tender2.php">welcome Bidder</a>
  </li>
  <li class="nav-item">
    <a class="nav-link " href="placebid.php">Place a Bid</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="bidprogress.php">Check your Bid Progress</a>
  </li>
  <li class="nav-item">
    <a class="nav-link " href="logout.php" >logout</a>
  </li>
</ul>
<h1>If Bid is Approved you will be Contacted</h1>
<h2>Thanks for Bidding!</h2>
<h3>Your Bids</h3>

<table class="table" border="1">
  <tr>
    <td>Bid ID</td>
    <td>Tender ID</td>
    <td>Description</td>
    <td>Status</td>
    <td>Bid Document</td>

  </tr>
<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "mp1";
$aaa=$_SESSION["u2"];
$conn = new mysqli($servername, $username, $password, $dbname);
$sql = "select * from bids where proby='$aaa'";
$result = $conn->query($sql);
if($result->num_rows>0){
  while($row=$result->fetch_assoc()){
    echo "<tr><td>";
    echo $row['bid'];
    echo "</td><td>";
    echo $row['tid'];
    echo "</td><td>";
    echo $row['title'];
    echo "</td><td>";
    echo $row['pog'];
    echo "</td><td>";
    ?>
    <a href="downloadbid.php?id=<?php echo $row['bid'] ?>">Download</a>
    <?php
    echo "</td></tr>";
  }
}
?>
</table>

</body>
</html>
