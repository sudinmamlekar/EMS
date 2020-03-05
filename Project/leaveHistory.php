<?php include 'include/employeeheader.php';
 ?>
<?php 
session_start();
if(strlen($_SESSION['uid'])=="")
{
  header('location:logout.php');
}
?>
<?php
// include Function  file
include_once('function.php');
// Object creation
$leave=new DB_con();
$data = $leave->GetLeaveType(); 
if(isset($_POST['insert'])){
    $id = $_SESSION['uid'];
    $leavetype = $_POST['leaveType'];
    $fromdate = $_POST['fromdate'];
    $todate = $_POST['todate'];
    $description = $_POST['description']; 
    $status = "Pending";
    if($fromdate > $todate){
      echo '<script language="javascript">';
      echo 'alert("ToDate should be greater than FromDate")';
      echo '</script>';
    }else
    {
    $leave->applyLeave($id,$leavetype,$fromdate,$todate,$description,$status);
    header('location:leaveHistory.php');
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>employee management system</title> 
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.css"/>
</head>
<body>
<div class="container">
  <div class="row">
    <div class="col-lg-12">
    <h4 class="text-center mt-2 text-primary">Leave History</h4>
     
    </div>
  </div>
  <div class="row">
     <div class="col-lg-6">
      <button type="button" class="btn btn-primary m-1 float-right" data-toggle="modal" data-target="#addModal" ><i class=" fas a fa-list fa-lg"></i>&nbsp;&nbsp;Apply Leave</button>
    </div>
  </div>
   <hr class="my-1">
  <div class="row">
    <div class="col-lg-12">
     <div class="table-responsive" id="showUser">

  </div>
</div>
</div> 
</div>
<!--
<hr class="my-1">
<div class="row">
<div class="col=lg-12">
<div class="table-responsive" id="showUser">
<h3 class="text-center text-success" style="margin-top:150px">Loading...</h3>
</div>
</div>
</div>-->
 <!-- Add new employee Modal -->
  <div class="modal fade" id="addModal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Apply Leave </h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body px-4">
        <form action="" method="post" id="form-data">
            <div class="form-group">
            <span style="max-width: 100%;"></span>
            <select class="selectpicker form-control" name="leaveType">
            <?php foreach($data as $row): ?>
            <option value="<?= $row['leaveType']; ?>"><?= $row['leaveType']; ?></option>
            <?php endforeach; ?>
            </select>
            </div>

              <div class="form-group">
             <label>From Date</label>
            <input type="date" value="<?php echo date('Y-m-d'); ?>" name="fromdate" class="form-control"  min="<?php echo date('Y-m-d'); ?>" required> 
          </div>

            <div class="form-group">
             <label>To Date</label>
            <input type="date" value="<?php echo date('Y-m-d'); ?>" name="todate" class="form-control" min="<?php echo date('Y-m-d'); ?>" required> 
          </div>

          <div class="form-group">
            <input type="text" name="description" class="form-control" placeholder="Description" required> 
          </div>
           <div class="form-group">
            <input type="submit" name="insert" id="insert" value="Apply" class="btn btn-danger btn-block">
           </div>
        </form>
        </div> 
      </div>
    </div>
  </div>

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script type="text/javascript">
  $(document).ready(function(){

    showAllleaves();

    function showAllleaves(){
      $.ajax({
        url: "actionleaveHistory.php",
        type: "POST",
        data: {action:"view"},
        success:function(response){
          //console.log(response);
          $("#showUser").html(response);
          $("table").DataTable({
            order: [0, 'desc']
          });
        }
      });
    }
  });
</script>
</body>
</html>