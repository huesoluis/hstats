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

print_r($_POST);
$codcentro=$_POST['codcentro'];
$enseñanza=$_POST['fdata'][0];
$curso=$_POST['fdata'][1];
$modalidad=$_POST['fdata'][2];
$nalumnos=$_POST['numalumnos'][0];
$sql = "SELECT* FROm registroidiomas VALUES ('$codcentro','$enseñanza','$curso','$modalidad','$nalumnos')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?> 
