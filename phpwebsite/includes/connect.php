<?php

// Create connection
$conn = mysqli_connect("localhost","root", "","mystore");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error($conn));
  }
  // echo "Connected successfully";

?>