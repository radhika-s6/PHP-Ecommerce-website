<?php
include('../includes/connect.php');
include('../functions/common_function.php');

if(isset($_POST['register_user']))
{
    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    $hash_password = password_hash($user_password, PASSWORD_DEFAULT);      //hashing 
    $confirm_password = $_POST['confirm_password'];
    $user_ip = getIPAddress();
    $user_address = $_POST['user_address'];
    $user_mobile = $_POST['user_mobile'];

    
            // select query
            $select_query = "SELECT * FROM `user` WHERE username='$username' or user_email='$user_email'";
            $result = mysqli_query($conn, $select_query);
            $rows_count = mysqli_num_rows($result);
    
            if($rows_count>0)
            {
                echo "<script>alert('Username and email already exist')</script>";
                
            }
    
    
        // check if passwords match
       else  if($user_password !== $confirm_password)
        {
            echo "<script>alert('Passwords do not match')</script>";
            
        }
        else{
        // Accessing the uploaded image
        $user_image = $_FILES['user_image']['name'];
        $temp_image = $_FILES['user_image']['tmp_name'];

        // Move the uploaded image to a desired location
        move_uploaded_file($temp_image, "./user_images/$user_image");
        // $destination = "./images/" . $user_image;
        // move_uploaded_file($temp_image, $destination);

        // Insert query
        $insert_user_details = "INSERT INTO `user` (username, user_email, user_password, confirm_password, user_ip, user_address, user_mobile, user_image) VALUES ('$username', '$user_email', '$hash_password', '$hash_password', '$user_ip', '$user_address', '$user_mobile', '$user_image')";
        $result_data = mysqli_query($conn, $insert_user_details);

        if($result_data)
        {
            echo "<script>alert('You have been registered successfully.')</script>";
        }
        else
        {
            echo "<script>alert('Error: Failed to register user.')</script>";
        }
        }


        // selecting cart items
        $select_cart_items = "SELECT * FROM `cart_details` WHERE ip_address='$user_ip'";
        $result_cart = mysqli_query($conn, $select_cart_items);
        $rows_count = mysqli_num_rows($result_cart);

        if($rows_count > 0)
        {
            $_SESSION['username'] = $username;
            echo "<script>alert('You have items in your cart')</script>";
            echo "<script>window.open('checkout.php', '_self')</script>";
        }
        else
        {
            echo "<script>window.open('../index.php', '_self')</script>";
        }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecommerce Website using PHP and MySQL</title>
    <!-- bootstrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <!-- linking css file -->
    <link rel="stylesheet" href="../style.css">

</head>

<body>
    <!-- JavaScript link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>


    <div class="container-fluid m-3 text-white">
        <h2 class="text-center">New User Registration</h2>
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-lg-12 col-xl-6">
                <form action="" method="post" enctype="multipart/form-data">

<!-- username-field -->
<div c1ass="form-outline mb-4 text-white">
<label for="username" class="form-label">Username</label>
<input type="text" id="username" class="form-control"
placeholder="Enter your username" autocomplete="off"
required="required" name="username"/>

</div>

<!-- email field -->

<div class="form-outline mb-4 text-white">
<label for="user_email" class="form-label">Email</label>
<input type="text" id="user_email" class="form-control"
placeholder="Enter your email" autocomplete="off"
required="required" name="user_email"/>

</div>

<!-- image field -->

<div class="form-outline mb-4 text-white">
<label for="user_image" class="form-label">Image</label>
<input type="file" id="user_image" class="form-control" required="required" name="user_image"/>

</div>

<!-- password field -->

<div class="form-outline mb-4 text-white">
<label for="user_password" class="form-label">Password</label>
<input type="password" id="user_password" class="form-control" placeholder="Enter your password" autocomplete="off" required="required" name="user_password"/>

</div>

<!-- confirm password field -->

<div class="form-outline mb-4 text-white">
<label for="confirm_password" class="form-label">Confirm Password</label>
<input type="password" id="confirm_password" class="form-control" placeholder="Enter your password" autocomplete="off" required="required" name="confirm_password"/>

</div>

<!-- Address field -->

<div class="form-outline mb-4 text-white">
<label for="user_address" class="form-label">Address</label>
<input type="text" id="user_address" class="form-control" placeholder="Enter your address" autocomplete="off" required="required" name="user_address"/>

</div>

<!-- Contact field -->
<div class="form-outline mb-4 text-white">
<label for="user_mobile" class="form-label">Contact</label>
<input type="text" id="user_mobile" class="form-control" placeholder="Enter your mobile number" autocomplete="off" required="required" name="user_mobile"/>

</div>

<div class="mt-4 pt-2 text-center text-white">
    <!-- register button -->
    <input type="submit" value="Register" class="bg-style py-2 px-3 border-0" name="register_user" />
    <!-- login button -->
    <p class="small fw-bold mt-3 pt-1 mb-0"> Already have an account?
        <a href="user_login.php" class="text-danger"> Login </a>
    </p>
</div>

                </form>
            </div>
        </div>
    </div>

</body>
</html>