<!-- connect file -->
<?php
    include('includes/connect.php');
    include('functions/common_function.php');
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
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <!-- JavaScript link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


    <div class="container-fluid p-0">

    <!-- Navbar first child -->
    <nav class="navbar navbar-expand-lg">
  <div class="container-fluid">
    <a class="navbar-brand">
        <img src="./images/shopBg.png" alt="shop" class="logo">
    </a> 
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active text-light" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="display_all.php">Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="./user_area/user_registration.php">Register</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="#">Contact</a>
        </li>
        <li class="nav-item">
        <a class="nav-link text-light" href="cart.php">
        <img src="./images/cart.png" alt="cartimg" class="logo"><sup> <?php cart_item();?> </sup>
        </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="#">Total Price</a>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-light" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>

<!-- navbar second child -->
<nav class="navbar navbar-expand-lg navbar-dark nav-style">
    <ul class="navbar-nav me-auto">
        <li class="nav-item">
            <a class="nav-link text-tertiary" href="#">Welcome User</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Login</a>
        </li>
    </ul>
</nav>

<!-- third child -->
<div class="bg-style">
    <h3 class="text-center">ShopTech</h3>
    <p class="text-center"><b> Explore the Future of Tech </b></p>
</div>
<br/>
</div>

<!-- Products fourth child -->
<div class="row">

<?php
cart_item();
cart();
getProducts();
get_unique_categories();
get_unique_brands();
?>
    
<div class="col-md-2">
<ul class="navbar-nav me-auto">
  <!-- brands -->
        <li class="nav-item  bg-style">
            <a class="nav-link text-dark" href="#">Brands</a>
        </li>

        <?php
       getBrands();
        ?>

<!-- categories -->
        <li class="nav-item  bg-style">
            <a class="nav-link text-dark" href="#">Categories</a>
        </li>

        <?php
        getCategories();
        ?>

    </ul>
</div>

<?php
include("./includes/footer.php")
?>

    </div>

</body>
</html>