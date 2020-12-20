<?php
include('pdo1.php');
session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/report.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
    <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
    <script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>NHDD | Dashboard </title>
    <header>
        <div class="logo__name">
            <img class="nhdd_logo" src="../Images/NHDD_logo.png" alt="NHDD logo">
            <button class="message" id="fetch__btn"><i class="material-icons" style="font-size:40px;color:white;"><span class="dot" id="dot__dis">&#8226;</span>email</i></button>
            <button class="message_1" onclick="alertHandler()" id="alert__btn"> <i class="material-icons" style="font-size:35px;color:white"><span class="dot_bell" id="dot__bell">&#8226;</span>add_alert</i></button>
            <button class="message"><a href="index.php"> <i class="fa fa-home" style="font-size:34px;color:white"></i></a>
            <button class="message"><a href="dashboard.php"><i style="font-size:34px;color:white" class="fa">&#xf0a8;</i></a></button>
        </div>
        <div id="quote__box">
            <h1 id="quote" ></h1>
            <h1 id="author"></h1>
        </div>
        <div id="alert__box">
            <h1 id="alert_msg"></h1>
            <h1 id="dev_detail"></h1>
        </div>
        <div id="alt__box">
            <h1 id="alt__msg">Check alert at the end of the month</h1>
            <h1 id="greet">Have a Nice day</h1>
        </div>
    </header>
</head>
<body>

    <section id="add__expense">
        <ul id="list"></ul>
        <div class = "user__panel">
        <img class="user__img" src ="../Images/bg.jpg" alt="bg image">
        <h1 class="user__name"><?php echo $_SESSION['name'] ?></h1>
        <hr>
        <button  class="panel__item first__item"><i class="fa fa-save  adjust__size"></i> <a href="add_receipt.php">Save Bills</a></h1></button>
        <button class="panel__item first__item"><i class="fa fa-angle-double-up adjust__size"></i> <a href="Update.php">Set Bill</a></h1></button>
        <button  class="panel__item first__item"><i class="fa fa-angle-double-up adjust__size"></i><a href="enter_equipments.php">Enter Equipments</a></button>
        <button  class="panel__item first__item"><i class="fa fa-angle-double-up adjust__size"></i><a href="usage.php">See Usage</a></button>
        <button  class="panel__item first__item"><i class="fa fa-angle-double-up adjust__size"></i><a href="score.php">Score & deviation</a></button>
        <button  class="panel__item first__item"><i class="fa fa-angle-double-up adjust__size"></i><a href="ranking.php">Ranking</a></button>
        </div>
        <div class="user__inputarea">
        <h1 class="ultra-head"> &#128519; Welcome to Eclec <br />Dashboard</h1>
        </div>
    </section>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script type="text/javascript" charset="utf-8">

let fetch_btn = document.getElementById('fetch__btn');
fetch_btn.addEventListener('click', clickHandler);

var quoteArray = [];
var author = [];
//handles click on quotes button
function clickHandler() {
  console.log("hey")
  let query_sign = document.getElementById('dot__dis');
  query_sign.style.display = 'none';
  let quote_box = document.getElementById('quote__box');
  var check = document.getElementById('quote__box').classList.toggle('dis');
  if (check) {
    quote_box.style.display = 'block';
  } else {
    quote_box.style.display = 'none';
  }
  //xml request get quotes hosted on github report "RawQuotesData" and display it in random manner
  var xhr = new XMLHttpRequest();
  let obj1 =  xhr.open('GET', 'https://nlok5923.github.io/RawQuotesData/quotes.json', true);
  xhr.onload = function () {
    console.log(this.state);
    console.log(JSON.parse(this.responseText));
    object = JSON.parse(this.responseText);
    let randomNo = Math.floor(Math.random() * 26);
    object.map((data) => quoteArray.push(data.text));
    object.map((data) => author.push(data.author));
    let quote = document.getElementById('quote');
    quote.innerHTML = quoteArray[randomNo];
    let authorName = document.getElementById('author');
    authorName.innerHTML = author[randomNo];
  };
  xhr.send();
}
var deviation = 0;
//alert message class which handles the display of alert message based of current day date
 class alertMessage{
   //constructor which initilizes object with last date of current month
   constructor(month){
     this.month =  month;
     if (
    month === 1 ||
    month === 3 ||
    month === 5 ||
    month === 7 ||
    month === 8 ||
    month === 10 ||
    month === 12
   ){
     this.date = 31;
   }
   else if(month ===2){
     this.date = 28;
   }
    else{
     this.date = 30;
   }
  }
  //method to check if date passed is the last date of month or not
   checker(date){
     if(this.date ===date){
       return true;
     }else
     return false;
   }
   //method to show deviation of currentmonth expenditure it always called after checker() method returns true to the call
   showMessage(deviation){
    // console.log(deviation)
    // deviation = deviation.toPrecision(5);
    //   let alert_msg = document.getElementById('alert_msg');
    //   let dev__detail = document.getElementById('dev_detail');
    //   if (deviation < 10) {
    //     alert_msg.innerHTML = 'You are doing well';
    //     dev__detail.innerHTML = `Deviation of almost ${deviation}% from average`;
    //   }
    //   if (deviation > 12 && deviation < 20) {
    //     alert_msg.innerHTML = 'There is some need to worry';
    //     dev__detail.innerHTML = `Deviation of almost ${deviation}% from average`;
    //   }
    //   if (deviation > 25 && deviation < 35) {
    //     alert_msg.innerHTML = 'There is serious need for attention';
    //     dev__detail.innerHTML = `Deviation of almost ${deviation}% from average`;
    //   }
      let alert_box = document.getElementById('alert__box');
      let check = document.getElementById('alert__box').classList.toggle('dis');
      if (check) {
        alert_box.style.display = 'block';
      } else {
        alert_box.style.display = 'none';
      }
   }
   //method to display alertbox which proclaims to check the alert at the month end. this method get excecuted when checklater return with false
   checklater(){
    let alt_box = document.getElementById('alt__box');
      let check = document.getElementById('alt__box').classList.toggle('dis');
      if (check) {
        alt_box.style.display = 'block';
      } else {
        alt_box.style.display = 'none';
   }
   }
 }
 //this function get called when user click alert button on dashboard
 var overEquip = [];
 var underEquip = [];
 function alertHandler(){
  var xhr = new XMLHttpRequest();
  let obj1 =  xhr.open('GET', 'https://nlok5923.github.io/RawQuotesData/cloud_data.json', true);
  xhr.onload = function () {
    console.log(this.state);
    console.log(JSON.parse(this.responseText));
    object = JSON.parse(this.responseText);
    let randomNo = Math.floor(Math.random() * 26);
    object.map((data) => (data.status === "crossed limit") ? overEquip.push(data.name):underEquip.push(data.name));
    // let quote = document.getElementById('quote');
    // quote.innerHTML = quoteArray[randomNo];
    // let authorName = document.getElementById('author');
    // authorName.innerHTML = author[randomNo];
  };
  xhr.send();
  }
  //function executes when window onload to display figure like bar,line,pie chart etc
</script>
</html>

