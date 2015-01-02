
<?php
//print_r($_SERVER['REQUEST_METHOD']);
session_start();
if($_SERVER['REQUEST_METHOD']=='GET'){
    header('location:login.php');
}
$_SESSION['loggedin']= true;
//header('location:dashboard.php')
$username = $_POST["username"];
$password = $_POST["password"];

if (isset($username)&& empty($username)) {
    $_SESSION['message']="invalid username";
    header('location:login.php');
}
if (isset($password)&& empty($password)) {
    $_SESSION['messagepass'] = "invalid password";
    header('location:login.php');
}
$link = mysqli_connect("localhost",
    "root",
    "baby12",
    "registration");
$query = "SELECT *
FROM `user`
WHERE `username` = '$username' AND `password`= '$password'; ";
$result = mysqli_query($link, $query);
//echo $query;
$row = mysqli_fetch_assoc($result);
//var_dump($row);
if(($username == $row['username']) && ($password == $row['password']))
{
//(SEND Data to the SESSION and GO to The Dashboard)
    $_SESSION['ID']=$row['ID'];
    $_SESSION['name']=$row['name'];
    $_SESSION['email']=$row['email'];
    $_SESSION['username']=$row['username'];
    $_SESSION['password']=$row['password'];
    header('location:dashboard.php');
}

if($row != "NULL"){
if(($username != $row['username']) && ($password != $row['password'])){
//(Redirect to the Login page with a Message)
    header('location:newuser.php');}}


