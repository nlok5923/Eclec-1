<?php
include('pdo1.php');
session_start();
$dataviewing=new Database_Connection();
$equipments = array(
  array(0,0,0,0,0,0),
    array(0,0,0,0,0,0),
  array(0,0,0,0,0,0),
    array(0,0,0,0,0,0),
  array(0,0,0,0,0,0),
    array(0,0,0,0,0,0),
  array(0,0,0,0,0,0),
    array(0,0,0,0,0,0),
  array(0,0,0,0,0,0),
    array(0,0,0,0,0,0),
  array(0,0,0,0,0,0),
    array(0,0,0,0,0,0)
  );
$username = $_SESSION['name'];
$sql = $dataviewing->viewing($username);
$j=0;
$k =$sql->num_rows;
while ($row=mysqli_fetch_array($sql)) {
  ?>
  <?php $equipments[$j][0] = $row['equipment']; ?>
  <?php  $equipments[$j][1] =  $row['min_hrs'];?>
  <?php  $equipments[$j][2] = $row['max_hrs'];?>
  <?php $equipments[$j][3] = $row['priority'];?>
  <?php  $equipments[$j][4] = $row['watt_consumption'];?>
<?php  $equipments[$j][5] = $row['number'];?>
  <?php
  $j = $j+1;
}
?>

<?php
class Menu{
  public $min_Hour;
  public $max_Hour;
  public $priority;
  public $name;
  public $wattperhour;
  public $multiplicity;
  public $min_range;
  public $max_range;
  function __construct($min_Hour, $max_Hour,$priority,$name,$wattperhour,$multiplicity){
      $this->min_Hour = $min_Hour;
      $this->max_Hour = $max_Hour;
      $this->priority = $priority;
      $this->name = $name;
      $this->wattperhour = $wattperhour;
      $this->multiplicity = $multiplicity;
      $this->min_range = $min_Hour;
      $this->max_range = $min_Hour;
  }
}


$items = array();
for($i=0;$i<$k;$i++) {
array_push($items,new Menu($equipments[$i][1],$equipments[$i][2],$equipments[$i][3],$equipments[$i][0],$equipments[$i][4],$equipments[$i][5]));
// echo $items[$i]->min_Hour;
}
function BillAmount($electricity){
  //currently the webiste is according to bihar tariff
  $state = "Bihar";
  $json = file_get_contents('https://nlok5923.github.io/RawQuotesData/tariff.json');
  $data = json_decode($json);
  //echo $data[0]->slab_low[3 ];
  $in = 0;
  while($data[$in]->state != $state) {
    $slab_length = sizeof($data[$in]->slab_low);
    $in++;
  }
  $in--;
  $rate  =0 ;
  for($i=0;$i<$slab_length;$i++) {
    if($data[$in]->slab_low[$i] < $electricity && $electricity < $data[$in]->slab_high[$i]){
      $rate = $data[$in]->rate[$i];
      break;
    }
  }
  $electricity = $electricity*30;
  $electricity =$electricity/1000;
   return ($rate*$electricity-45);
}

function Calculate($k,$items)
{
    // dummy data
  //    var itemss = [new Menu(10,14,10,"TV",20,1),new Menu(3,7,7,"Ac",200,2),new Menu(5,9,4,"Freeze",100,1)];


    $Expected_Avg_Bill = 200;
    $min_watt_per_day=0;
    $max_watt_per_day=0;

    for($i=0;$i<$k;$i++)
    {
        // watt used in one day = watt used by particular equipment in one hour multiply by total
        // number of same kind of equipments multiply by total hours that equipment use in one day
        $min_watt_per_day +=($items[$i]->wattperhour)*($items[$i]->multiplicity)*($items[$i]->min_Hour);
        $max_watt_per_day +=($items[$i]->wattperhour)*($items[$i]->multiplicity)*($items[$i]->max_Hour);
    }

    $min_bill = BillAmount($min_watt_per_day);

    //this condition will check if all equipment run minimum hour but total bill will exceeded
    // the expected amount
    if($min_bill>=$Expected_Avg_Bill){
        // for($i=0;i<$k;$i++)
        // {
        //     // console.log(items[i].min_range+" "+items[i].max_range);
        //     echo $items[$i]->min_range ;
        //     echo $items[$i]->max_range;
        // }
    }

    //max_bill is amount of bill when all equipment run max hour in a day.
    $max_bill = BillAmount($max_watt_per_day);

    //this condition will check if all equipment run maximum hour but total bill will still less
    // than the expected amount
    if($max_bill<=$Expected_Avg_Bill){
        for($i=0;$i<$k;$i++)
        {
            $items[$i]->max_range = $items[$i]->max_Hour;
        }
        // for($i=0;$i<$k;$i++)
        // {
        //     // console.log(items[i].min_range+" "+items[i].max_range);
        //     echo $items[$i]->min_range ;
        //     echo $items[$i]->max_range;
        // }
    }

    //fn for sorting items
    function compare($a,$b){
        return $b->priority - $a->priority;
    }

    usort($items,"compare");

    // watt_per_day variable will keep the value of watt used in one day
    $watt_per_day = $min_watt_per_day;
    $flag = true;

    while($flag)
    {
        $pre = $watt_per_day;
        for($i=0;$i<$k;$i++)
        {
            if(BillAmount($watt_per_day)>=$Expected_Avg_Bill){
                break;
            }
            //tem1 is time in hour which we extra include for a day.
            $tem1 = ($items[$i]->max_Hour-$items[$i]->max_range)/2;
            //tem2 is watt in a day which will increase because of increasing in time.
            $tem2 = $tem1*$items[$i]->multiplicity*$items[$i]->wattperhour;
            while(BillAmount($watt_per_day+$tem2)>$Expected_Avg_Bill){
                $tem1 = $tem1/2;
                $tem2 = $tem2/2;
            }
            $watt_per_day+=$tem2;
            $items[$i]->max_range+=$tem1;
        }
        if($pre==$watt_per_day){
            $flag = false;
        }
    }
}

Calculate($k,$items);

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
        <button class="panel__item first__item"><i class="fa fa-angle-double-up adjust__size"></i> <a href="Update.php">Set Bill</a></h1></button>
        <button  class="panel__item first__item"><i class="fa fa-angle-double-up adjust__size"></i><a href="enter_equipments.php">Enter Equipments</a></button>
        <button  class="panel__item first__item"><i class="fa fa-angle-double-up adjust__size"></i><a href="usage.php">See Usage</a></button>
        <button  class="panel__item first__item"><i class="fa fa-angle-double-up adjust__size"></i><a href="score.php">Score & deviation</a></button>
        <button  class="panel__item first__item"><i class="fa fa-angle-double-up adjust__size"></i><a href="ranking.php">Ranking</a></button>
        </div>
        <div class ="usage__area">
           <h1 class="input__head">Equipment usage information</h1>
           <div class="card__area">
        <?php
            $username = $_SESSION['name'];
            $dataviewing=new Database_Connection();
              $sql = $dataviewing->viewing($username);
              $count = 0;
              $json_str = file_get_contents('https://nlok5923.github.io/RawQuotesData/cloud_data.json');
              $data_new = json_decode($json_str);
              while ($row=mysqli_fetch_array($sql)) {
                  ?>

           <div class="card__holder">
           <h1 class="equip__name"><?php  echo $items[$count]->name?></h1>
           <table class="expense__report__table">
            <thead>
            <tr>
              <th>S.No. </th>
              <th>Min usage(hrs)</th>
              <th>Max usage(hrs)</th>
              <th>Status</th>
              <th> ....</th>
              <th> ....</th>
            </tr>

            <tr>
            <td><?php echo $count ;?></td>
            <td><?php echo $items[$count]->min_range ?></td>
            <td><?php echo $items[$count]->max_range ?></td>
            <?php
            $flag = true;
            for($i =0 ;$i<sizeof($data_new);$i++) {
              if(!strcasecmp($data_new[$i]->name,$items[$count]->name)) {
                echo "<td>".$data_new[$i]->status."</td>";
                $flag = false;
              }
            }
            if($flag)
            {
              echo "<td>under limit</td>";
            }
            ?>
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
