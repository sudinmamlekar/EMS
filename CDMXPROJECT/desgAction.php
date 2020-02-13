<?php
require_once 'function.php';
$db = new DB_con();

if(isset($_POST['action']) && $_POST['action'] == "view"){
$output = '';
$data = $db->GetDesignation();
if($db->totalDesignationRowCount()>0){
	$output.='<table class="table table-striped table-sm table-bordered">
        <thead>
          <tr class="text-center">
            <th class="text-center">ID</th>
            <th class="text-center">Designation</th>
            <th class="text-center">Action</th>
           </tr>
         </thead>
         <tbody>';
         foreach ($data as $row) {
         	$output .='<tr class="text-center text-secondary">
         	<td>'.$row['id'].'</td>
         	<td>'.$row['designation'].'</td>
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
	echo '<h3 class="text-center text-secondary mt-5">:( Designation records does not present in the database!</h3>';
}
}
if(isset($_POST['action']) && $_POST['action'] == "insert"){
  $dname = $_POST['dname'];
  $result=$db->Designationavailblty($dname);
  if (mysqli_num_rows($result)==0)
  { 
    $db->insertDesignation($dname);  
 }
 else
 { 
   echo" <script>alert('Designation already exist.')<script>";
   echo "<script>window.location.href='designation.php'</script>";
 }
}

	
if(isset($_POST['edit_id'])){
	$id = $_POST['edit_id'];

	$row = $db->getDesignationById($id);
    echo json_encode($row);
}

if(isset($_POST['action']) && $_POST['action'] == "update"){
    $id = $_POST['id'];
    $dname = $_POST['dname'];
    $result=$db->Designationavailblty($dname);
    if (mysqli_num_rows($result)==0)
    { 
    $db->updatedesignation($id,$dname);
    }
    else
   { 
    echo" <script>alert('Designation already exist.')<script>";
    echo "<script>window.location.href='designation.php'</script>";
   }
  }

if(isset($_POST['del_id'])){
    $id = $_POST['del_id'];

    $db->deleteDesignation($id);
}

if(isset($_POST['info_id'])){
  $id = $_POST['info_id'];

  $row = $db->getDesignationById($id);
  echo json_encode($row);  
}
?>
