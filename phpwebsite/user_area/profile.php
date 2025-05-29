<!-- connect file -->
<?php
    include('../includes/connect.php');
    include('../functions/common_function.php');
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome <?php echo $_SESSION['username'] ?></title>
    <!-- bootstrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <!-- linking css file -->
    <link rel="stylesheet" href="../style.css">

    <style>
        body{
            overflow-x: hidden;     
        }
        .profile_image
{
    width: 90%;
    /* height: 100%; */
    margin: auto;
    display: block;
    object-fit: contain;
}
.edit_image
{
  width: 100px;
  height: 100px;
  object-fit: contain;
}
    </style>

</head>

<body>
    <!-- JavaScript link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


    <div class="container-fluid p-0">

    <!-- Navbar first child -->
    <nav class="navbar navbar-expand-lg">
  <div class="container-fluid">
    <a class="navbar-brand">
        <img src="../images/shopBg.png" alt="shop" class="logo">
    </a> 
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active text-light" aria-current="page" href="../index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="../display_all.php">Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="profile.php">My Account</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="#">Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="../cart.php">
          <img src="../images/cart.png" alt="cartimg" class="logo"><sup> <?php cart_item();?> </sup>
        </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="#">Total Price: <?php total_cart_price();?>/- </a>
        </li>
      </ul>
      <form class="d-flex" action="../Search_products.php"  method="get">
        <input type="search" class="form-control me-2" placeholder="Search" name="search_data"  aria-label="Search">
        <input type="submit" class="btn btn-outline-light" name="search_data_product" value="Search">
      </form>
    </div>
  </div>
</nav>


<!-- calling cart function -->

<!-- navbar second child -->
<nav class="navbar navbar-expand-lg navbar-dark nav-style">
    <ul class="navbar-nav me-auto">
        
    <?php

if(!isset($_SESSION['username']))
{
  echo "<li class='nav-item'>
            <a class='nav-link text-tertiary' href='#'>Welcome User</a>
        </li>";
}
else{
  echo "<li class='nav-item'>
  <a class='nav-link' href='#'>Welcome ".$_SESSION['username']."</a>
</li>";
}

        if(!isset($_SESSION['username']))
        {
          echo "<li class='nav-item'>
          <a class='nav-link' href='user_login.php'>Login</a>
      </li>";
        }

        else{
          echo "<li class='nav-item'>
          <a class='nav-link' href='logout.php'>Logout</a>
      </li>";
        }

        ?>
        
    </ul>
</nav>

<!-- third child -->
<div class="bg-style">
    <h3 class="text-center">ShopTech</h3>
    <p class="text-center"><b> Explore the Future of Tech </b></p>
</div>
<br/>
</div>

<!-- fourth child -->
<div class="row">
  <div class="col-md-2">
    <ul class="navbar-nav nav-style text-center" style="height:100vh">
    <li class="nav-item bg-style">
          <a class="nav-link text-light" href="#"><h4>Your Profile</h4></a>
    </li>

    <?php

    $username = $_SESSION['username'];
    $user_image = "SELECT * FROM `user` WHERE username='$username'";
    $user_image = mysqli_query($conn, $user_image);
    $row_image = mysqli_fetch_array($user_image);
    $user_image = $row_image['user_image'];
    echo "<li class='nav-item nav-style'>
    <img src='./user_images/$user_image' class='profile_image my-4' alt=''>
</li>";

    ?>

    <li class="nav-item nav-style">
          <a class="nav-link text-light" href="profile.php">Pending Orders</a>
    </li>
    <li class="nav-item nav-style">
          <a class="nav-link text-light" href="profile.php?edit_account">Edit Account</a>
    </li>
    <li class="nav-item nav-style">
          <a class="nav-link text-light" href="profile.php?my_orders">My Orders</a>
    </li>
    <li class="nav-item nav-style">
          <a class="nav-link text-light" href="profile.php?delete_account">Delete Account</a>
    </li>
    <li class="nav-item nav-style">
          <a class="nav-link text-light" href="logout.php">Logout</a>
    </li>
    </ul>
  </div>

  <div class="col-md-10 text-center">
    <?php get_user_order_details(); 
    if(isset($_GET['edit_account']))
    {
      include('edit_account.php');
    }
    
    if(isset($_GET['my_orders']))
    {
      include('user_orders.php');
    }

    if(isset($_GET['delete_account']))
    {
      include('delete_account.php');
    }
    ?>
  </div>
</div>

</div>


<?php
include("../includes/footer.php")
?>

    

</body>
</html>