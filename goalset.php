<?php 

session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "testWestwind";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$goaltoday = mysqli_real_escape_string($conn, $_POST['goal']);
$timestamp = date('Y-m-d');
$sql = "INSERT INTO `testwestwind`.`test` (`DailyGoal`) VALUES ('$goaltoday' );";
$result=$conn->query($sql);
header('Refresh: 1; URL=index.php');

?>