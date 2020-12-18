<?php
session_start();
$user=$_GET['a'];
define('server','localhost');// defining hostname
define('username','root'); // defining username
define('password' ,''); // defining Password
define('databasename', 'Eclec');// defining database name
$connection = mysqli_connect(server,username,password,databasename);
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
if(isset($_POST['min_hrs']) && isset($_POST['max_hrs']) && isset($_POST['priority']) && isset($_POST['watt_consume']))
{
$min=$_POST['min_hrs'];
$max=$_POST['max_hrs'];
$priority=($_POST['priority']);
$consumption =($_POST['watt_consume']);
    $min = $_POST['min_hrs'];
    $sql = "UPDATE equipment SET min_hrs ='$min' , max_hrs='$max' , priority = '$priority' , watt_consumption ='$consumption' WHERE RegDate = '$user' ";
    if (mysqli_query($connection, $sql)) {
        mysqli_close($connection);// it close the connection and move to the expense page
        header('Location: usage.php');
        exit;
    }
    else {
        echo "Error Updating record";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/add.css?v=<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <title>Eclec | Enter equipment </title>
    <header>
        <div class="logo__name">
        <img class="nhdd_logo" src="../Images/NHDD_logo.png" alt="NHDD logo">
            <button class="message"><a href="dashboard.php"><i style="font-size:34px;color:white" class="fa">&#xf0a8;</i></a></button>
            <button class="message"><a href="index.php"> <i class="fa fa-home" style="font-size:34px;color:white"></i></a></button>
    </header>
</head>
<body>
    <section id="add__expense">
    <div class = "user__panel">
        <img class="user__img" src ="../Images/bg.jpg" alt="bg image">
        <h1 class="user__name"><?php echo $_SESSION['name'] ?></h1>
        <hr>
        <button  class="panel__item first__item"><i class="fa fa-save  adjust__size"></i> <a href="add_receipt.php">Save Bills</a></h1></button>
        <button class="panel__item first__item"><i class="fa fa-angle-double-up adjust__size"></i> <a href="Update.php">Update Profile</a></h1></button>
        <button  class="panel__item first__item"><i class="fa fa-angle-double-up adjust__size"></i><a>Enter Equipments</a></button>
        <button  class="panel__item first__item"><i class="fa fa-angle-double-up adjust__size"></i><a>See Usage</a></button>
        <button  class="panel__item first__item"><i class="fa fa-angle-double-up adjust__size"></i><a>Score & deviation</a></button>
        <button  class="panel__item first__item"><i class="fa fa-angle-double-up adjust__size"></i><a>Ranking</a></button>
        </div>
        <div class="user__inputarea">
        <form method="POST">
        <input type="text" name="equipment_name" placeholder="Enter equipment name ">
        <input type="number" name="min_hrs" placeholder="Enter min hours of usage" >
        <input type="number" name="max_hrs" placeholder="Enter max hours of usage">
        <input type="number" name="priority" placeholder="Enter priority of it's usage">
        <input type="number" name="watt_consume" placeholder="Enter the watt it consumes">
        <button type="submit" class="add__btn" >Add Equipment </button>
        <form>
        </div>
    </section>
    <script src="../Script/add_expense.js?v=<?php echo time(); ?>"></script>
</body>
</html>

