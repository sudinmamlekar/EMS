<?php
require_once 'function.php';
session_start();
if(strlen($_SESSION['uid'])=="")
{
  header('location:logout.php');
}
$db = new DB_con();

if(isset($_POST['action']) && $_POST['action'] == "view"){
$output = '';
$data = $db->GetEmployee();
if($db->totalRowCount()>0){
	$output .='<table class="table table-striped table-sm table-bordered">
        <thead>
          <tr class="text-center">
            <th class="text-center">ID</th>
            <th class="text-center">Full Name </th>
            <th class="text-center">E-Mail</th>
            <th class="text-center">Phone</th>
            <th class="text-center">Department</th>
            <th class="text-center">Designation</th>
            <th class="text-center">Action</th>
           </tr>
         </thead>
         <tbody>';
         foreach ($data as $row) {
         	$output .='<tr class="text-center text-secondary">
         	<td>'.$row['id'].'</td>
         	<td>'.$row['full_name'].'</td>
           <td>'.$row['email'].'</td>
           <td>'.$row['phone'].'</td>
           <td>'.$row['department'].'</td> 
          <td>'.$row['designation'].'</td>
			<td>
              <a href="#" title="View Details" class="text-success infoBtn" id="'.$row['id'].'"><i class="fas fa-info-circle fa-lg"></i> </a>&nbsp;&nbsp;

              <a href="#" title="Edit" class="text-primary editBtn" data-toggle="modal" data-target="#editModal" id="'.$row['id'].'"><i class="fas fa-edit fa-lg"></i> </a>&nbsp;&nbsp;

              <a href="#" title="Delete" class="text-danger delBtn" id="'.$row['id'].'"><i class="fas fa-trash-alt fa-lg"></i></a>
            </td></tr>';
         }
         $output.= '</tbody></table>';
         echo $output;

}
else{
	echo '<h3 class="text-center text-secondary mt-5">:( Employee records does not present in the database!</h3>';
}
}
if(isset($_POST['action']) && $_POST['action'] == "insert"){
	$fname = $_POST['fname'];
  $email = $_POST['email'];
  $password = md5($_POST['password']);
  $phone = $_POST['phone']; 
  $department = $_POST['department']; 
  $designation = $_POST['designation']; 
  $joiningdate = $_POST['joiningdate'];
  $dob = $_POST['dob'];
  $gender = $_POST['gender'];
  $address = $_POST['address'];
  $city = $_POST['city'];
  $country = $_POST['country'];
  $result=$db->useremailavailblty($email);
  $row = mysqli_fetch_row($result);
  $email_count = $row[0];
  if($email_count == 0) 
  { 
    $db->insertEmployee($fname,$email,$password,$phone,$department,$designation,$joiningdate,$dob,$gender,$address,$city,$country);  
 }
}
	
if(isset($_POST['edit_id'])){
	$id = $_POST['edit_id'];

	$row = $db->getEmployeeById($id);
    echo json_encode($row);
}

if(isset($_POST['action']) && $_POST['action'] == "update"){
    $id = $_POST['id'];
    $fname = $_POST['fname'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $phone = $_POST['phone'];
    $department = $_POST['department']; 
    $designation = $_POST['designation'];
    $joiningdate = $_POST['joiningdate'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $country = $_POST['country'];
    $result=$db->useremailavailblty($email);
    $row = mysqli_fetch_row($result);
    $email_count = $row[0];
    if($email_count == 0) 
    { 
    $db->updateEmployee($id,$fname,$email,$password,$phone,$department,$designation,$joiningdate,$dob,$gender,$address,$city,$country);
    }
  }

if(isset($_POST['del_id'])){
    $id = $_POST['del_id'];
    $db->deleteEmployee($id);
}

if(isset($_POST['info_id'])){
  $id = $_POST['info_id'];

  $row = $db->getEmployeeById($id);
  echo json_encode($row);  
}

if(isset($_GET['export']) && $_GET['export'] == "excel"){
  header("Content-Type: application/xls");
  header("Content-Disposition: attachment; filename=users.xls");
  header("Progra: no-chche");
  header("Expires: 0");

  $data = $db->GetEmployee();
  echo '<table border="1">';
  echo '<tr><th>ID</th><th>Full Name</th><th>Email</th><th width="10%">Password</th><th>Phone</th><th>Department</th><th>Designation</th><th>Joining Date</th><th>Date of Birth</th><th>Address</th><th>City</th><th>Country</th></tr>';

  foreach ($data as $row) {
    echo '<tr>
    <td>'.$row['id'].'</td>
    <td>'.$row['full_name'].'</td>
    <td>'.$row['email'].'</td>
    <td>'.$row['password'].'</td>
    <td>'.$row['phone'].'</td>
    <td>'.$row['department'].'</td>
    <td>'.$row['joiningdate'].'</td>
    <td>'.$row['dob'].'</td>
    <td>'.$row['address'].'</td>
    <td>'.$row['city'].'</td>
    <td>'.$row['country'].'</td>
    </tr>';
  }
  echo '</table>'; 
}
?>
