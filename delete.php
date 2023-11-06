<?php
include 'connect.php';
if(isset($_GET['deleteid'])){
    $id=$_GET['deleteid'];
    $sql="DELETE from   `utilisateurs` where id=$id ";
    $result=mysqli_query($con,$sql);
    if($result){
       //echo"deleted successfully";
       header('location:user.php');  
    }
}

?>