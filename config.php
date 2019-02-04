<?php
    $connect = mysqli_connect('localhost','root','','react_image');

    if($connect->connect_errno)
    {
        echo '<div class="alert alert-danger bg-danger col-lg-6" role="alert">Database connection error.</div>';
    } 
?>