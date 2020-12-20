<?php
$user=$_GET['a']; // it save the regdate which is passed when delete button is clicked
define('server','localhost:3307');// defining hostname
define('username','root'); // defining username
define('password' ,''); // defining Password
define('databasename', 'Eclec');// defining database name
$connection = mysqli_connect(server,username,password,databasename);
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}


$sql = "DELETE FROM equipment WHERE RegDate = '$user'";//the sql command uses to delete row from expenses where the regdate matches

if (mysqli_query($connection, $sql)) {
    mysqli_close($connection);// it close the connection and move to the expense page
    header('Location: usage.php');
    exit;
} else {
    echo "Error deleting record";
}
?>
