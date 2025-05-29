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
</body>
</html>


<?php
include('../includes/connect.php');
include('../functions/common_function.php');

if(isset($_GET['user_id']))
{
    $user_id = $_GET['user_id'];
}

// getting total items and total price of all items
$get_ip_address = getIPAddress();
$total_price = 0;
$cart_query_price = "SELECT * FROM `cart_details` WHERE ip_address='$get_ip_address'";
$result_cart_price = mysqli_query($conn, $cart_query_price);

// mt_rand() - Generates a random integer using Mersenne Twister algorithm
$invoice_number = mt_rand();
$status = 'pending';
$count_products = mysqli_num_rows($result_cart_price);

// while loop will fetch the number of items ordered by the user
while($row_price = mysqli_fetch_array($result_cart_price))
{
    $product_id = $row_price['product_id'];
    $select_product = "SELECT * FROM `products` WHERE product_id='$product_id'";
    $run_price = mysqli_query($conn, $select_product);

    // fetching the price from products table
    while($row_product_price = mysqli_fetch_array($run_price))
    {
        $product_price = array($row_product_price['product_price']);
        $product_values = array_sum($product_price);
        $total_price += $product_values;
    }
}

// getting quantity from cart
$get_cart = "SELECT * FROM `cart_details`";
$run_cart = mysqli_query($conn, $get_cart);
$get_item_quantity = mysqli_fetch_array($run_cart);
$quantity = $get_item_quantity['quantity'];

if($quantity==0)
{
    $quantity = 1;
    $subtotal = $total_price;
}
else{
    $quantityy = $quantity;
    $subtotal = $total_price * $quantity;
}

$insert_orders = "INSERT INTO `user_orders` (user_id, amount_due, invoice_number, total_products, order_date, order_status) VALUES('$user_id', '$subtotal', '$invoice_number', '$count_products', NOW(), '$status')";
$result_query = mysqli_query($conn, $insert_orders);
if($result_query)
{
    echo "<script>alert('Orders are submitted successfully')</script>";
    echo "<script>window.open('profile.php', '_self')</script>";
}

$insert_pending_orders = "INSERT INTO `orders_pending` (user_id, invoice_number, product_id, quantity, order_status) VALUES('$user_id', '$invoice_number', '$product_id', '$quantity', '$status')";
$result_pending_orders = mysqli_query($conn, $insert_pending_orders);

// delete items from cart
$empty_cart = "DELETE FROM `cart_details` WHERE ip_address='$get_ip_address'";
$result_delete = mysqli_query($conn, $empty_cart);

?>