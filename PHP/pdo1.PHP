<?php
define('server','localhost');// defining hostname
define('username','root'); // defining username
define('password' ,''); // defining Password
define('databasename', 'Eclec');// defining database name
class Database_Connection
{
function __construct()
{
$connection = mysqli_connect(server,username,password,databasename);
$this->dbhost=$connection;
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
}
public function equipment($equipment,$min,$max,$priority,$consumption,$Username,$number)
{
$adding=mysqli_query($this->dbhost,"insert into equipment(user,equipment,min_hrs,max_hrs,priority,watt_consumption,number) values('$Username','$equipment','$min','$max','$priority','$consumption','$number')");
return $adding;
}
public function viewall($username)
{
    $viewing = mysqli_query($this->dbhost,"select * from signupid where NOT (Name = '$username')
    ");
    return $viewing;
}
public function viewing($username)
{
$viewing = mysqli_query($this->dbhost,"select * from equipment where user='$username' ");
return $viewing;
}

public function updatevalue($fname,$lname,$email,$pass,$income,$sum,$user)
{
$update = mysqli_query($this->dbhost,"UPDATE signupid SET firstname='$fname', lastname='$lname',income='$income' ,Email='$email',expenses = '$sum' WHERE Name='$user' AND Password='$pass' ");
return $update;
}
public function signup($name,$username,$useremail,$userpassword,$locality)
{
$adding=mysqli_query($this->dbhost,"insert into signupid(Name,Username,Email,Password,locality) values('$name','$username','$useremail','$userpassword','$locality')");
return $adding;
}
public function signin($username,$userpassword)
{
$seeing=mysqli_query($this->dbhost,"select Name from signupid where Name='$username' and Password='$userpassword'");
return $seeing;
}
public function imagesaving($Name,$image,$Userdate,$user)
{
$saving=mysqli_query($this->dbhost,"INSERT into images (image,name,time,uploaded,username) VALUES ('$image','$Name','$Userdate', NOW(),'$user')");
return $saving;
}
public function downloading($date,$user)
{
$viewing = mysqli_query($this->dbhost,"select image from images where time ='$date' and username='$user' ");
return $viewing;
}
}

?>
