<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
  </head>
  <body style="background-color:#3498DB;color:white;padding-top:100px;text-align:center;">
    <h3>Your Prescription has been uploaded!</h3><br><br>
    <a href="admin-login-doc.php" class="btn btn-outline-light">Return to Dashboard</a>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
  </body>
</html>
<?php
include("func.php");
if(isset($_POST['entry_submit']))
{
    
    $username = $_SESSION['username'];
    $q = "select id from doc_details where Username='$username'";
    $r = mysqli_query($con, $q);
    $row=mysqli_fetch_array($r);
    
    $did=$row['id'];
    $pid=$_POST['pid'];
    $dis=$_POST['dis'];
    $med=$_POST['med'];
    $or=$_POST['or'];
    
    $q = "select current_timestamp() as ts";
    $r = mysqli_query($con, $q);
    $row = mysqli_fetch_array($r);
    $timestamp = $row['ts'];
    
    $dis_arr = explode (",", $dis);
    $n = count($dis_arr);
    while($n > 0)
    {
        $n = $n - 1;
        $q = "insert into diseases values('$timestamp','$dis_arr[$n]')";
        $r = mysqli_query($con, $q);
    }
    
    $med_arr = explode (",", $med);
    $n1 = count($med_arr);
    while($n1 > 0)
    {
        $n1 = $n1 - 1;
        $q1 = "insert into medicines values('$timestamp','$med_arr[$n1]')";
        $r1 = mysqli_query($con, $q1);
    }
    
    $query="insert into events values ('$timestamp','$did','$pid','$dis','$med','$or')";
    $result=mysqli_query($con,$query);
    if($result)
    header("Location:appointment.php");
}
?>