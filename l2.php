<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "mp1";
$id = $_POST['users_email'];
$pass = $_POST['users_pass'];
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT uname, pass, id FROM login2 where uname='$id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
   // output data of each row
   while($row = $result->fetch_assoc()) {
       if($id==$row["uname"] && $pass==$row["pass"]){
         session_start();
         $_SESSION["u2"] = $row["uname"];
         header("location: tender2.php");
       }
       else{
         echo "invalid Wrong password";
         echo "<a href='first.html'>GO BACK</a>";
       }
   }
} else {
   echo "invalid user";
   echo "<a href='first.html'>GO BACK</a>";
}
$conn->close();
?>
