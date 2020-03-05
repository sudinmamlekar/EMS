
<?php include 'include/employeeheader.php';
 ?>
 <?php
 session_start();
if(strlen($_SESSION['uid'])=="")
{
  header('location:logout.php');
}
// include Function  file
include_once('function.php');
// Object creation
$leave=new DB_con();
    if(isset($_POST['applyleave'])){
    $id = $_SESSION['uid'];
    $leavetype = $_POST['leavetype'];
    $fromdate = $_POST['fromdate'];
    $todate = $_POST['todate'];
    $description = $_POST['description']; 
    $status = "Pending";
    $leave->applyLeave($id,$leavetype,$fromdate,$todate,$description,$status);
    header('location:leaveHistory.php');
  }
  $data = $leave->GetLeaveType(); 
?>
<!DOCTYPE html>
<html>
<head>
<title>Employee</title>
<link rel="stylesheet" href="assests/AdmEmp.css">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
<div class="container">
       <table class="table table-striped">
          <tbody>
             <tr>
                <td colspan="1">
                   <form action="" method="post" class="well form-horizontal">
                      <fieldset>

                              <div class="form-group">
                             <div class="form-group">
                            <label class="col-md-4 control-label">Leave Type</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group">
                               
                                  <span class="input-group-addon" style="max-width: 100%;"><i class="glyphicon glyphicon-briefcase"></i></span>
                                  <select class="selectpicker form-control" id="leavetype" name="leavetype">
                                  <?php foreach($data as $user): ?>
                                  <option value="<?= $user['leaveType']; ?>"><?= $user['leaveType']; ?></option>
                                  <?php endforeach; ?>
                                  </select>
                               </div>
                            </div>
                         </div>
                          
                         <div class="form-group">
                            <label class="col-md-4 control-label">From Date</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span><input id="fromdate" name="fromdate" placeholder="From Date" class="form-control" required="true" value="" type="date"></div>
                            </div>
                         </div>
                       
                         <div class="form-group">
                            <label class="col-md-4 control-label">To Date</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span><input id="todate" onBlur="checkdatevalidation()" name="todate" placeholder="To Date" class="form-control" required="true" value="" type="date">
                            </div>
                         </div>

                               <div class="form-group">
                            <label class="col-md-4 control-label">Description</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span><input id="description" name="description" placeholder="Description" class="form-control" required="true" value="" type="text"></div>
                            </div>
                         </div>
                         <div class="col-md-12">
                            <div  class="container-login100-form-btn">
                              <center>
                              <button class="login100-form-btn" type="submit" name="applyleave">Apply</button>
                            </center>
                            </div>
                         </div>
                      </fieldset>
                   </form>
                </td>
             </tr>
          </tbody>
       </table>
    </div>
</body>
</html>