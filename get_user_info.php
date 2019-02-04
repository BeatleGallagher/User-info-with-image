<?php
    require('config.php');

    $query = "SELECT * FROM image LIMIT 10";
    $result = mysqli_query($connect,$query);
    $row = $result->num_rows;
    if($row == 0)
    {
        echo "<table class='table table-hover' >";
        echo "<thead class='thead-dark'>";
        echo	"<tr>";
            echo     "<th>No database entries yet</th>";
        echo	"</tr>";
        echo "</thead>";
    } else 
    {
        
        echo "<table class='table table-hover' >";
        echo "<thead class='thead-dark'>";
            echo	"<tr>";
                echo     "<th>User</th><th scope='col'>Name</th><th>Email</th><th>Title</th><th>Description</th>";
            echo	"</tr>";
        echo "</thead>";

        while($row = mysqli_fetch_array($result))
        {
            echo "<tr scope='col'>";
            echo "<td>";
            echo     '<img width="100px" height="100px"  src="data:image/jpeg;base64,'.base64_encode($row['image']).'" />';
            echo "</td>";
            echo "<td>";
            echo    "<i>" . $row['name'] . "</i>";
            echo "</td>";
            echo "<td>";
            echo      "<i>" . $row['email'] . "</i>";
            echo "</td>";
            echo "<td>";
            echo     "<i>" .$row['title'] . "</i>";
            echo "</td>";
            echo "<td>";
            echo     "<i>" .$row['description'] . "</i>";;
            echo "</td>";
            
        
            echo "</tr>";
        } 
            echo "</table>"; 
            echo "<form action='delete.php' method='POST'>";
                echo "<input type='submit' id='delete_btn' name='delete_btn' class='btn btn-danger' value='delete'/>";
            echo "</form>";
    }

?>