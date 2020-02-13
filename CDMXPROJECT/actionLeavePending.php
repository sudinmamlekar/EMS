<?php
require_once 'function.php';
$db = new DB_con();

if(isset($_POST['action']) && $_POST['action'] == "view"){
$output = '';
$status ="Pending";
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
            <th class="text-center">Action</th>
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
			    <td>
          <a href="#" title="Accept Leave" class="text-success AcceptBtn" id="'.$row['id'].'"><i class="fas fa-check-circle fa-lg"></i> </a>&nbsp;&nbsp;

          <a href="#" title="Reject Leave" class="text-danger RejectBtn" id="'.$row['id'].'"><i class="fas fa-times-circle fa-lg"></i></a>
            </td></tr>';
         }
         $output.= '</tbody></table>';
         echo $output;
}
else{
	echo '<h3 class="text-center text-secondary mt-5">:( Employee records does not present in the database!</h3>';
}
}
	

if(isset($_POST['acc_id'])){
    $id = $_POST['acc_id'];
    $status = "Approved";
    $db->updateleavestatus($id,$status);
}


if(isset($_POST['rej_id'])){
    $id = $_POST['rej_id'];
    $status = "Rejected";
    $db->updateleavestatus($id,$status);
}
?>
