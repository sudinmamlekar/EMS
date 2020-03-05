<?php include 'include/header.php'; ?>
<?php
session_start();
if (isset($_SESSION['uid'])){
    header('location:test.php');
    exit();
  }
// include Function  file
include_once('function.php');
// Object creation
$emp=new DB_con();
if(isset($_POST['employeelogin']))
{
// Posted Values
$email=$_POST['email'];
$pasword=md5($_POST['password']);
//Function Calling
$ret=$emp->employeesignin($email,$pasword);
$num=mysqli_fetch_array($ret);
if($num>0)
{
  $_SESSION['uid']=$num['id'];
  $_SESSION['fname']=$num['full_name'];
// For success
echo "<script>window.location.href='test.php'</script>";
}
else
{
// Message for unsuccessfull login
echo "<script>alert('Invalid details. Please try again');</script>";
echo "<script>window.location.href='elogin.php'</script>";
}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Employee Login</title>
	<link rel="stylesheet" href="assests/AdmEmp.css">
</head>
<body>

	<center>
			<div class="wrap-login100">
				<div class="login100-pic js-tilt">
					<img src="https://2.bp.blogspot.com/-l9nGy2e3PnA/XLzG5A6u_cI/AAAAAAAAAgI/31bl8XZOrTwN0kTN8c18YOG3OhNiTUrsQCLcBGAs/s1600/rocket.png" alt="IMG">
				</div>

				<form method="post" class="login100-form validate-form">
					<span class="login100-form-title">
						Employee Login
					</span>

					<div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
						<input class="input100" type="email" name="email" placeholder="Email" required autocomplete="off">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<input class="input100" type="password" name="password" placeholder="Password" autocomplete="off" required >
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn ">
						<button class="login100-form-btn" type="submit" name="employeelogin">Login</button>
					</div>

				<!--	<div class="text-center p-t-12">
						<span class="txt1">
							Forgot
						</span>
						<a class="txt2" href="#">
							Password?
						</a>
					</div>

					<div class="text-center p-t-136">
						<a class="txt2" href="#">
							Create your Account
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
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
