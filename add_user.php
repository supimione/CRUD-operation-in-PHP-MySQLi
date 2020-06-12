<?php
require 'conn.php';

if(isset($_POST['name']) && isset($_POST['email'])){
    
    // check name and email empty or not
    if(!empty($_POST['name']) && !empty($_POST['email'])){
        
        // Escape special characters.
        $name = mysqli_real_escape_string($conn, htmlspecialchars($_POST['name']));
        $email = mysqli_real_escape_string($conn, htmlspecialchars($_POST['email']));
        
        //CHECK EMAIL IS VALID OR NOT
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            
            // CHECK IF EMAIL IS ALREADY INSERTED OR NOT
            $check_email = mysqli_query($conn, "SELECT `email` FROM `users` WHERE email = '$email'");
            
            if(mysqli_num_rows($check_email) > 0){    
                
                echo "<h3>This Email Address is already registered. Please Try another.</h3>";
                
            }else{
                
                // INSER USERS DATA INTO THE DATABASE
                $insert_query = mysqli_query($conn,"INSERT INTO `users`(`name`,`email`) VALUES('$name','$email')");

                //CHECK DATA INSERTED OR NOT
                if($insert_query){
                    echo "<script>
                    alert('User Added Successfully');
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
      
       <!-- INSERT DATA -->
        <div class="form">
            <h2>Add New User</h2>
            <?php include 'menu.php';?>
            <form action="add_user.php" method="post">
                <strong>name</strong><br>
                <input type="text" name="name" placeholder="Enter your full name" required><br><br>
                <strong>Email</strong><br>
                <input type="email" name="email" placeholder="Enter your email" required><br><br>
                <button type="submit" value="Submit" > Submit </button>
            </form>
        </div>
    </div>
</body>

</html>