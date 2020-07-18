<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "mp1";
$name = $_POST['name'];
$gender = $_POST['gender'];
$uname = $_POST['uname'];
$pass = $_POST['pass'];
$address = $_POST['address'];
$contact = $_POST['contact'];
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}

$sql = "insert into login2(name,gender,uname,pass,address,contact) values('$name','$gender','$uname','$pass','$address','$contact');";
$result = $conn->query($sql);
if($result){
  echo "User created";
  echo "<br>";
  echo "<a href='login2.html'>GO TO LOGIN</a>";
  echo "<br>";
  echo "<a href='first.html'>GO BACK</a>";
}
else{
  echo "Error: Userid already taken or form incorrectly filled";
  echo "<br>";
  echo "<a href='first.html'>GO BACK</a>";
}

$conn->close();
?>
