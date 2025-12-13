<?php
include "config.php";
//include connection, this file is for uploading with backend file
//to be stored it is never visited in hyperlink directly
$getmanga = $_GET['query'];
if (isset($getmanga)) {
  //
  // use prepared statements for security against injection
  $stmt = $conn->prepare("SELECT * FROM products WHERE name LIKE ?");
  $search_param = "%" . $getmanga . "%";
  $stmt->bind_param("s", $search_param);
  $stmt->execute();
  $result = $stmt->get_result();
  }
?>
