<?php include 'include/mainheader.php';
 ?>
<?php 
session_start();
if(strlen($_SESSION['uid'])=="")
{
  header('location:logout.php');
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
    <h4 class="text-center mt-2 text-primary">Leaves</h4>
     
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
        url: "actionLeavePending.php",
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

// Reject leave 
    $("body").on("click", ".RejectBtn", function(e){
      e.preventDefault();
      var tr = $(this).closest('tr');
      rej_id = $(this).attr('id');
      Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, reject it!'
}).then((result) => {
  if (result.value) {
    $.ajax({
      url:"actionLeavePending.php",
      type:"POST",
      data:{rej_id:rej_id},
      success:function(response){
        tr.css('background-color','#ff6666');
        Swal.fire(
          'Rejected!',
          'Leave Rejected successfully!',
          'success'
          )
        showAllUsers();
      }
    });
  }
    });
  }); 

// Accept leave 
    $("body").on("click", ".AcceptBtn", function(e){
      e.preventDefault();
      var tr = $(this).closest('tr');
      acc_id = $(this).attr('id');
      Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, Approve it!'
}).then((result) => {
  if (result.value) {
    $.ajax({
      url:"actionLeavePending.php",
      type:"POST",
      data:{acc_id:acc_id},
      success:function(response){
        tr.css('background-color','#ff6666');
        Swal.fire(
          'Approved!',
          'Leave has been approved successfully!',
          'success'
          )
        showAllUsers();
      }
    });
  }
    });
  });
  });
</script>
</body>
</html>