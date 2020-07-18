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
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "mp1";
    //$conn = new mysqli($servername, $username, $password, $dbname);
    //if ($conn->connect_error) {
    //   die("Connection failed: " . $conn->connect_error);
    //}
    $conn=new PDO("mysql:host=localhost;dbname=mp1","root","root");
    if(isset($_POST['subuse'])){

      $aaa=$_SESSION["u2"];
      echo "DONE";
      $tid=$_POST['ddes'];
      $cn=$_POST['cos'];
      $dp=$_POST['dp'];

      $file = $_FILES['pdd'];
      $fileSize = $_FILES['pdd']['size'];
      $file_name =$_FILES['pdd']['name'];
      $file_type =$_FILES['pdd']['type'];
      $file_path = $_FILES['pdd']['tmp_name'];
      $data = file_get_contents($_FILES['pdd']['tmp_name']);
      //move_uploaded_file ($file_path,'images/'.$file_name);
      //$sql = "insert into proposal(dpdf) values('$data');";
      //$result = $conn->query($sql);
      $stmt= $conn->prepare("insert into bids(stage,dpdf) values ('101',?)");
      $stmt->bindParam(1,$data);
      //$stmt->bindParam(2,$des);
      //$stmt->bindParam(3,$cd);
      //$stmt->bindParam(4,$_SESSION["u"]);
      $stmt->execute();
      $stmt= $conn->prepare("update bids set tid='$tid' where stage=101");
      $stmt->execute();
      $stmt= $conn->prepare("update bids set proby='$aaa' where stage=101");
      $stmt->execute();
      $stmt= $conn->prepare("update bids set fname='$file_name' where stage=101");
      $stmt->execute();
      $stmt= $conn->prepare("update bids set fsize='$fileSize' where stage=101");
      $stmt->execute();
      $stmt= $conn->prepare("update bids set title='$dp' where stage=101");
      $stmt->execute();
      $stmt= $conn->prepare("update bids set ftype='$file_type' where stage=101");
      $stmt->execute();
      $stmt= $conn->prepare("update bids set cname='$cn' where stage=101");
      $stmt->execute();
      $stmt= $conn->prepare("update bids set stage=45 where stage=101");
      $stmt->execute();
    }

     ?>

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
    <form method="post" enctype="multipart/form-data">
      <label for="des">Tender ID:</label>
      <br>
      <input id="ddes" type="text" name="ddes">
      <br>
      <label for="des">Decription of Product:</label>
      <br>
      <input id="dp" type="text" name="dp">
      <br>
      <label for="inpdf">Upload your Document:</label>
      <br>
      <input id="inpdf" type="file" name="pdd" accept="file_extension" >
      <br>
      <label for="des">Company Name:</label>
      <br>
      <input id="cos" type="text" name="cos">
      <br>

      <input type="submit" class="btn btn-info" name="subuse" >
    </form>

  </body>
</html>
