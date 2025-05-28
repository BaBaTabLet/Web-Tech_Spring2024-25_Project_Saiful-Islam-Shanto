<?php
require_once("../session.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
 <div class="container">

   <h2>Welcome, <?= htmlspecialchars($_SESSION['user']['username']); ?>!</h2>
 
 <nav class="main-menu">
 <?php if ($_SESSION['user']['role'] === 'teacher') {
 ?>
 <h3>Teacher Menu</h3>
   <ul>
    <li><a href="CategoryManager.php">Manage Categories</a></li>
    <li><a href="AddQuestion.php">Add New Question</a></li>
    <li><a href="QuestionList.php">Question Bank</a></li> <li><a href="BulkImport.php">Bulk Import Questions</a></li>
     </ul>
<?php } else {
 ?>
 <h3>Student Menu</h3>
 <ul>
   <li><a href="SelectTest.php">Take a New Test</a></li>
    <li><a href="ResultHistory.php">View My Results</a></li>
   </ul>
  <?php } ?>
  </nav>
  <br>
 <a href="Logout.php" class="btn btn-delete">Logout</a>
 </div>
 </body>
 </html>