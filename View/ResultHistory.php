<?php

include("../session.php");
include("../Model/testModel.php");
$userId =$_SESSION['user']['id'];
$history =getResultHistory($userId);

?>

<html>
<head>
    <title>Results</title>
</head>
<body>
    <h2>Your Test Results</h2>
    <table border="1" cellpadding="5" cellspacing="0" style="width: 80%; margin: auto;">
        <thead>
        <tr>
        <th>Category</th>
        <th>Score</th>
        <th>Date Taken</th></tr>

        </thead>
        <tbody>

            <?php 
            if (!$history) 
            {
             echo "<tr><td colspan='3' style='text-align:center;'>No results found</td></tr>";
            } 
            else {
             foreach ($history as $h) 
             {
                    echo "<tr>";
                    echo "<td>" .$h['category_name'] . "</td>";
                    echo "<td>" .$h['score'] . "%</td>";
                    echo "<td>" .date("M d, Y h:i A", strtotime($h['attempt_date'])) . "</td>";
                    echo "</tr>";
            }
            }
            ?>
  </tbody>
    </table>
    <br>

    <a href="Home.php">Back</a>

</body>
</html>
