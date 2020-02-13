<?php include 'include/mainheader.php';
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
$data=new DB_con();
   $dept = $data->GetDepartment();
  $desg = $data->GetDesignation();
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
    <h4 class="text-center mt-2 text-primary">All Employee Record</h4>
     
    </div>
  </div>
  <div class="row">
     <div class="col-lg-6">
      <button type="button" class="btn btn-primary m-1 float-right" data-toggle="modal" data-target="#addModal" ><i class=" fas fa-user-plus fa-lg"></i>&nbsp;&nbsp;Add New Employee</button>

 <a href="action.php?export=excel" class="btn btn-success m1 float-right"><i class="fas fa-table fa-lg"></i>&nbsp;&nbsp;Export to Excel</a>
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
          <h4 class="modal-title">Add New Employee  </h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body px-4">
        <form action="" method="post" id="form-data">
          <div class="form-group">
            <input type="text" name="fname" class="form-control" placeholder="Full Name" required> 
          </div>

          <div class="form-group">
            <input type="email" name="email" class="form-control" placeholder="Email" required> 
          </div>
      
          <div class="form-group">
            <input type="password" name="password" class="form-control" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required> 
          </div>

              <div class="form-group">
            <input type="tel" name="phone" class="form-control" placeholder="Phone" required> 
            </div>
            <div class="form-group">

            <span style="max-width: 100%;"></span>
            <select class="selectpicker form-control" name="department">
            <?php foreach($dept as $row): ?>
            <option value="<?= $row['Department']; ?>"><?= $row['Department']; ?></option>
            <?php endforeach; ?>
            </select>
            </div>

           <div class="form-group">
            <span style="max-width: 100%;"></span>
            <select class="selectpicker form-control" name="designation">
            <?php foreach($desg as $row): ?>
            <option value="<?= $row['designation']; ?>"><?= $row['designation']; ?></option>
            <?php endforeach; ?>
            </select>
            </div>
                    
           <div class="form-group">
             <label>Joining Date</label>
            <input type="date" value="<?php echo date('Y-m-d'); ?>" name="joiningdate" class="form-control" placeholder="Joining Date" required> 
          </div>
           <div class="form-group">
            <label>Date of Birth</label>
            <input type="date" value="<?php echo date('Y-m-d'); ?>" name="dob" class="form-control" placeholder="D.O.B" required> 
          </div>
           <div class="form-group">
            <select name="gender" class="selectpicker form-control">
          <option >Male</option> 
          <option >Female</option> 
          <option >other</option> 
          </select>
          </div>
           <div class="form-group"> 
          <input type="text" name="address" class="form-control" placeholder="Address" required> 
          </div>
           <div class="form-group">
            <input type="text" name="city" class="form-control" placeholder="City" required> 
          </div>
            <div class="form-group">
            <input type="text" name="country" class="form-control" placeholder="Country" required> 
          </div>
           <div class="form-group">
            <input type="submit" name="insert" id="insert" value="Add Employee" class="btn btn-danger btn-block">
           </div>
        </form>
        </div> 
      </div>
    </div>
  </div>

 <!-- edit employee Modal -->
  <div class="modal fade" id="editModal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Edit Employee</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body px-4">  
        <form action="" method="post" id="edit-form-data">
          <input type="hidden" name="id" id="id">
          <div class="form-group">
            <input type="text" name="fname" class="form-control" id="fname" required> 
          </div>
          <div class="form-group">
            <input type="email" name="email" class="form-control" id="email" required> 
          </div>
          <div class="form-group">
            <input type="tel" name="phone" class="form-control" id="phone" required> 
          </div>
        <!--  <div class="form-group">
            <input type="password" name="password" class="form-control" id="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required> 
          </div> -->

            <div class="form-group">
            <span style="max-width: 100%;"></span>
            <select class="selectpicker form-control" name="department" id="department">
            <?php foreach($dept as $row): ?>
            <option value="<?= $row['Department']; ?>"><?= $row['Department']; ?></option>
            <?php endforeach; ?>
            </select>
          </div>

            <div class="form-group">
            <span style="max-width: 100%;"></span>
            <select class="selectpicker form-control" name="designation" id="designation">
            <?php foreach($desg as $row): ?>
            <option value="<?= $row['designation']; ?>"><?= $row['designation']; ?></option>
            <?php endforeach; ?>
            </select>
            </div>

            <div class="form-group">
            <label>Joining Date</label>
            <input type="date" value="<?php echo date('Y-m-d'); ?>" name="joiningdate" class="form-control" id="joiningdate" required> 
            </div>

            <div class="form-group">
            <label>Date of Birth</label>
            <input type="date" value="<?php echo date('Y-m-d'); ?>" name="dob" class="form-control" id="dob" required> 
            </div>

            <div class="form-group">
            <input type="text" name="gender" class="form-control" id="gender" required> 
            </div>
            <div class="form-group">
            <input type="text" name="address" class="form-control" id="address" required> 
            </div>
            <div class="form-group">
            <input type="text" name="city" class="form-control" id="city" required> 
            </div>
            <div class="form-group">
            <input type="text" name="country" class="form-control" id="country" required> 
            </div>
            <div class="form-group">
            <input type="submit" name="update" id="update" value="Update Employee" class="btn btn-primary btn-block">
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

    showAllUsers();

    function showAllUsers(){
      $.ajax({
        url: "action.php",
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

    //insert ajax request
    $("#insert").click(function(e){
      if($("#form-data")[0].checkValidity()){
        e.preventDefault();
        $.ajax({
          url: "action.php",
          type: "POST",
          data: $("#form-data").serialize()+"&action=insert",
          success:function(response){
           // console.log("JSON", response)
            Swal.fire({
              title: 'Employee added successfully!',
              type: 'success'
            })
               
            $('#addModal').modal('hide');
              $("#addModal .close").click();
              $("#form-data")[0].reset();
            showAllUsers();
          }
        });
      }
    });


    //Edit Employee
    $("body").on("click", ".editBtn", function(e){
      e.preventDefault();
      edit_id = $(this).attr('id');
      $.ajax({
        url:"action.php",
        type:"POST",
        data:{edit_id:edit_id},
          success:function(response){
             // console.log(" response === ",response);
            data = JSON.parse(response);
              //console.log(data);
              // if (data[0]) {
              //   data = data[0]
              // }
           $("#id").val(data[0].id);
           $("#fname").val(data[0].full_name);
           $("#email").val(data[0].email);
           $("#phone").val(data[0].phone);
           $("#password").val(data[0].password);
          // $("#department").val(data[0].department);
           $("#designation").val(data[0].designation);
           $("#joiningdate").val(data[0].joiningdate);
            $("#dob").val(data[0].dob);
           $("#gender").val(data[0].gender);
           $("#address").val(data[0].address);
           $("#city").val(data[0].city);
           $("#country").val(data[0].country);
          }
      });
    });  

     //update ajax request
    $("#update").click(function(e){
      if($("#edit-form-data")[0].checkValidity()){
        e.preventDefault();
        $.ajax({
          url: "action.php",
          type: "POST",
          data: $("#edit-form-data").serialize()+"&action=update",
          success:function(response){
            Swal.fire({
              title: 'Employee updated successfully!',
              type:'success'
            })   
              $('#editModal').modal('hide');
              $("#editModal .close").click();
              $("#edit-form-data")[0].reset();
              showAllUsers();
          }
        });
      }
    });

    //Delete ajax request
    $("body").on("click", ".delBtn", function(e){
      e.preventDefault();
      var tr = $(this).closest('tr');
      del_id = $(this).attr('id');
      Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result.value) {
    $.ajax({
      url:"action.php",
      type:"POST",
      data:{del_id:del_id},
      success:function(response){
        tr.css('background-color','#ff6666');
        Swal.fire(
          'Deleted!',
          'Employee deleted successfully!',
          'success'
          )
        showAllUsers();
      }
    });
  }
    });
  }); 
  //show user detailss
  $("body").on("click", ".infoBtn", function(e){
    e.preventDefault();
    info_id = $(this).attr('id');
    console.log("ID data ",info_id)
    $.ajax({
      url:"action.php",
      type:"POST",
      data:{info_id:info_id},
      success:function(response){
        data = JSON.parse(response);
        Swal.fire({
          title:'<strong>Employee Info :ID('+data[0].id+')</strong>',
          type: 'info',
          html: '<b>Full Name :</b>'+data[0].full_name+'<br><b>Email : </b>'+data[0].email+'<br><b>Phone : </b>'+data[0].phone+'<br><b>Department : </b>'+data[0].department+'<br><b>Designation : </b>'+data[0].designation+'<br><b>Joining Date : </b>'+data[0].joiningdate+'<br><b>Date of Birth : </b>'+data[0].dob+'<br><b>Address : </b>'+data[0].address+'<br><b>City : </b>'+data[0].city+'<br><b>Country : </b>'+data[0].country,
          showCancelButton: true,
        });
      }
    });
  });
  });
</script>
</body>
</html>