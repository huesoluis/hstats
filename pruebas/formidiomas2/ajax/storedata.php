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
$analumnos=$_POST['numalumnos'];
$nra=0;
$cont=0;
$nri=0;
$nr=sizeof($_POST['fdata'])/2;
while($nra<=$nr)
{
	$nalumnos=$analumnos[$nra];
	$enseñanza=$_POST['fdata'][$cont];
	$cont++;
	$curso=$_POST['fdata'][$cont];
	$cont++;
	$modalidad=$_POST['fdata'][$cont];
	$cont++;
	$sql = "INSERT INTO registroidiomas VALUES ('$codcentro','$enseñanza','$curso','$modalidad','$nalumnos')";

	if ($conn->query($sql) === TRUE) {
		echo "OK";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	$nra++;

}
$conn->close();
?> 
