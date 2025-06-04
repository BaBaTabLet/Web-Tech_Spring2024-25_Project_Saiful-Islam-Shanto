<?php


require_once("db.php");
function createCategory($categoryName) {
     $conn = getConnection();
 
       $sql ="INSERT INTO categories (category_name) VALUES ('$categoryName')";
       $result = mysqli_query($conn, $sql);
return $result;
}

function getAllCategories() {
$con = getConnection();
  $sql ="SELECT * FROM categories ORDER BY category_name";
  $res =mysqli_query($con, $sql);
  $all_the_categories = [];
  while ($row = mysqli_fetch_assoc($res)) {
  $all_the_categories[] = $row;
  }
   return $all_the_categories;
}



function deleteCategoryById($cat_id) {
  $con =getConnection();
  $sql ="DELETE FROM categories WHERE category_id = $cat_id";
 
   $stmt=mysqli_query($con, $sql);
   return $stmt;
}

?>