<?php
include '../Components/_connect.php';


if(isset($_GET['deleteid'])){
    $id= $_GET['deleteid'];


    $sql ="delete from `ngoreg` where id =$id";

    $result = mysqli_query($con,$sql);
    if($result){
        header('location:admin.php');
    }else{
        die(mysqli_error($con));
    }
}



?>