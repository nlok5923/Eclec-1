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
     <link rel="stylesheet" href="../CSS/ranking.css?v=<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
    <script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
        <button class="panel__item first__item"><i class="fa fa-angle-double-up adjust__size"></i> <a href="Update.php">Update Profile</a></h1></button>
        <button  class="panel__item first__item"><i class="fa fa-angle-double-up adjust__size"></i><a>Enter Equipments</a></button>
        <button  class="panel__item first__item"><i class="fa fa-angle-double-up adjust__size"></i><a>See Usage</a></button>
        <button  class="panel__item first__item"><i class="fa fa-angle-double-up adjust__size"></i><a>Score & deviation</a></button>
        <button  class="panel__item first__item"><i class="fa fa-angle-double-up adjust__size"></i><a>Ranking</a></button>
        </div>
    <div class="ranking">
    <div class="bar__chart__container">
            <canvas id="myChart"></canvas>
    </div>
    <div class="rank__holder">
        <div class="rank__card">
         <h1 class="rank">#1</h1>
         <h1 class="usrname">Username </h1>
        </div>
        <div class="rank__card">
        <h1 class="rank">#1</h1>
         <h1 class="usrname">Username </h1>
        </div>
        <div class="rank__card">
        <h1 class="rank">#1</h1>
         <h1 class="usrname">Username </h1>
        </div>
        <div class="rank__card">
        <h1 class="rank">#1</h1>
         <h1 class="usrname">Username </h1>
        </div>
        <div class="rank__card">
        <h1 class="rank">#1</h1>
         <h1 class="usrname">Username </h1>
        </div>
        <div class="rank__card">
        <h1 class="rank">#1</h1>
         <h1 class="usrname">Username </h1>
        </div>
        <div class="rank__card">
        <h1 class="rank">#1</h1>
         <h1 class="usrname">Username </h1>
        </div>
        <div class="rank__card">
        <h1 class="rank">#1</h1>
         <h1 class="usrname">Username </h1>
        </div>
        <div class="rank__card">
        <h1 class="rank">#1</h1>
         <h1 class="usrname">Username </h1>
        </div>
        <div class="rank__card">
        <h1 class="rank">#1</h1>
         <h1 class="usrname">Username </h1>
        </div>
        <div class="rank__card">
        <h1 class="rank">#1</h1>
         <h1 class="usrname">Username </h1>
        </div>
        <div class="rank__card">
        <h1 class="rank">#1</h1>
         <h1 class="usrname">Username </h1>
        </div>
        <div class="rank__card">
        <h1 class="rank">#1</h1>
         <h1 class="usrname">Username </h1>
        </div>
        <div class="rank__card">
        <h1 class="rank">#1</h1>
         <h1 class="usrname">Username </h1>
        </div>
        <div class="rank__card">
        <h1 class="rank">#1</h1>
         <h1 class="usrname">Username </h1>
        </div>
        <div class="rank__card">
        <h1 class="rank">#1</h1>
         <h1 class="usrname">Username </h1>
        </div>
        <div class="rank__card">
        <h1 class="rank">#1</h1>
         <h1 class="usrname">Username </h1>
        </div>
        <div class="rank__card">
        <h1 class="rank">#1</h1>
         <h1 class="usrname">Username </h1>
        </div>
    </div>
    </section>
    <script>

  window.onload =  ()=>{
  function titleConfig(text, dis, size, color, font) {
  this.text = text;
  this.display = dis;
  this.fontSize = size;
  this.fontColor = color;
  this.fontFamily = font;
}
 //handling tick configuration for different charts
function tickConfig(stepSize, size, font, begin, color) {
  this.stepSize = stepSize;
  this.fontSize = size;
  this.beginAtZero = begin;
  this.fontFamily = font;
  this.fontColor = color;
}
let mychart = document.getElementById('myChart').getContext('2d');
// handling the configuration for display of data in different graphs
//parent function
function dataConfig(
  borderColor,
  borderWidth,
  hoverBorderWidth,
  hoverBorderColor,
  fill,
  fontColor,
  label
) {
  this.borderColor = borderColor;
  this.borderWidth = borderWidth;
  this.hoverBorderColor = hoverBorderColor;
  this.hoverBorderWidth = hoverBorderWidth;
  this.fill = fill;
  this.fontColor = fontColor;
  this.label = label;
}
//bar dataConfing inheriting dataConfing function for getting proper data configuration for displaying bar graph
//child function
function barDataConfig(
  borderColor,
  borderWidth,
  hoverBorderWidth,
  hoverBorderColor,
  fill,
  fontColor,
  label
) {
  //calling parent function
  dataConfig.call(
    this,
    borderColor,
    borderWidth,
    hoverBorderWidth,
    hoverBorderColor,
    fill,
    fontColor,
    label
  );
  //dummy array for now
  this.data = [10,20,30,40,50,60];
  this.backgroundColor = [
    '#01c5c4',
    '#01c5c4',
    '#01c5c4',
    '#01c5c4',
    '#01c5c4',
    '#01c5c4',
  ];
}
//pieDataConfing inheriting dataConfing function for getting proper data configuration for displaying pie chart
//child function


//setting configuration for different charts and graph by making there objects
let barData = new barDataConfig(
  'grey',
  1,
  3,
  'white',
  'none',
  'white',
  'Expenditure'
);
let barNew = [barData];
console.log(barNew);

try {
  //main object of function chart which is responsible for setting all configuration of bar graph and displaying it. it inculcates user of all
  //inherting functions showned above by making there objects
  let massPopChart = new Chart(mychart, {
    type: 'bar', //bar, pie, horizontal , line, donuts , radar, polararea
    data: {
      labels: [
        'Ashish',
        'Novarun',
        'Bhupi',
        'Amandeep',
        'DKS',
        'KKJ',
      ],
      datasets: barNew,
    },
    options: {
      title: new titleConfig(
        'Ranking to top 6',
        true,
        24,
        'white',
        'montserrat'
      ),
      legend: {
        display: false,
        position: 'bottom',
        labels: {
          fontColor: 'white',
        },
      },
      scales: {
        yAxes: [
          {
            gridLines: {
              color: '#FFFFFF',
            },
            ticks: new tickConfig(500, 14, 'montserrat', true, 'white'),
          },
        ],
        xAxes: [
          {
            gridLines: {
              color: '#FFFFFF',
            },
            ticks: new tickConfig(1, 14, 'montserrat', true, 'white'),
          },
        ],
      },
      layout: {
        width: 100,
        height: 100,
      },
      tooltips: {
        enabled: true,
      },
      responsive: true,
    },
  });
} catch (err) {
  console.log(`Wrong configuration detected ${err}`);
  alert(`Something wrong happended ${err}`);
}
  }

    </script>
    <script src="../Script/add_expense.js?v=<?php echo time(); ?>"></script>
</body>
</html>
