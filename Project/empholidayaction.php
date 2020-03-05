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
           </tr>
         </thead>
         <tbody>';
         foreach ($data as $row) {
         	$output .='<tr class="text-center text-secondary">
         	<td>'.$row['id'].'</td>
         	<td>'.$row['fromdate'].'</td>
          <td>'.$row['todate'].'</td>
          <td>'.$row['holiday'].'</td>
			</tr>';
         }
         $output.= '</tbody></table>';
         echo $output;

}
else{
	echo '<h3 class="text-center text-secondary mt-5">:( Holiday records does not present in the database!</h3>';
}
}
?>
