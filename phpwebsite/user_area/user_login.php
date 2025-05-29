<!-- connect file -->
<?php
    include('../includes/connect.php');
    include('../functions/common_function.php');
    @session_start();  //@ - if this particular login page will be active only then the session will be started
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecommerce Website using PHP and MySQL</title>
    <!-- bootstrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <!-- linking css file -->
    <link rel="stylesheet" href="../style.css">


    <!-- css property to remove horizintal scroll bar at the bottom -->
    <style>
        body{
            overflow-x: hidden;     
        }
    </style>
 

</head>

<body>
    <!-- JavaScript link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <div class="container-fluid p-0">

  
    
    <div class="container-fluid m-3 text-white">
        <h2 class="text-center my-5">LOGIN</h2>
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-lg-12 col-xl-6">

                <form action="" method="post" enctype="multipart/form-data" class="mx-5">

<!-- username-field -->
<div class="form-outline mb-4 text-white">
<label for="username" class="form-label">Username</label>
<input type="text" id="username" class="form-control"
placeholder="Enter your username" autocomplete="off"
required="required" name="username"/>
</div>

<!-- password field -->

<div class="form-outline mb-4 text-white">
<label for="user_password" class="form-label">Password</label>
<input type="password" id="user_password" class="form-control" placeholder="Enter your password" autocomplete="off" required="required" name="user_password"/>
</div>

<div class="mt-4 pt-2 text-center text-white">
    <!-- register button -->

    <!-- <button class="bg-style py-2 px-3 border-0" name="user_login" ><a href="user_login.php">Login </a></button> -->
    <input type="submit" value="Login" class="bg-style py-2 px-3 border-0" name="user_login" />

    <!-- login button -->
    <p class="small fw-bold mt-3 pt-1 mb-4"> Already have an account?
        <a href="user_registration.php" class="text-danger"> Register </a>
    </p>
</div>;

                </form>
            </div>
        </div>
    </div>

</body>
</html>
<?php

if(isset($_POST['user_login']))
{
$username = $_POST['username'];
$user_password = $_POST['user_password'];

$select_query = "SELECT * FROM `user` WHERE username='$username'";
$result = mysqli_query($conn, $select_query);
$row_count =mysqli_num_rows($result);
$row_data = mysqli_fetch_assoc($result);
$user_ip = getIPAddress();

// cart item
$select_cart_query = "SELECT * FROM `cart_details` WHERE ip_address='$user_ip'";
$result_cart = mysqli_query($conn, $select_cart_query);
$row_count_cart = mysqli_num_rows($result_cart);

//if row count is greater than o then user is present
if($row_count>0)
{
    $_SESSION['username'] = $username;
    if(password_verify($user_password, $row_data['user_password']))
    {
        // echo "<script>alert('Login successful')</script>"; 
        if($row_count==1 and $row_count_cart==0)
        {
            $_SESSION['username'] = $username;
            echo "<script>alert('Login successful')</script>"; 
            echo "<script>window.open('profile.php','_self')</script>";
        }
        else{
            $_SESSION['username'] = $username;
            echo "<script>alert('Login successful')</script>"; 
            echo "<script>window.open('payment.php','_self')</script>";
        }
    }
    else{
        echo "<script>alert('Invalid credentials')</script>"; 
    }
}
else
{
    echo "<script>alert('Invalid credentials')</script>";
}
}

?>
