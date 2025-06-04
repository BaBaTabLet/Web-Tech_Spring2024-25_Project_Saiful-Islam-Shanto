<?php


require_once("../Model/categoryModel.php");

 if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 if (isset($_POST['add_category'])) {
$categoryName = $_POST['category_name'];
if ($categoryName != "") {
 	
$was_it_successful = createCategory($categoryName);
 if($was_it_successful){
	$msg = "Category added successfully.";
  } else {
 	$msg ="Failed to add category.";
  }
  header("Location: ../View/CategoryManager.php?message=" . urlencode($msg));
  } else {
  header("Location: ../View/CategoryManager.php?error=Category name cannot be empty.");
  }
  exit;
   }
}

if (isset($_GET['delete_id'])) {
 $the_id_to_delete = $_GET['delete_id'];
 $success = deleteCategoryById($the_id_to_delete); 

   if ($success == true) {
 	$message ="Category and all its questions have been deleted.";
   }
  else {
 	$message ="Failed to delete category.";
   }


 header("Location:../View/CategoryManager.php?message=" .urlencode($message));
die();
}

?>