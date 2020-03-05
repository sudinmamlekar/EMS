<?php
session_start();
if(isset($_SESSION['uid'])){
    header('location:index.php');
  }
// include Function  file
include_once('function.php');
// Object creation
$usercredentials=new DB_con();
if(isset($_POST['login']))
{
// Posted Values
$uname=$_POST['username'];
$pasword=md5($_POST['password']);
//Function Calling
$ret=$usercredentials->signin($uname,$pasword);
$num=mysqli_fetch_array($ret);
if($num>0)
{
  $_SESSION['uid']=$num['id'];
  $_SESSION['fname']=$num['FullName'];
// For success
echo "<script>window.location.href='index.php'</script>";
}
else
{
// Message for unsuccessfull login
echo "<script>alert('Invalid details. Please try again');</script>";
echo "<script>window.location.href='alogin.php'</script>";
}
}
?>

<?php include 'include/header.php'; ?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin Login</title>
   <link rel="stylesheet" href="assests/AdmEmp.css">
</head>
<body>
      <center><div class="wrap-login100">
        <div class="login100-pic js-tilt">
          <img src="https://2.bp.blogspot.com/-l9nGy2e3PnA/XLzG5A6u_cI/AAAAAAAAAgI/31bl8XZOrTwN0kTN8c18YOG3OhNiTUrsQCLcBGAs/s1600/rocket.png" alt="IMG">
        </div>

        <form method="post" class="login100-form validate-form">
          <span class="login100-form-title">
            Admin Login
          </span>

          <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
            <input class="input100" type="text" name="username" placeholder="Username" required autocomplete="off" id="username">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
              <i class="fa fa-envelope" aria-hidden="true"></i>
            </span>
          </div>

          <div class="wrap-input100 validate-input" data-validate="Password is required">
            <input class="input100" type="password" name="password" placeholder="Password" required autocomplete="off" id="password"">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
              <i class="fa fa-lock" aria-hidden="true"></i>
            </span>
          </div>
          
          <div class="container-login100-form-btn">
           
            <button class="login100-form-btn" type="submit" name="login">Login</button>
      
          </div>
<!--
          <a href="dashboard.php" class="login100-form-btn">login</a>
          <div class="text-center p-t-12">
          <span class="txt1">
              Forgot
            </span>
            <a class="txt2" href="#">
              Username / Password?
            </a>
          </div>
        -->
        </form>
      </div>
    </div>
  </div>
  </center>
</body>
</html>