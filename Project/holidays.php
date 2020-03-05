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
$dept = $data->GetHolidays();
if(isset($_POST['insert'])){
  $hname = $_POST['hname'];
  $fromdate = $_POST['fromdate'];
  $todate = $_POST['todate'];
  if($fromdate > $todate){
    echo '<script language="javascript">';
    echo 'alert("ToDate should be greater than FromDate")';
    echo '</script>';
  }else
  {
  $data->insertHoliday($hname,$fromdate,$todate);
  header('location:holidays.php');
}
}
if(isset($_POST['update'])){
$id = $_POST['id'];
$hname = $_POST['hname'];
$fromdate = $_POST['fromdate'];
$todate = $_POST['todate'];
if($fromdate > $todate){
  echo '<script language="javascript">';
  echo 'alert("ToDate should be greater than FromDate")';
  echo '</script>';
}else
{
$data->updateHoliday($id,$hname,$fromdate,$todate);
header('location:holidays.php');
}
}
?>
<!DOCTYPE html>
<html>
<head>
<title>employee management system</title> 
 <script type='text/javascript' src='http://code.jquery.com/jquery-1.9.1.js'></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.css"/>
<script type="text/javascript">
 $(window).load(function(){
 $('input#insert').prop('disabled', true);
 });
</script>
<script>
function checkHoliAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'holidayid='+$("#holidayid").val(),
type: "POST",
success:function(data){
$("#holiday-availability-status").html(data);
 if(data.includes("green"))
  {
    $('input#insert').prop('disabled', false);
  }
  else
  {
    $('input#insert').prop('disabled', true) 
  }
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>
</head>
<body>
<div class="container">
  <div class="row">
    <div class="col-lg-12">
    <h4 class="text-center mt-2 text-primary">Holiday List</h4>
     
    </div>
  </div>
  <div class="row">
     <div class="col-lg-6">
      <button type="button" class="btn btn-primary m-1 float-right" data-toggle="modal" data-target="#addModal" ><i class="glyphicon glyphicon-th-list"></i>&nbsp;&nbsp;Add New Holiday</button>
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
          <h4 class="modal-title">Add New Holiday </h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body px-4">
        <form action="" method="post" id="form-data">
            <div class="form-group">
             <label>From Date</label>
            <input type="date" value="<?php echo date('Y-m-d'); ?>" name="fromdate" class="form-control"  min="<?php echo date('Y-m-d'); ?>" required> 
          </div>

            <div class="form-group">
             <label>To Date</label>
            <input type="date" value="<?php echo date('Y-m-d'); ?>" name="todate" class="form-control" min="<?php echo date('Y-m-d'); ?>" required> 
          </div>

          <div class="form-group">
            <input type="text" name="hname" class="form-control" placeholder="Holiday Description" id="holidayid" onBlur="checkHoliAvailability()"required> 
            <span id="holiday-availability-status"></span>
          </div>
          <div class="form-group">
            <input type="submit" name="insert" id="insert" value="Add Holiday" class="btn btn-danger btn-block"> 
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
          <h4 class="modal-title">Edit Holiday</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body px-4">  
        <form action="" method="post" id="edit-form-data">
          <input type="hidden" name="id" id="id">

          <div class="form-group">
             <label>From Date</label>
            <input type="date" value="<?php echo date('Y-m-d'); ?>" name="fromdate" id="fromdate" class="form-control"  min="<?php echo date('Y-m-d'); ?>" required> 
          </div>

            <div class="form-group">
             <label>To Date</label>
            <input type="date" value="<?php echo date('Y-m-d'); ?>" name="todate" id="todate" class="form-control" min="<?php echo date('Y-m-d'); ?>" required> 
          </div>

          <div class="form-group">
            <input type="text" name="hname" class="form-control" id="hname" required> 
          </div>
            <div class="form-group">
            <input type="submit" name="update" id="update" value="Update holoday" class="btn btn-primary btn-block">
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

    showAllHoliday();

    function showAllHoliday(){
      $.ajax({
        url: "holidayAction.php",
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
  /*  $("#insert").click(function(e){
      if($("#form-data")[0].checkValidity()){
        e.preventDefault();
        $.ajax({
          url: "holidayAction.php",
          type: "POST",
          data: $("#form-data").serialize()+"&action=insert",
          success:function(response){
           // console.log("JSON", response)
            Swal.fire({
              title: 'Holiday added successfully!',
              type: 'success'
            })
               
            $('#addModal').modal('hide');
              $("#addModal .close").click();
              $("#form-data")[0].reset();
              showAllHoliday();
          }
        });
      }
    });*/

    //Edit Holiday
    $("body").on("click", ".editBtn", function(e){
      e.preventDefault();
      edit_id = $(this).attr('id');
      $.ajax({
        url:"holidayAction.php",
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
            $("#hname").val(data[0].holiday);
           $("#fromdate").val(data[0].fromdate);
            $("#todate").val(data[0].todate);
          }
      });
    });  

     //update ajax request
   /* $("#update").click(function(e){
      if($("#edit-form-data")[0].checkValidity()){
        e.preventDefault();
        $.ajax({
          url: "holidayAction.php",
          type: "POST",
          data: $("#edit-form-data").serialize()+"&action=update",
          success:function(response){
            Swal.fire({
              title: 'Holiday updated successfully!',
              type:'success'
            })   
              $('#editModal').modal('hide');
              $("#editModal .close").click();
              $("#edit-form-data")[0].reset();
              showAllHoliday();
          }
        });
      }
    });*/

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
      url:"holidayAction.php",
      type:"POST",
      data:{del_id:del_id},
      success:function(response){
        tr.css('background-color','#ff6666');
        Swal.fire(
          'Deleted!',
          'Holiday deleted successfully!',
          'success'
          )
          showAllHoliday();
      }
    });
  }
    });
  }); 
  //show Holiday details
  $("body").on("click", ".infoBtn", function(e){
    e.preventDefault();
    info_id = $(this).attr('id');
    console.log("ID data ",info_id)
    $.ajax({
      url:"holidayAction.php",
      type:"POST",
      data:{info_id:info_id},
      success:function(response){
        data = JSON.parse(response);
        Swal.fire({
          title:'<strong>Holiday Info :ID('+data[0].id+')</strong>',
          type: 'info',
          html: '<b>Holiday :</b>'+data[0].holiday+'<br><b>From Date : </b>'+data[0].fromdate+'<br><b>To Date : </b>'+data[0].todate,
          showCancelButton: true,
        });
      }
    });
  });
  });
</script>
</body>
</html>