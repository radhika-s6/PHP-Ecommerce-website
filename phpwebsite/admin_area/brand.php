<?php
include('../includes/connect.php');

if(isset($_POST['insert_brand']))
{
  $brand_title=$_POST['brand_title'];

  // select data from database
  $select_query="select * from `brands` where brand_title='$brand_title'";
  $result_select=mysqli_query($conn,$select_query);
  $number=mysqli_num_rows($result_select);
  if($number>0)
  {
    echo "<script>alert('This brand is present inside the database')</script>";
  }
  else{

  $insert_query="insert into `brands` (brand_title) values ('$brand_title')";
  $result=mysqli_query($conn,$insert_query);

  if($result){
    echo "<script>alert('Brand has been inserted successfully')</script>";
  }
}
}

?>

<h2 class="text-center text-light">Insert Brands</h2>

<form method="post" action="" class="mb-2">
    <div class="input-group w-90 mb-2">
      <span class="input-group-text bg-style" id="basic-addon1">
        <i class="fa-solid fa-receipt"></i>
      </span>
      <input type="text" class="form-control" name="brand_title" placeholder="Insert Brands" aria-label="Username" aria-describedby="basic-addon1">
    </div>

<div class="input-group w-10 mb-2">
  <input type="submit" class="bg-style p-2 my-2 border-0" name="insert_brand" value="Insert Brands">
  <!-- <button class="bg-info p-2 my-3 border-0">
    Insert Brands
  </button> -->
</div>
</form>