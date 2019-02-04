<?php
    require('config.php');

        $query = "DELETE from image";
        $results = mysqli_query($connect,$query);
        
        header('location:react_index.php');
        exit();
       
?>