<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- bootstrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- fontawesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- external css stylesheet -->
    <link rel="stylesheet" href="../style.css">

</head>
<body>

    <!-- JavaScript link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
    <div class="container-fluid p-0">

    <!-- first child -->
        <nav class="navbar navbar-expand-lg navbar-light bg-style">
            <div class="container-fluid">
                <img src="../images/shopBg.png" alt="shop" class="logo">
                <nav class="navbar navbar-expand-lg">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="" class="nav-link text-dark">Welcome User</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link text-dark">Logout</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </nav>

        <!-- second child -->
        <div class="text-center text-light">
            <h3 class="p-4">Manage Details</h3>
        </div>

        <!-- third child -->
        <div class="row">
            <div class="col-md-12 nav-style p-2 d-flex align-items-center">
                <div class="p-2 mx-5">
                    <a href="#"><img src="../images/user.png" alt="user logo" width="80px" height="85px" ></a>
                    <p class="text-light text-center">Admin Name</p>
                </div>

                <!-- button*10>a.nav-link.text-light.bg-info.my-1 -->
                <div class="button text-center p-2 mx-4">
                    <button class="bg-style"><a href="" class="nav-link text-dark my-1 p-1"> Insert Products </a></button>
                    <button class="bg-style"><a href="" class="nav-link text-dark my-1 p-1"> View Products </a></button>
                    <button class="bg-style"><a href="index.php?insert_category" class="nav-link text-dark my-1 p-1">Insert Categories </a></button>
                    <button class="bg-style"><a href="" class="nav-link text-dark my-1 p-1"> View Categories </a></button>
                    <button class="bg-style"><a href="index.php?insert_brand" class="nav-link text-dark my-1 p-1">Insert Brands </a></button>
                    <button class="bg-style"><a href="" class="nav-link text-dark my-1 p-1"> View Brands </a></button>
                    <button class="bg-style"><a href="" class="nav-link text-dark my-1 p-1"> All Orders </a></button>
                    <button class="bg-style"><a href="" class="nav-link text-dark my-1 p-1"> All Payments </a></button>
                    <button class="bg-style"><a href="" class="nav-link text-dark my-1 p-1"> List Users </a></button>
                    <button class="bg-style"><a href="" class="nav-link text-dark my-1 p-1"> Logout </a></button>
                </div>
            </div>
        <div>

        <!-- fourth child -->
        <div class="container my-5">
            <?php

            if(isset($_GET['insert_category']))
            {
                include('category.php');
            }
            if(isset($_GET['insert_brand']))
            {
                include('brand.php');
            }
            if(isset($_GET['insert_product']))
            {
                include('product.php');
            }
            
            ?>
        </div>


    </div>

</body>
</html>