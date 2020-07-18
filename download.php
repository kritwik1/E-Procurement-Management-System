<?php
$conn=new PDO("mysql:host=localhost;dbname=mp1","root","root");
if(isset($_GET['id'])){
  $id = $_GET ['id'];
  /*$stat = $conn->prepare("select * from proposal where id=?");
  $stat->bindParam(1,$id);
  $stat->execute();
  $data = $stat->fetch();
*/
  //$file = 'images/'.$data['fname'];

  /*if(file_exists($file)){
    header('Content-Descruption: '.'File Transfer');
    header('Content-Type: '.$data['ftype']);
    header('Content-Desposition: '.'attachment');
    header('Expires: '.'0');
    header('Cache-Control: '.'');
    readfile($file);
    exit;
  }*/
  $servername = "localhost";
  $username = "root";
  $password = "root";
  $dbname = "mp1";

  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
  }

  $sql = "SELECT * FROM proposal where id='$id'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
      $size=$row["fsize"];
      $type=$row["ftype"];
      $name=$row["fname"];
      $data=$row["dpdf"];
    }
  }


  header("Content-type: $type");
  header("Content-length: $size");
  header("Content-Disposition: attachment; filename=$name");
  header("Content-Description: PHP Generated Data");
  echo $data;
}

 ?>
