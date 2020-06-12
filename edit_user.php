<?php
require 'conn.php';

if(isset($_GET['id']) && is_numeric($_GET['id'])){
    
    $id = $_GET['id'];
    $get_user = mysqli_query($conn,"SELECT * FROM `users` WHERE id='$id'");
    
    if(mysqli_num_rows($get_user) === 1){
        
        $row = mysqli_fetch_assoc($get_user);
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update data</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
     <div class="container">
      
       <!-- UPDATE DATA -->
        <div class="form">
            <h2>Update Data</h2>
            <form action="" method="post">
                <strong>name</strong><br>
                <input type="text" autocomplete="off" name="name" placeholder="Enter your full name" value="<?php echo $row['name'];?>" required><br>
                <strong>Email</strong><br>
                <input type="email" autocomplete="off" name="email" placeholder="Enter your email" value="<?php echo $row['email'];?>" required><br>
                <input type="submit" value="Update">
            </form>
        </div>
        <!-- END OF UPDATE DATA SECTION -->
    </div>
</body>
</html>
<?php

    }else{
        // set header response code
        http_response_code(404);
        echo "<h1>404 Page Not Found!</h1>";
    }
    
}else{
    // set header response code
    http_response_code(404);
    echo "<h1>404 Page Not Found!</h1>";
}

if(isset($_POST['name']) && isset($_POST['email'])){
    
    // check username and email empty or not
    if(!empty($_POST['name']) && !empty($_POST['email'])){
        
        // Escape special characters.
        $name = mysqli_real_escape_string($conn, htmlspecialchars($_POST['name']));
        $email = mysqli_real_escape_string($conn, htmlspecialchars($_POST['email']));
        
        //CHECK EMAIL IS VALID OR NOT
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $id = $_GET['id'];
            // CHECK IF EMAIL IS ALREADY INSERTED OR NOT
            $check_email = mysqli_query($conn, "SELECT `email` FROM `users` WHERE email = '$email' AND id != '$id'");
            
            if(mysqli_num_rows($check_email) > 0){    
                
                echo "<h3>This Email Address is already registered. Please Try another.</h3>";
                
                
            }else{
                
                // UPDATE USER DATA               
                $update_query = mysqli_query($conn,"UPDATE `users` SET name='$name',email='$email' WHERE id=$id");

                //CHECK DATA UPDATED OR NOT
                if($update_query){
                    echo "<script>
                    alert('User has been updated');
                    window.location.href = 'user_page.php';
                    </script>";
                    exit;
                }else{
                    echo "<h3>Opps something wrong!</h3>";
                }  
            }  
            
        }else{
            echo "Invalid email address. Please enter a valid email address";
        }
        
    }else{
        echo "<h4>Please fill all fields</h4>";
    }   
}

?>

