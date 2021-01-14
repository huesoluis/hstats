 <?php
$servername = "localhost";
$username = "root";
$password = "Suricato1.fp";
$dbname = "CATARA";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

//print_r($_POST);exit();
$codcentro=$_POST['codcentro'];
$clave=$_POST['clave'];
$sql = "SELECT * FROM centros WHERE codcentro='$codcentro' and clave='$clave'";

$res=$conn->query($sql);
if($res->num_rows>0)
	echo "OK";
else
		echo "Error: " . $sql . "<br>" . $conn->error;

$conn->close();
?> 
