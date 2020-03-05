<?php include 'include/employeeheader.php';
 ?>
 <?php
 session_start();
// include Function  file

if(strlen($_SESSION['uid'])=="")
{
  header('location:logout.php');
}
include_once('function.php');
// Object creation
$dept=new DB_con();
  if(isset($_POST['employeeupdate'])){
   
    $id = $_SESSION['uid'];
    $fname = $_POST['fullName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $department = $_POST['department']; 
    $designation = $_POST['designation'];
    $joiningdate = $_POST['joiningdate'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $country = $_POST['country'];
    $dept->updateEmployee($id,$fname,$email,$phone,$department,$designation,$joiningdate,$dob,$gender,$address,$city,$country);
    echo "<script>alert('Details updates successfully');</script>";
  }
  $data = $dept->GetDepartment();
  $designation = $dept->GetDesignation();
   $id = $_SESSION['uid'];
  $emp = $dept->getEmployeeById($id);
  foreach ($emp as $row) 
?>
 <!DOCTYPE html>
<html>
<head>
  <title>Employee</title>
  <link rel="stylesheet" href="assests/AdmEmp.css">
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
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
                            <label class="col-md-4 control-label">Full Name</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span><input id="fullName" name="fullName" placeholder="Full Name" class="form-control" required="true" value="<?php echo $row['full_name'] ?>" type="text"></div>
                            </div>
                         </div>
                              <div class="form-group">
                            <label class="col-md-4 control-label">Email</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span><input id="email" name="email" placeholder="Email" class="form-control" required="true" value="<?php echo $row['email'] ?>" type="text">
                               </div>
                            </div>
                         </div>
                          <!-- <div class="form-group">
                            <label class="col-md-4 control-label">Password</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span><input id="password" name="password" placeholder="Password" class="form-control" required="true" value="" type="text"></div>
                            </div>
                         </div> -->
                     
                         <div class="form-group">
                            <label class="col-md-4 control-label">Joining Date</label>
                            <div class="col-md-8 inputGroupContainer">
                           
                               <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span><input id="joiningdate" name="joiningdate" placeholder="Joining Date" class="form-control" required="true" value="<?php echo $row['joiningdate'] ?>" type="date"></div>
                            </div>
                         </div>
                       
                         <div class="form-group">
                            <label class="col-md-4 control-label">D.O.B</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span><input id="dob" name="dob" placeholder="Date of Birth" class="form-control" required="true" value="<?php echo $row['dob'] ?>" type="date"></div>
                            </div>
                         </div>

                             <div class="form-group">
                            <label class="col-md-4 control-label">Department</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group">
                                  <span class="input-group-addon" style="max-width: 100%;"><i class="glyphicon glyphicon-briefcase"></i></span>
                                  <select class="selectpicker form-control" id="department" name="department">
                                  <?php foreach($data as $user): ?>
                                  <option value="<?= $user['Department']; ?>"><?= $user['Department']; ?></option>
                                  <?php endforeach; ?>
                                  </select>
                               </div>
                            </div>
                         </div>
                         <div class="form-group">
                            <label class="col-md-4 control-label">Designation</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group">
                                  <span class="input-group-addon" style="max-width: 100%;"><i class="glyphicon glyphicon-briefcase"></i></span>
                                  <select class="selectpicker form-control" id="designation" name="designation">
                                  <?php foreach($designation as $user): ?>
                                  <option value="<?= $user['designation']; ?>"><?= $user['designation']; ?></option>
                                  <?php endforeach; ?>
                                  </select>
                               </div>
                            </div>
                         </div>
                    
                          <div class="form-group">
                            <label class="col-md-4 control-label">Phone Number</label>
                            <div class="col-md-8 inputGroupContainer">
                            <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span><input id="phoneNumber" name="phone" placeholder="Phone Number" class="form-control" required="true" value="<?php echo $row['phone'] ?>" type="text"></div>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-md-4 control-label">Gender</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span><input id="gender" name="gender" placeholder="Gender" class="form-control" required="true" value="<?php echo $row['gender'] ?>" type="text"></div>
                            </div>
                          </div>
                          <div class="form-group">
                             <label class="col-md-4 control-label">Address</label>
                             <div class="col-md-8 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span><input id="address" name="address" placeholder="Address" class="form-control" required="true" value="<?php echo $row['address'] ?>" type="text"></div>
                             </div>
                          </div>
                               <div class="form-group">
                            <label class="col-md-4 control-label">City</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span><input id="city" name="city" placeholder="City" class="form-control" required="true" value="<?php echo $row['city'] ?>" type="text"></div>
                            </div>
                         </div>
                               <div class="form-group">
                            <label class="col-md-4 control-label">Country</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span><input id="Country" name="country" placeholder="Country" class="form-control" required="true" value="<?php echo $row['country'] ?>" type="text"></div>
                            </div>
                         </div>
                         <div class="col-md-12">
                            <div  class="container-login100-form-btn">
                              <center>
                              <button class="login100-form-btn" type="submit" name="employeeupdate">Update</button>
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




