<?php
define('DB_SERVER','localhost');
define('DB_USER','sudin');
define('DB_PASS' ,'sudin');
define('DB_NAME', 'EMS');
class DB_con
{
function __construct()
{
$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
$this->dbh=$con;
// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
 }
}

 //for useremail availblty
public function useremailavailblty($email) {
$result =mysqli_query($this->dbh,"SELECT count(*) FROM users WHERE email='$email'");
return $result;
}

 //for Department availblty
 public function Departmentavailblty($dname) {
	$result =mysqli_query($this->dbh,"SELECT count(*) FROM department WHERE Department='$dname'");
	return $result;
	}

/* Function for registration
	public function registration($fname,$uname,$uemail,$pasword)
	{
	$ret=mysqli_query($this->dbh,"insert into tblusers(FullName,Username,UserEmail,Password) values('$fname','$uname','$uemail','$pasword')");
	return $ret;
	}*/

// Function for admin signin
public function signin($uname,$pasword)
	{
	$result=mysqli_query($this->dbh,"select id,FullName from admin where Username='$uname' and Password='$pasword'");
	return $result;
	}
	
	// Function for employee signin
public function employeesignin($email,$pasword)
{
$result=mysqli_query($this->dbh,"select id,full_name from users where email='$email' and Password='$pasword'");
return $result;
}

// Function select all records from Employee
public function GetEmployee()
{	
	$data = array();
	$sql=mysqli_query($this->dbh,"select * from users");
	 while($row = mysqli_fetch_assoc($sql))  
           {  
                $data[] = $row;  
           }  
           return $data;
}
 
// function total row count
public function totalRowCount(){
	$sql=mysqli_query($this->dbh,"select * from users")->num_rows;
	return $sql;
}

// function total Department row count
public function totalDepartmentRowCount(){
	$sql=mysqli_query($this->dbh,"select * from department")->num_rows;
	return $sql;
}

// Function to insert Employee
public function insertEmployee($fname,$email,$password,$phone,$department,$designation,$joiningdate,$dob,$gender,$address,$city,$country){
	$sql=mysqli_query($this->dbh,"insert into users (full_name,email,password,phone,department,designation,joiningdate,dob,gender,address,city,country) values('$fname','$email','$password','$phone','$department','$designation','$joiningdate','$dob','$gender','$address','$city','$country')");
	return true;
}  

//Function select single employee record
   public function getEmployeeById($id){
   $sql=mysqli_query($this->dbh,"select * from users where id=$id");
    while($row = mysqli_fetch_assoc($sql))  
           {  
                $data[] = $row;  
           }  
           return $data;
}

//function update employee
public function updateEmployee($id,$fname,$email,$phone,$department,$designation,$joiningdate,$dob,$gender,$address,$city,$country){
	$sql=mysqli_query($this->dbh,"update users set full_name='$fname', email='$email',phone='$phone',department='$department',designation='$designation',joiningdate='$joiningdate',dob='$dob',gender='$gender',address='$address',city='$city',country='$country' where id='$id'");
	return true;
}

// function delete employee
public function deleteEmployee($id){
	$sql=mysqli_query($this->dbh,"delete from users where id='$id'");
	return true;
}

//function admin change password
public function passwordvalid($pwd){
	$id=$_SESSION['uid'];
	$sql=mysqli_query($this->dbh,"update admin set password='$pwd' where id= '$id'");
	return true;
}

//function Employee change password
public function emppasswordvalid($pwd){
	$id=$_SESSION['uid'];
	$sql=mysqli_query($this->dbh,"update users set password='$pwd' where id= '$id'");
	return true;
}

//Function for getting departments
public function GetDepartment()
{	
	$data = array();
	$sql=mysqli_query($this->dbh,"select * from department");
	 while($row = mysqli_fetch_assoc($sql))  
           {  
                $data[] = $row;  
           }  
           return $data;
}

//Function for getting designation
public function GetDesignation()
{	
	$data = array();
	$sql=mysqli_query($this->dbh,"select * from designation");
	 while($row = mysqli_fetch_assoc($sql))  
           {  
                $data[] = $row;  
           }  
           return $data;
}

// Function to insert Department
public function insertDepartment($dname){
	$sql=mysqli_query($this->dbh,"insert into department (Department) values('$dname')");
	return true;
}  

//Function select single department record
public function getDepartmentById($id){
	$sql=mysqli_query($this->dbh,"select * from department where id=$id");
	 while($row = mysqli_fetch_assoc($sql))  
			{  
				 $data[] = $row;  
			}  
			return $data;
 }

 //function update department
public function updatedepartment($id,$dname){
	$sql=mysqli_query($this->dbh,"update department set Department='$dname' where id='$id'");
	return true;
}

// function delete Department
public function deleteDepartment($id){
	$sql=mysqli_query($this->dbh,"delete from department where id='$id'");
	return true;
}

// function total designation row count
public function totalDesignationRowCount(){
	$sql=mysqli_query($this->dbh,"select * from designation")->num_rows;
	return $sql;
}

 //for Designation availblty
 public function Designationavailblty($dname) {
	$result =mysqli_query($this->dbh,"SELECT count(*) FROM designation WHERE designation='$dname'");
	return $result;
	}

	// Function to insert Designation
public function insertDesignation($dname){
	$sql=mysqli_query($this->dbh,"insert into designation (designation) values('$dname')");
	return true;
}  

//Function select single designation record
public function getDesignationById($id){
	$sql=mysqli_query($this->dbh,"select * from designation where id=$id");
	 while($row = mysqli_fetch_assoc($sql))  
			{  
				 $data[] = $row;  
			}  
			return $data;
 }

  //function update designation
public function updatedesignation($id,$dname){
	$sql=mysqli_query($this->dbh,"update designation set designation='$dname' where id='$id'");
	return true;
}

// function delete Designation
public function deleteDesignation($id){
	$sql=mysqli_query($this->dbh,"delete from designation where id='$id'");
	return true;
}


 // function get leave type
public function GetLeaveType(){
	$data = array();
	$sql=mysqli_query($this->dbh,"select * from leaveType");
	 while($row = mysqli_fetch_assoc($sql))  
           {  
                $data[] = $row;  
           }  
           return $data;
}

//function apply leave
public function applyLeave($id,$leavetype,$fromdate,$todate,$description,$status){
	$sql=mysqli_query($this->dbh,"insert into leaves (leaveType,fromDate,Todate,description,status,empid) values('$leavetype','$fromdate','$todate','$description','$status','$id')");
	return true;
}  

//Function get leaves by id
public function getleaves($id){
	$sql=mysqli_query($this->dbh,"select * from leaves where empid='$id'");
	 while($row = mysqli_fetch_assoc($sql))  
			{  
				 $data[] = $row;  
			}  
			return $data;
 }

// function total leaves row count by id
public function totalleavesCount($id){
	$sql=mysqli_query($this->dbh,"select * from leaves where empid='$id'");
	return $sql;
}

//Function for getting leaves
/*public function GetLeave($status)
{	
	//$data = array();
	$sql=mysqli_query($this->dbh,"select * from leaves where status='$status'");
	 while($row = mysqli_fetch_assoc($sql))  
           {  
                $data[] = $row;  
           }  
           return $data;
}

 function total leaves row count
public function totalleaveCount($status){
	$sql=mysqli_query($this->dbh,"select * from leaves where status='$status'");
	return $sql;
}
*/

//Function for getting leaves
public function GetLeave($status)
{	
	//$data = array();
$sql=mysqli_query($this->dbh,"SELECT leaves.id,leaves.leaveType,leaves.fromDate,leaves.toDate,leaves.description,leaves.status,leaves.empid,users.full_name FROM leaves inner join users on leaves.empid = users.id where status='$status'");
	 while($row = mysqli_fetch_assoc($sql))  
           {  
                $data[] = $row;  
           }  
           return $data;
}

// function total leaves row count
public function totalleaveCount($status){
$sql=mysqli_query($this->dbh,"SELECT leaves.id,leaves.leaveType,leaves.fromDate,leaves.toDate,leaves.description,leaves.status,leaves.empid,users.full_name FROM leaves inner join users on leaves.empid = users.id where status='$status'");
	return $sql;
}

  //function update leave status
public function updateleavestatus($id,$status){
	$sql=mysqli_query($this->dbh,"update leaves set status='$status' where id='$id'");
	return true;
}

public function deleteLeave($id){
	$sql=mysqli_query($this->dbh,"delete from leaves where id='$id'");
	return true;
}

//Function for getting holidays
public function GetHolidays()
{	
	$data = array();
	$sql=mysqli_query($this->dbh,"select * from holidays");
	 while($row = mysqli_fetch_assoc($sql))  
           {  
                $data[] = $row;  
           }  
           return $data;
}

// function total Holiday row count
public function totalHolidayRowCount(){
	$sql=mysqli_query($this->dbh,"select * from holidays")->num_rows;
	return $sql;
}

 //for Holiday availblty
 public function Holidayavailblty($hname) {
	$result =mysqli_query($this->dbh,"SELECT count(*) FROM holidays WHERE holiday='$hname'");
	return $result;
	}

// Function to insert Department
public function insertHoliday($hname,$fromdate,$todate){
	$sql=mysqli_query($this->dbh,"insert into holidays(holiday,fromdate,todate) values('$hname','$fromdate','$todate')");
	return true;
} 

//Function select single holiday record
public function getHolidayById($id){
	$sql=mysqli_query($this->dbh,"select * from holidays where id='$id'");
	 while($row = mysqli_fetch_assoc($sql))  
			{  
				 $data[] = $row;  
			}  
			return $data;
 }

  //function update department
public function updateHoliday($id,$hname,$fromdate,$todate){
	$sql=mysqli_query($this->dbh,"update holidays set holiday='$hname',fromdate='$fromdate',todate='$todate' where id='$id'");
	return true;
}

// function delete Department
public function deleteHoliday($id){
	$sql=mysqli_query($this->dbh,"delete from holidays where id='$id'");
	return true;
}
}
?>