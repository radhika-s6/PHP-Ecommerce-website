<?php
include('../includes/connect.php');

if(isset($_POST['insert_category']))
{
  $category_title=$_POST['category_title'];

  // select data from database
  $select_query="select * from `categories` where category_title='$category_title'";
  $result_select=mysqli_query($conn,$select_query);
  $number=mysqli_num_rows($result_select);
  if($number>0)
  {
    echo "<script>alert('This category is present inside the database')</script>";
  }
  else{

  $insert_query="insert into `categories` (category_title) values ('$category_title')";
  $result=mysqli_query($conn,$insert_query);

  if($result){
    echo "<script>alert('Category has been inserted successfully')</script>";
  }  
}
}

?> 

<h2 class="text-center text-light">Insert Categories</h2>

<form method="post" action="" class="mb-2">
    <div class="input-group w-90 mb-2">
      <span class="input-group-text bg-style" id="basic-addon2">
        <i class="fa-solid fa-receipt"></i>
      </span>
      <input type="text" class="form-control" name="category_title" placeholder="Insert Category" aria-label="Username" aria-describedby="basic-addon2">
    </div>

<div class="input-group w-10 mb-2">
  <input type="submit" class="bg-style p-2 my-2 border-0" name="insert_category" value="Insert Category">
</div>
</form>