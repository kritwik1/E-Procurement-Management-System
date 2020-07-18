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

$sql = "SELECT id, pass, priv FROM login where id='$id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
   // output data of each row
   while($row = $result->fetch_assoc()) {

       if($id==$row["id"] && $pass==$row["pass"]){
         session_start();
         $_SESSION["p"] = $row["priv"];
         $_SESSION["u"] = $row["id"];
         header("location: tender1.php");
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
