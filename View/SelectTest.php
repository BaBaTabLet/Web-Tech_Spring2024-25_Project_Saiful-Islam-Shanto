<?php

include("../session.php");
include("../Model/categoryModel.php");
$cats = getAllCategories();

?>
<html>
<head>
<title>Take Test</title>
</head>
<body>

    <h2>Start a Test</h2>
    <p>Select a category below to take a test.</p>
    <ul>
        <?php
        if (count($cats) == 0){
            echo "<li>No tests available.</li>";
      } else {
     foreach ($cats as $c) {
                echo"<li><a href='TakeTest.php?category_id=" .$c['category_id'] ."'>" .$c['category_name']."</a></li>";
        }
        }
?>

    <br><a href="Home.php">Back</a>
</body>
</html>
