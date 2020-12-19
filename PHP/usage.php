<?php
 session_start();
include_once('pdo1.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/add.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../CSS/expense_report.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../CSS/usage.css?v=<?php echo time(); ?>">
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
        <button  class="panel__item first__item"><i class="fa fa-save  adjust__size"></i> <a href="add_receipt.php">Save Bills</a></h1></button>
        <button  class="panel__item first__item"><i class="fa fa-angle-double-up adjust__size"></i> <a href="Update.php">Update Profile</a></h1></button>
        <button  class="panel__item first__item"><i class="fa fa-angle-double-up adjust__size"></i><a>Enter Equipments</a></button>
        <button  class="panel__item first__item"><i class="fa fa-angle-double-up adjust__size"></i><a>See Usage</a></button>
        <button  class="panel__item first__item"><i class="fa fa-angle-double-up adjust__size"></i><a>Score & deviation</a></button>
        <button  class="panel__item first__item"><i class="fa fa-angle-double-up adjust__size"></i><a>Ranking</a></button>
        </div>
        <div class ="usage__area">
           <h1 class="input__head">Equipment usage information</h1>
           <div class="card__area">
        <?php
            $username = $_SESSION['name'];
            $dataviewing=new Database_Connection();
              $sql = $dataviewing->viewing($username);
              $count = 1;
              while ($row=mysqli_fetch_array($sql)) {  
                  ?>
           
           <div class="card__holder">
           <h1 class="equip__name"><?php  echo $row['equipment'];?></h1>
           <table class="expense__report__table">
            <thead>
            <tr>
              <th>S.No. </th>
              <th>Min usage(hrs)</th>
              <th>Max usage(hrs)</th>
              <th>watt consumption(W)</th>
              <th> ....</th>
              <th> ....</th>
            </tr>
            
            <tr>
            <td><?php echo $count ;?></td>
            <td><?php  echo $row['min_hrs'];?></td>
            <td><?php  echo $row['max_hrs'];?></td>
            <td><?php  echo $row['watt_consumption'];?></td>
            <td><?php echo "<a href='delete.php?a=".$row['RegDate']."'>Delete</a>"; ?></td>
            <td><?php echo "<a href='Update_info.php?a=".$row['RegDate']."'>Update</a>"; ?></td>
            </tr>
            </thead>
            </table>
           </div>
<?php
$count = $count+1;
                     }?>
</div>
</div>
    </section>
    <script src="../Script/add_expense.js?v=<?php echo time(); ?>"></script>
</body>
</html>
