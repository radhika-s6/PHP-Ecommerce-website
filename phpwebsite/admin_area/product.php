<?php
include('../includes/connect.php');


if(isset($_POST['insert_product']))
{
  $product_title=$_POST['product_title'];
  $product_description=$_POST['product_description'];
  $product_keywords=$_POST['product_keywords'];
  $product_category=$_POST['product_category'];
  $product_brand=$_POST['product_brand'];
  $product_price=$_POST['product_price'];
  $product_status = "true";

  // accessing images
  $product_image1=$_FILES['product_image1']['name'];
  $product_image2=$_FILES['product_image2']['name'];

  // accessing image tmp name
  $temp_image1=$_FILES['product_image1']['tmp_name'];
  $temp_image2=$_FILES['product_image2']['tmp_name'];

// checking empty condition
if($product_title==' ' or $product_description==' ' or $product_keywords==' ' or $product_category==' ' or $product_brand==' ' or $product_price==' ' or $product_image1==' ' or $product_image2==' ')
{
  echo "<script>alert('Please fill all the available fields')</script>";
  exit();
}
else {
  move_uploaded_file($temp_image1, "./product_image/$product_image1");
  move_uploaded_file($temp_image2, "./product_image/$product_image2");

  // insert query
  $insert_products = "INSERT INTO `products` (product_title, product_description, product_keywords, product_category, product_brand, product_image1, product_image2, product_price, product_date, product_status) VALUES ('$product_title', '$product_description', '$product_keywords', '$product_category', '$product_brand', '$product_image1', '$product_image2', '$product_price', NOW(), '$product_status')";

  $result_query = mysqli_query($conn,$insert_products);
  if($result_query)
  {
    echo "<script>alert('Successfully inserted the products')</script>";
  }
}

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

     <!-- bootstrap css link -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

     <!-- external css stylesheet -->
    <link rel="stylesheet" href="../style.css">

</head>
<body class="text-light">
    
<form method="post" action="" class="mb-2" enctype="multipart/form-data">
    <div class="form-outline mb-4 w-50 m-auto">
     <label for="product_title" class="form-label">Product Title</label>
      <input type="text" class="form-control" name="product_title" id="product_title" placeholder="Enter product title" autocomplete="off" required="required">
</div>

<!-- description -->
<div class="form-outline mb-4 w-50 m-auto">
     <label for="description" class="form-label">Product Description</label>
      <input type="text" class="form-control" name="product_description" id="product_description" placeholder="Enter product description" autocomplete="off" required="required">
</div>

<!-- keywords -->
<div class="form-outline mb-4 w-50 m-auto">
     <label for="product_keywords" class="form-label">Product Keywords</label>
      <input type="text" class="form-control" name="product_keywords" id="product_keywords" placeholder="Enter product keywords" autocomplete="off" required="required">
</div>

<!-- categories -->
<div class="form-outline mb-4 w-50 m-auto">
    <select name="product_category" id="product_category" class="form-select">
        <option value="">Select a Category</option>

        <?php

        $select_category="SELECT * FROM `categories`";
        $result_category=mysqli_query($conn,$select_category);

        while($row_data=mysqli_fetch_assoc($result_category))
        {
          $category_title=$row_data['category_title'];
          $category_id=$row_data['category_id'];

          echo "<option value='$category_id'>$category_title</option>";
        }
        ?>

       
    </select>
</div>

<!-- brands -->
<div class="form-outline mb-4 w-50 m-auto">
    <select name="product_brand" id="product_brand" class="form-select">
        <option value="">Select a Brand</option>

        <?php

        $select_brands="SELECT * FROM `brands`";
        $result_brands=mysqli_query($conn,$select_brands);

        while($row_data=mysqli_fetch_assoc($result_brands))
        {
          $brand_title=$row_data['brand_title'];
          $brand_id=$row_data['brand_id'];

          echo "<option value='$brand_id'>$brand_title</option>";
        }
        ?>

       
    </select>
</div>

<!-- Image 1 -->
<div class="form-outline mb-4 w-50 m-auto">
    <label for="product_image1" class="form-label">Product Image 1</label>
    <input type="file" name="product_image1" id="product_image1" class="form-control" required="required">
</div>

<!-- Image 2 -->
<div class="form-outline mb-4 w-50 m-auto">
    <label for="product_image2" class="form-label">Product Image 2</label>
    <input type="file" name="product_image2" id="product_image2" class="form-control" required="required">
</div>

<!-- Price -->
<div class="form-outline mb-4 w-50 m-auto">
    <label for="product_price" class="form-label">Product Price</label>
    <input type="text" name="product_price" id="product_price" class="form-control" placeholder="Enter product keywords" autocomplete="off" required="required">
</div>

<!-- Button -->
<div class="form-outline mb-4 w-50 m-auto text-center">
    <input type="submit" class="btn btn-info mb-3 bg-style" name="insert_product" value="Insert Products">
</div>


</form>

</body>
</html>