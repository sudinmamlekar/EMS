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
    <li class="nav-item">
      <a class="nav-link" href="empchangepassword.php"><span class="glyphicon glyphicon-lock"></span> Change Password</a>
    </li> 
    </ul>
   
     <!--  <ul class="nav navbar-nav navbar-right">
    <li class="nav-item">
      <a class="nav-link" href="leaveHistory.php"><span class=" glyphicon glyphicon-th"></span> Leaves</a>
    </li> 
    </ul>-->
    <ul class="nav navbar-nav navbar-right">
      <li><a href="empholiday.php"><span class="glyphicon glyphicon-th-list"></span> Holidays</a></li>
    </ul>
     <ul class="nav navbar-nav navbar-right">
     <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#"  id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

        <span class="glyphicon glyphicon-th"></span> Leaves
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="leaveHistory.php">&nbsp;&nbsp; Apply Leaves</a><br>
          <a class="dropdown-item" href="empPendingLeaves.php">&nbsp;&nbsp; Pending Leaves</a><br>
          <a class="dropdown-item" href="empApprovedLeaves.php">&nbsp;&nbsp; Approved Leaves</a><br>
          <a class="dropdown-item" href="empRejectedLeaves.php">&nbsp;&nbsp; Rejected Leaves</a>
        </div>
      </li>
      </ul>

    <ul class="nav navbar-nav navbar-right">
    <li class="nav-item">
      <a class="nav-link" href="test.php"><span class="glyphicon glyphicon-home"></span> Home</a>
    </li> 
    </ul>
  </div>
</nav>
</body>
</html>
