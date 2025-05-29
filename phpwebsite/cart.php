<!-- connect file -->
<?php
    include('includes/connect.php');
    include('functions/common_function.php');
    session_start();
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

    <style>
        .cart-img
        {
            width: 80px;
            height: 80px;
            object-fit: contain;
        }

        .table-bg
        {
            background-color: black;
        }
        .table-heading-bg
        {
            background-color: black;
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
      </ul>
    </div>
  </div>
</nav>


<!-- calling cart function -->
<?php
cart();
?>

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
          <a class='nav-link' href='./user_area/user_login.php'>Login</a>
      </li>";
        }

        else{
          echo "<li class='nav-item'>
          <a class='nav-link' href='./user_area/logout.php'>Logout</a>
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
<div class="container">
    <div class="row">
    <form action="" method="post">
        <table class="table table-bordered text-center text-white table-bg">
            <!-- <thead class="table-heading-bg">
                <tr>
                    <th>Product title</th>
                    <th>Product image</th>
                    <th>Quantity</th>
                    <th>Total price</th>
                    <th>Remove</th>
                    <th colspan="2">Operations</th>
                </tr>
            </thead> -->

            <tbody>

            <?php
global $conn;
$get_ip_add = getIPAddress();
$total = 0;
$cart_query = "SELECT * FROM `cart_details` WHERE ip_address='$get_ip_add'";
$result = mysqli_query($conn, $cart_query);
$result_count = mysqli_num_rows($result);
if($result_count > 0)
{
    echo "<thead>
    <tr>
        <th>Product title</th>
        <th>Product image</th>
        <th>Quantity</th>
        <th>Total price</th>
        <th>Remove</th>
        <th colspan='2'>Operations</th>
    </tr>
</thead>";

while ($row = mysqli_fetch_array($result)) {
    $product_id = $row['product_id'];
    $select_products = "SELECT * FROM `products` WHERE product_id='$product_id'";
    $result_products = mysqli_query($conn, $select_products);

    while ($row_product_price = mysqli_fetch_array($result_products)) {
        $product_price_table=array($row_product_price['product_price']);
        $product_title = $row_product_price['product_title'];
        $product_image1 = $row_product_price['product_image1'];
        $product_price = $row_product_price['product_price'];
        $product_values=array_sum($product_price_table);
        $total += $product_values;
        ?>
        
        <tr>
            <td><?php echo $product_title ?></td>
            <td><img src="./images/<?php echo $product_image1 ?>" alt="shopping" class="cart-img"></td>
            <td><input type="text" name="qty" id="" class="form-input w-50"></td>

            <?php

            $get_ip_add = getIPAddress();
            if(isset($_POST['update_cart']))
            {
                $quantities = $_POST['qty'];
                $update_cart = "UPDATE `cart_details` SET quantity=$quantities WHERE ip_address='$get_ip_add'";
                $result_products_quantity = mysqli_query($conn, $update_cart);
                $total = $total * $quantities;
            }
            ?>

            <td><?php echo $product_price  ?>/-</td>
            
            <td><input type="checkbox" name="removeitem[]" value="<?php echo $product_id ?>"></td>
            <td>
                <!-- <button class="bg-style px-3 py-2 border-0 mx-3">Update</button> -->
                <input type="submit" value="Update" class="bg-style px-3 py-2 border-0 mx-3" name="update_cart">
                <!-- <button class="bg-style px-3 py-2 border-0 mx-3">Remove</button> -->
                <input type="submit" value="Remove" class="bg-style px-3 py-2 border-0 mx-3" name="remove_cart">
            </td>
        </tr>
        
<?php
    }
}
}
else
{
    echo "<h2 class='text-center text-danger'> Cart is empty </h2>";
}
?>


            </tbody>
        </table>

        <!-- subtotal -->
        <div class="d-flex mb-5">
             <?php

$get_ip_add = getIPAddress();
$cart_query = "SELECT * FROM `cart_details` WHERE ip_address='$get_ip_add'";
$result = mysqli_query($conn, $cart_query);
$result_count = mysqli_num_rows($result);
if($result_count > 0)
{
    echo " <h4 class='px-3 mb-5 mt-4 text-white'>Subtotal: <strong class='text-info'> $total/-</strong></h4>
    <form>
    <a href='index.php'>
        <input type='submit' value='Continue Shopping' class='bg-style px-3 py-2 border-0 mx-3 mt-4' name='continue_shopping'>
    </a>
    
    <a href='./user_area/checkout.php'>
    <input type='button' class='bg-style p-3 py-2 border-0 mt-4' value='Checkout'>
    </a>
    </form>
    ";
}
else
{
    echo " <a href='index.php'>
    <input type='submit' value='Continue Shopping' class='bg-style px-3 py-2 border-0 mx-3 mt-4' name='continue_shopping'>
</a>";
}

if(isset($_POST['continue_shopping']))
{
    echo "<script>window.open('index.php', '_self')</script>";
}

?> 
            
        </div>
    </div>
</div>

</form>
<!-- function to remove item -->
<?php
function remove_cart_item()
{
    global $conn;
    if(isset($_POST['remove_cart']))
    {
        foreach($_POST['removeitem'] as $remove_id)
        {
            echo $remove_id;
            $delete_query = "DELETE FROM `cart_details` WHERE product_id=$remove_id";
            $run_delete = mysqli_query($conn, $delete_query);
            if($run_delete)
            {
                echo "<script>window.open('cart.php', '_self')</script>";
            }
        }
    }
}
// echo $remove_item = remove_cart_item();
remove_cart_item();
?>


<!-- last child -->
<?php
include("./includes/footer.php")
?>


</body>
</html>