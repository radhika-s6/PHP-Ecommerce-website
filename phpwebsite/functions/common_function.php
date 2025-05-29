<?php

// including connect file
// include('./includes/connect.php');


// search products
function search_product()
{

  
    // global variable
    global $conn;
    // condition to check issset or not
    if(isset($_GET['search_data_product']))
    {
      $search_data_value = $_GET['search_data'];


    $search_query = "SELECT * FROM `products` WHERE product_keywords LIKE '%$search_data_value%'";
$result_query = mysqli_query($conn, $search_query);
$num_of_rows = mysqli_num_rows($result_query);
if($num_of_rows == 0){
  echo "<h2 class='text-center text-danger'>No results match. No products found on this category!</h2>";
}

while($row=mysqli_fetch_assoc($result_query))
{
  $product_id = $row['product_id'];
  $product_title = $row['product_title'];
  $product_description = $row['product_description'];
  $product_image1 = $row['product_image1'];
  $product_price = $row['product_price'];
  $category_id = $row['product_category'];
  $brand_id = $row['product_brand'];

echo "<div class='col-md-4 mb-2'>
<div class='card'style='width:15rem;'>
<img src='./admin_area/product_image/$product_image1' class='card-img-top' alt='$product_title'>
<div class='card-body'>
  <h5 class='card-title'>$product_title</h5>
  <p class='card-text'>$product_description</p>
  <p class='card-text'>Price: $product_price/-</p>
  <a href='index.php?add_to_cart=$product_id' class='btn bg-style'>Add to cart</a>
  <a href='product_detail.php?product_id=$product_id' class='btn bg-style'>View item</a>
</div>
</div></div>";
        }
    }

  }


  function get_all_products()
  {
    
       // global variable
        global $conn;
    // condition to check issset or not
    if(!isset($_GET['category'])) {
        if(!isset($_GET['brand'])) {


            $select_query = "SELECT * FROM `products` ORDER BY rand()";
            $result_query = mysqli_query($conn, $select_query);

            while($row=mysqli_fetch_assoc($result_query)) {
                $product_id = $row['product_id'];
                $product_title = $row['product_title'];
                $product_description = $row['product_description'];
                $product_image1 = $row['product_image1'];
                $product_price = $row['product_price'];
                $category_id = $row['product_category'];
                $brand_id = $row['product_brand'];

                echo "<div class='col-md-4 mb-2'>
  <div class='card'style='width:15rem;'>
  <img src='./admin_area/product_image/$product_image1' class='card-img-top myimage' alt='$product_title'>
  <div class='card-body'>
    <h5 class='card-title'>$product_title</h5>
    <p class='card-text'>$product_description</p>
    <p class='card-text'>Price: $product_price/-</p>
    <a href='index.php?add_to_cart=$product_id' class='btn bg-style'>Add to cart</a>
    <a href='product_detail.php?product_id=$product_id' class='btn bg-style'>View item</a>
  </div>
  </div></div>";
            }
        }
    }
}


// getting products
function getProducts()
{



    // global variable
    global $conn;
    // condition to check issset or not
    if(!isset($_GET['category'])) 
    {
        if(!isset($_GET['brand'])) 
        {

            $select_query = "SELECT * FROM `products` ORDER BY rand() LIMIT 0,2";
            $result_query = mysqli_query($conn, $select_query);

            while($row=mysqli_fetch_assoc($result_query)) {
                $product_id = $row['product_id'];
                $product_title = $row['product_title'];
                $product_description = $row['product_description'];
                $product_image1 = $row['product_image1'];
                $product_price = $row['product_price'];
                $category_id = $row['product_category'];
                $brand_id = $row['product_brand'];

                echo "<div class='col-md-4 mb-2'>
                <div class='card'style='width:15rem;'>
                    <img src='./admin_area/product_image/$product_image1' class='card-img-top' alt='$product_title'>
                    <div class='card-body'>
                   <h5 class='card-title'>$product_title</h5>
                         <p class='card-text'>$product_description</p>
                         <p class='card-text'>Price: $product_price/-</p>
                         <a href='index.php?add_to_cart=$product_id' class='btn bg-style'>Add to cart</a>
                         <a href='product_detail.php?product_id=$product_id' class='btn bg-style'>View item</a>
                     </div>
                     </div>
               </div>";
            }
        }
    }
}

// getting unique categories
function get_unique_categories()
{
    global $conn;
    // condition to check isset or not
    if(isset($_GET['category'])) {
        $category_id = $_GET['category'];
        $select_query = "SELECT * FROM `products` WHERE product_category=$category_id";
        $result_query = mysqli_query($conn, $select_query);
        $num_of_rows = mysqli_num_rows($result_query);

        if($num_of_rows==0) {
            echo "<h2 class='text-center text-danger'> No stock for this category </h2>";
        }
         else
         {
        while($row=mysqli_fetch_assoc($result_query)) {
            $product_id = $row['product_id'];
            $product_title = $row['product_title'];
            $product_description = $row['product_description'];
            $product_image1 = $row['product_image1'];
            $product_price = $row['product_price'];
            $category_id = $row['product_category'];
            $brand_id = $row['product_brand'];

            echo "<div class='col-md-4 mb-2'>
            <div class='card'style='width:15rem;'>
    <img src='./admin_area/product_image/$product_image1' class='card-img-top' alt='$product_title'>
    <div class='card-body'>
      <h5 class='card-title'>$product_title</h5>
      <p class='card-text'>$product_description</p>
      <p class='card-text'>Price: $product_price/-</p>
      <a href='index.php?add_to_cart=$product_id' class='btn bg-style'>Add to cart</a>
      <a href='product_detail.php?product_id=$product_id' class='btn bg-style'>View item</a>
    </div>
    </div></div>";
        }
    }
}
}

// getting unique brands
function get_unique_brands()
{
    global $conn;
    // condition to check isset or not
if(isset($_GET['brand'])) 
{
    $brand_id = $_GET['brand'];
    $select_query = "SELECT * FROM `products` WHERE product_brand=$brand_id";
    $result_set = mysqli_query($conn,$select_query);
    $num_of_rows=mysqli_num_rows($result_set);
    

    if($num_of_rows==0) {
        echo "<h2 class='text-center text-danger'> This brand is not available for service </h2>";
    } else {
        while($row=mysqli_fetch_assoc($result_set)) {
            $product_id = $row['product_id'];
            $product_title = $row['product_title'];
            $product_description = $row['product_description'];
            $product_image1 = $row['product_image1'];
            $product_price = $row['product_price'];
            $category_id = $row['product_category'];
            $brand_id = $row['product_brand'];

            echo "<div class='col-md-4 mb-2'>
            <div class='card'style='width:15rem;'>
    <img src='./admin_area/product_image/$product_image1' class='card-img-top' alt='$product_title'>
    <div class='card-body'>
      <h5 class='card-title'>$product_title</h5>
      <p class='card-text'>$product_description</p>
      <p class='card-text'>Price: $product_price/-</p>
      <a href='index.php?add_to_cart=$product_id' class='btn bg-style'>Add to cart</a>
      <a href='product_detail.php?product_id=$product_id' class='btn bg-style'>View item</a>
    </div>
    </div></div>";
        }
    }
}
}


// Displaying brands in sidenav
function getBrands()
{
    global $conn;

    $select_brands = "SELECT * FROM `brands`";
        $result_brands = mysqli_query($conn, $select_brands);

        while($row_data = mysqli_fetch_assoc($result_brands))
        {
          $brand_title = $row_data['brand_title'];
          $brand_id = $row_data['brand_id'];
          echo "<li class='nav-item'>
          <a href='index.php?brand=$brand_id' class='nav-link text-light'> $brand_title </a>
          </li>";
        }
}


// Displaying categories in sidenav
function getCategories()
{
    global $conn;

    $select_categories = "SELECT * FROM `categories`";
        $result_categories = mysqli_query($conn, $select_categories);

        while($row_data = mysqli_fetch_assoc($result_categories))
        {
          $category_title = $row_data['category_title'];
          $category_id = $row_data['category_id'];
          echo "<li class='nav-item'>
          <a href='index.php?category=$category_id' class='nav-link text-light'> $category_title </a>
          </li>";
        }
}

// function for view more button
function view_details()
{
    global $conn;
    // condition to check issset or not
    if(isset($_GET['product_id'])){
    if(!isset($_GET['category'])) {
        if(!isset($_GET['brand'])) {
            $product_id=$_GET['product_id'];

            $select_query = "SELECT * FROM `products` WHERE product_id=$product_id";
            $result_query = mysqli_query($conn, $select_query);

            while($row=mysqli_fetch_assoc($result_query)) {
                $product_id = $row['product_id'];
                $product_title = $row['product_title'];
                $product_description = $row['product_description'];
                $product_image1 = $row['product_image1'];
                $product_image2 = $row['product_image2'];
                $product_price = $row['product_price'];
                $category_id = $row['product_category'];
                $brand_id = $row['product_brand'];

                echo "<div class='col-md-4 mb-2'>
  <div class='card'  style='width:15rem;'>
  <img src='./admin_area/product_image/$product_image1' class='card-img-top myimage' alt='$product_title'>
  <div class='card-body'>
    <h5 class='card-title'>$product_title</h5>
    <p class='card-text'>$product_description</p>
    <p class='card-text'>Price: $product_price/-</p>
    <a href='index.php?add_to_cart=$product_id' class='btn bg-style'>Add to cart</a>
    <a href='index.php' class='btn bg-style'>Go home</a>
  </div>
  </div></div>
  
  <div class='col-md-8'>
  <div class='row'>
  <div class='col-md-12'>
  <h4 class='text-center text-info mb-5'> Related images </h4>
  </div>
  <div class='col-md-6'>
  <img src='./admin_area/product_image/$product_image1' class='card-img-top' alt='image1'>
  </div>
  <div class='col-md-6'>
  <img src='./admin_area/product_image/$product_image2' class='card-img-top' alt='image2'>
  </div>
  </div></div>
  ";
            }
        }
    }
}
}


// get ip address function
function getIPAddress() {  
    //whether ip is from the share internet  
     if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
                $ip = $_SERVER['HTTP_CLIENT_IP'];  
        }  
    //whether ip is from the proxy  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
     }  
//whether ip is from the remote address  
    else{  
             $ip = $_SERVER['REMOTE_ADDR'];  
     }  
     return $ip;  
}  
// // function calling
// $ip = getIPAddress();  
// echo 'User Real IP Address - '.$ip;  


function cart()
{
    if(isset($_GET['add_to_cart']))
    {
        global $conn;
        $get_ip_add = getIPAddress();
        $get_product_id = $_GET['add_to_cart'];
        $select_query = "SELECT * FROM `cart_details` WHERE ip_address='$get_ip_add' AND product_id=$get_product_id";
        $result_query = mysqli_query($conn, $select_query);
        $num_of_rows = mysqli_num_rows($result_query);

        if($num_of_rows > 0)
        {
            echo "<script>alert('This item is already present inside the cart')</script>";
            echo "<script>window.open('index.php', '_self')</script>";
        }
        else
        {
            $insert_query = "INSERT INTO `cart_details` (product_id, ip_address, quantity) VALUES ('$get_product_id', '$get_ip_add', 0)";
            $result_query = mysqli_query($conn, $insert_query);
            echo "<script>alert('Item is added to the cart')</script>";
            echo "<script>window.open('index.php', '_self')</script>";
        }
    }
}


// function to get cart item numbers
function cart_item()
{
    if(isset($_GET['add_to_cart']))
    {
        global $conn;
        $get_ip_add = getIPAddress();
        $select_query = "SELECT * FROM `cart_details` WHERE ip_address='$get_ip_add'";
        $result_query = mysqli_query($conn, $select_query);
        $count_cart_items = mysqli_num_rows($result_query);
    }
    else
    {
        global $conn;
        $get_ip_add = getIPAddress();
        $select_query = "SELECT * FROM `cart_details` WHERE ip_address='$get_ip_add'";
        $result_query = mysqli_query($conn, $select_query);
        $count_cart_items = mysqli_num_rows($result_query);
    }
    echo $count_cart_items;
}


// total price function
function total_cart_price()
{
    global $conn;
    $get_ip_add = getIPAddress();
    $total = 0;
    $cart_query = "SELECT * FROM `cart_details` WHERE ip_address='$get_ip_add'";
    $result = mysqli_query($conn, $cart_query);
    while($row = mysqli_fetch_array($result))
    {
        $product_id = $row['product_id'];
        $select_products = "SELECT * FROM `products` WHERE product_id='$product_id'";
        $result_products = mysqli_query($conn, $select_products);

        while($row_product_price = mysqli_fetch_array($result_products))
        {
            $product_price = array($row_product_price['product_price']);
            $product_values = array_sum($product_price);
            $total+=$product_values;
        }
    }
    echo $total;
}


// get user order details
function get_user_order_details()
{
    global $conn;
    $username = $_SESSION['username'];
    $get_details = "SELECT * FROM `user` WHERE username='$username'";
    $result_query = mysqli_query($conn, $get_details);
    while($row_query = mysqli_fetch_array($result_query))
    {
        $user_id = $row_query['user_id'];
        if(!isset($_GET['edit_account']))
        {
            if(!isset($_GET['my_orders']))
            {
                if(!isset($_GET['delete_account']))
                {
                    $get_orders = "SELECT * FROM `user_orders` WHERE user_id='$user_id' AND order_status='pending'";
                    $result_orders_query = mysqli_query($conn, $get_orders);
                    $row_count = mysqli_num_rows($result_orders_query);

                    if($row_count > 0){
                        echo "<h3 class='text-center mt-5 mb-2'> You have <span class='text-danger'>$row_count</span> pending orders </h3><p class='text-center'><a href='profile.php?my_orders' class='text-dark'> Order details </a></p>";
                    }
                    else{
                        echo "<h3 class='text-center mt-5 mb-2'> You have zero pending orders </h3><p class='text-center'><a href='../index.php' class='text-dark'> Explore products </a></p>";
                    }
                }
            }
        }
    }
}

?>