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

      $aaa=$_SESSION["u"];
      echo "Done";
      $des=$_POST['ddes'];
      $cd=$_POST['closing'];
      $sd=$_POST['starting'];
      $file = $_FILES['pdd'];
      $fileSize = $_FILES['pdd']['size'];
      $file_name =$_FILES['pdd']['name'];
      $file_type =$_FILES['pdd']['type'];
      $file_path = $_FILES['pdd']['tmp_name'];
      $data = file_get_contents($_FILES['pdd']['tmp_name']);
      //move_uploaded_file ($file_path,'images/'.$file_name);
      //$sql = "insert into proposal(dpdf) values('$data');";
      //$result = $conn->query($sql);
      $stmt= $conn->prepare("insert into proposal(stage,dpdf) values ('100',?)");
      $stmt->bindParam(1,$data);
      //$stmt->bindParam(2,$des);
      //$stmt->bindParam(3,$cd);
      //$stmt->bindParam(4,$_SESSION["u"]);
      $stmt->execute();
      $stmt= $conn->prepare("update proposal set cdate='$cd' where stage=100");
      $stmt->execute();
      $stmt= $conn->prepare("update proposal set title='$des' where stage=100");
      $stmt->execute();
      $stmt= $conn->prepare("update proposal set pdate='$sd' where stage=100");
      $stmt->execute();
      $stmt= $conn->prepare("update proposal set proby='$aaa' where stage=100");
      $stmt->execute();
      $stmt= $conn->prepare("update proposal set fname='$file_name' where stage=100");
      $stmt->execute();
      $stmt= $conn->prepare("update proposal set fsize='$fileSize' where stage=100");
      $stmt->execute();
      $stmt= $conn->prepare("update proposal set ftype='$file_type' where stage=100");
      $stmt->execute();
      $stmt= $conn->prepare("update proposal set stage=1 where stage=100");
      $stmt->execute();
    }

     ?>
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
    <form method="post" enctype="multipart/form-data">
      <label for="des">Description of product:</label>
      <br>
      <input id="ddes" type="text" name="ddes">
      <br>
      <label for="inpdf">Upload your Document:</label>
      <br>
       <input id="inpdf" type="file" name="pdd" accept="file_extension" >
       <br>
       <label for="sdate">Enter starting date:</label>
       <br>
       <input id="starting" type="date" name="starting" >
       <br>
      <label for="cdate">Enter closing date:</label>
      <br>
      <input id="closing" type="date" name="closing" >
      <br>
      <input type="submit" class="btn btn-primary" name="subuse" >
    </form>

  </body>
</html>
