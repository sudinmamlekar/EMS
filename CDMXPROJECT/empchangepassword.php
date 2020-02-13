<?php include 'include/employeeheader.php'; ?>
<?php
session_start();
// include Function  file
include_once('function.php');
// Object creation
$chgpwd=new DB_con();
if(isset($_POST['empchangepassword']))
{
// Posted Values
$password=$_POST['password'];
$confirmpasword=$_POST['confirmpassword'];

if($password==$confirmpasword)
{
    $password=md5($password);
        //Function Calling
        $ret=$chgpwd->emppasswordvalid($password);
       if($ret)
    {
        
        echo "<script>window.location.href='test.php'</script>";
    }

    else
    {   
        echo "<script>alert('Please try again');</script>";
        echo "<script>window.location.href='empchangepassword.php'</script>";
    }
}
else{
        echo "<script>alert('Password does not match');</script>";
        echo "<script>window.location.href='empchangepassword.php'</script>";
    }
  }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Change Password</title>
        <link rel="stylesheet" href="assests/AdmEmp.css">
    </head>
    <body>
        <center><div class="wrap-login100">
        <div class="login100-pic js-tilt">
          <img src="https://2.bp.blogspot.com/-l9nGy2e3PnA/XLzG5A6u_cI/AAAAAAAAAgI/31bl8XZOrTwN0kTN8c18YOG3OhNiTUrsQCLcBGAs/s1600/rocket.png" alt="IMG">
        </div>

        <form method="post" class="login100-form validate-form">
          <span class="login100-form-title">
                 Confirm Password
          </span>

          <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
            <input class="input100" type="password" name="password" placeholder="Password" required autocomplete="off" id="username">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
              <i class="fa fa-envelope" aria-hidden="true"></i>
            </span>
          </div>

          <div class="wrap-input100 validate-input" data-validate="Password is required">
            <input class="input100" type="password" name="confirmpassword" placeholder="Confirm Password" required autocomplete="off" id="password">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
              <i class="fa fa-lock" aria-hidden="true"></i>
            </span>
          </div>
          
          <div class="container-login100-form-btn">
            <button class="login100-form-btn" type="submit" name="empchangepassword">Change Password</button>
          </div>
          
        </form>
        </div>
        </div>
    </div>
  </center>
    </body>
</html>