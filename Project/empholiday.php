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
$data=new DB_con();
$dept = $data->GetHolidays();
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
        url: "empholidayaction.php",
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