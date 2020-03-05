<?php
session_start();
$name = $_SESSION['fname'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
   <style>
  /* Make the image fully responsive */
  .carousel-inner img {
      width: 100%;
      height: 100%;
  }
  </style>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Employee Management System</a>
    </div>
  
 <div class="navbar-header">
      <a class="navbar-brand" href="#">Welcome: <?php echo $name ?></a></center>
    </div>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
     <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#"  id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="glyphicon glyphicon-cog"></span> Settings
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="changepassword.php">&nbsp;&nbsp; Change Password</a><br>
          <a class="dropdown-item" href="department.php">&nbsp;&nbsp; Add Department</a><br>
          <a class="dropdown-item" href="designation.php">&nbsp;&nbsp; Add Designation</a>
        </div>
      </li>
      </ul>

       <ul class="nav navbar-nav navbar-right">
      <li><a href="holidays.php"><span class="glyphicon glyphicon-th-list"></span> Holidays</a></li>
    </ul>
   <!-- <ul class="nav navbar-nav navbar-right">
    <li class="nav-item">
      <a class="nav-link" href="changepassword.php"><span class="glyphicon glyphicon-lock"></span>Change Password</a>
    </li> 
    </ul>-->
    <ul class="nav navbar-nav navbar-right">
     <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#"  id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

        <span class="glyphicon glyphicon-th"></span> Leaves
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="leavePending.php">&nbsp;&nbsp; Pending Leaves</a><br>
          <a class="dropdown-item" href="approvedLeave.php">&nbsp;&nbsp; Approved Leaves</a><br>
          <a class="dropdown-item" href="rejectedLeave.php">&nbsp;&nbsp; Rejected Leaves</a>
        </div>
      </li>
      </ul>
     <!--<ul class="nav navbar-nav navbar-right">
    <li class="nav-item">
      <a class="nav-link" href="leaveStatus.php"><span class="glyphicon glyphicon-th"></span> Leaves</a>
    </li> 
    </ul>-->
    <ul class="nav navbar-nav navbar-right">
    <li class="nav-item">
      <a class="nav-link" href="index.php"><span class="glyphicon glyphicon-home"></span> Home</a>
    </li> 
    </ul>
  </div>
</nav>
</body>
</html>
