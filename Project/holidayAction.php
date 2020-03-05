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
$data = $db->GetHolidays();
if($db->totalHolidayRowCount()>0){
	$output.='<table class="table table-striped table-sm table-bordered">
        <thead>
          <tr class="text-center">
            <th class="text-center">ID</th>
            <th class="text-center">From Date</th>
            <th class="text-center">To Date</th>
            <th class="text-center">Holiday Description</th>
            <th class="text-center">Action</th>
           </tr>
         </thead>
         <tbody>';
         foreach ($data as $row) {
         	$output .='<tr class="text-center text-secondary">
         	<td>'.$row['id'].'</td>
         	<td>'.$row['fromdate'].'</td>
          <td>'.$row['todate'].'</td>
          <td>'.$row['holiday'].'</td>
			<td>
              <a href="#" title="View Details" class="text-success infoBtn" id="'.$row['id'].'"><i class="fas fa-info-circle fa-lg"></i> </a>&nbsp;&nbsp;

              <a href="#" title="Edit" class="text-primary editBtn" data-toggle="modal" data-target="#editModal" id="'.$row['id'].'"><i class="fas fa-edit fa-lg"></i> </a>&nbsp;&nbsp;

              <a href="#" title="Edit" class="text-danger delBtn" id="'.$row['id'].'"><i class="fas fa-trash-alt fa-lg"></i></a>
            </td></tr>';
         }
         $output.= '</tbody></table>';
         echo $output;

}
else{
	echo '<h3 class="text-center text-secondary mt-5">:( Holiday records does not present in the database!</h3>';
}
}
/*if(isset($_POST['action']) && $_POST['action'] == "insert"){
  $hname = $_POST['hname'];
  $fromdate = $_POST['fromdate'];
  $todate = $_POST['todate'];
  
  $result=$db->Holidayavailblty($hname);
  $row = mysqli_fetch_row($result);
  $dept_count = $row[0];
  if($dept_count == 0) 
  { 
    $db->insertHoliday($hname,$fromdate,$todate);  
 }
}*/
	
if(isset($_POST['edit_id'])){
	$id = $_POST['edit_id'];

	$row = $db->getHolidayById($id);
    echo json_encode($row);
}
/*
if(isset($_POST['action']) && $_POST['action'] == "update"){
    $id = $_POST['id'];
    $hname = $_POST['hname'];
    $fromdate = $_POST['fromdate'];
    $todate = $_POST['todate'];
  
    $result=$db->Holidayavailblty($hname);
    $row = mysqli_fetch_row($result);
    $dept_count = $row[0];
    if($dept_count == 0) 
    { 
    $db->updateHoliday($id,$hname,$fromdate,$todate);
    }
  }*/

if(isset($_POST['del_id'])){
    $id = $_POST['del_id'];

    $db->deleteHoliday($id);
}

if(isset($_POST['info_id'])){
  $id = $_POST['info_id'];

  $row = $db->getHolidayById($id);
  echo json_encode($row);  
}
?>
