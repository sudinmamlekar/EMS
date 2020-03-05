<?php
error_reporting(E_ALL);
ini_set('display_errors', 'on');
include_once("function.php");
 session_start();
if(strlen($_SESSION['uid'])=="")
{
  header('location:logout.php');
}
$em=new DB_con();
//code check email
if(!empty($_POST["emailid"])) {
$emailvalue=$_POST["emailid"];
$result=$em->useremailavailblty($emailvalue);
$row = mysqli_fetch_row($result);
$email_count = $row[0];
if($email_count>0)
{ 	
	echo "<span style='color:red'> Email Already Exist .</span>";
}
else
{
	echo "<span style='color:green'> Email Available.</span>";
}
}
// End code check email

// code check department
if(!empty($_POST["deptid"])) {
$deptvalue=$_POST["deptid"];
$results=$em->Departmentavailblty($deptvalue);
$row = mysqli_fetch_row($results);
$dept_count = $row[0];
if($dept_count>0) 
	{
		echo "<span style='color:red'> Department Already Exist .</span>";
}
else{
 echo "<span style='color:green'> Department Available.</span>";
}
}
// End code department

// code check designation
if(!empty($_POST["desgid"])) {
$desgvalue=$_POST["desgid"];
$data=$em->Designationavailblty($desgvalue);
$row = mysqli_fetch_row($data);
$desg_count = $row[0];
if($desg_count>0)
{ 
	echo "<span style='color:red'> Designation Already Exist .</span>";
}
else 
{	
	echo "<span style='color:green'> Designation Available.</span>";
}
}
// End code designation

// code check designation
if(!empty($_POST["holidayid"])) {
$holidayvalue=$_POST["holidayid"];
$data=$em->Holidayavailblty($holidayvalue);
$row = mysqli_fetch_row($data);
$desg_count = $row[0];
if($desg_count>0)
{ 
	echo "<span style='color:red'> Holiday Already Exist .</span>";
}
else 
{	
	echo "<span style='color:green'> Holiday Available.</span>";
}
}
// End code designa
?>