<?php
require 'conn.php';
// function for getting data from database
function get_all_data($conn){
    $get_data = mysqli_query($conn,"SELECT * FROM `users`");
    if(mysqli_num_rows($get_data) > 0){
        echo '<table>
              <tr>
                <th>name</th>
                <th>Email</th> 
                <th>Edit</th> 
                <th>Delete</th> 
              </tr>';
        while($row = mysqli_fetch_assoc($get_data)){
           
            echo '<tr>
            <td>'.$row['name'].'</td>
            <td>'.$row['email'].'</td>
            <td><a href="edit_user.php?id='.$row['id'].'">Edit</a>&nbsp;</td>
            <td><a href="delete_user.php?id='.$row['id'].'">Delete</a></td>
            </tr>';

        }
        echo '</table>';
    }else{
        echo "<h3>No records found. Please insert some records</h3>";
    }
}
?>
<!DOCTYPE html>
<html lang="">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Application</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">

        <!-- SHOW DATA -->
        <h2>Display Table All Data</h2>
        <?php include 'menu.php';?>
        <?php 
        // calling get_all_data function
        get_all_data($conn); 
        ?>
        <!-- END OF SHOW DATA SECTION -->
    </div>
</body>

</html>