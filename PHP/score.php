<?php
// Include the database configuration file
 session_start();
include_once('pdo1.php');// it consider the pdo1.php in this code also
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/add.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../CSS/receipts.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../CSS/score.css?v=<?php echo time(); ?> ">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <title>NHDD | Add Receipte </title>
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
        <button class="panel__item first__item"><i class="fa fa-angle-double-up adjust__size"></i> <a href="Update.php">Update Profile</a></h1></button>
        <button  class="panel__item first__item"><i class="fa fa-angle-double-up adjust__size"></i><a href="enter_equipments.php">Enter Equipments</a></button>
        <button  class="panel__item first__item"><i class="fa fa-angle-double-up adjust__size"></i><a href="usage.php">See Usage</a></button>
        <button  class="panel__item first__item"><i class="fa fa-angle-double-up adjust__size"></i><a href="score.php">Score & deviation</a></button>
        <button  class="panel__item first__item"><i class="fa fa-angle-double-up adjust__size"></i><a href="ranking.php">Ranking</a></button>
        </div>
        <div class="get__score">
        <h1 class="score__head">Enter your current month electricity bill to generate score </h1>
        <input class="score__input" type="data" name="bill_date" placeholder="Enter date of bill">
        <input class="score__input" type="number" name="bill_amount" placeholder="Enter bill amount">
        <button class="gen__btn"type="submit">Generate Score</button>
        <h1 class="gen__score">Score generated</h1>
        </div>
    </section>
    <script src="../Script/add_expense.js?v=<?php echo time(); ?>"></script>
</body>
</html>
