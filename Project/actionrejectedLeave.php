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
$status ="Rejected";
$data = $db->GetLeave($status);
$result = $db->totalleaveCount($status);
   if (mysqli_num_rows($result)>0)
   {
	$output .='<table class="table table-striped table-sm table-bordered">
        <thead>
          <tr class="text-center">
            <th class="text-center">ID</th>
            <th class="text-center">Leave Type</th>
            <th class="text-center">From Date</th>
            <th class="text-center">To Date</th>
            <th class="text-center">Description</th>
            <th class="text-center">Status</th>
            <th class="text-center">Employee Id</th>
            <th class="text-center">Employee Name</th>
           </tr>
         </thead>
         <tbody>';
         foreach ($data as $row) {
         	$output .='<tr class="text-center text-secondary">
            <td>'.$row['id'].'</td>
          <td>'.$row['leaveType'].'</td>
           <td>'.$row['fromDate'].'</td>
           <td>'.$row['toDate'].'</td>
           <td>'.$row['description'].'</td> 
          <td>'.$row['status'].'</td>
          <td>'.$row['empid'].'</td>
          <td>'.$row['full_name'].'</td>
			 </tr>';
         }
         $output.= '</tbody></table>';
         echo $output;
}
else{
	echo '<h3 class="text-center text-secondary mt-5">:( Employee records does not present in the database!</h3>';
}
}
	
?>
