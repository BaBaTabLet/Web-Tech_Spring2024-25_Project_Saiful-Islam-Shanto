<?php

include("../session.php");
include("../Model/categoryModel.php");

$cats = getAllCategories();
$errs = array();
if (isset($_SESSION['errors'])) {
    $errs = $_SESSION['errors'];
    unset($_SESSION['errors']);

}

?>


<html>
<head>
    <title>Add Question</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h2>Add New Question</h2>

    <?php

    if (!empty($errs)) {
        echo "<div style='color:red'><ul>";
        foreach ($errs as $e) {
            echo "<li>" . $e . "</li>";
        }
        echo "</ul></div>";
    }
    ?>

    <form action="../Controller/AddQuestionValidation.php" method="post">
        <label>Question Text:</label><br>
        <textarea name="question_text"></textarea><br><br>

        <label>Category:</label>
        <select name="category_id">
            <option value="">-- Select --</option>
            <?php
            foreach ($cats as $c) {
                echo "<option value='" . $c['category_id'] . "'>" . $c['category_name'] . "</option>";
            }
            ?>
        </select><br><br>

        <label>Type:</label>
        <select name="question_type" id="type" onchange="showAnswers()">
            <option value="mcq">MCQ</option>
            <option value="essay">Essay</option>
        </select><br><br>

        <div id="ans_div"></div>
        <button type="button" onclick="addAns()">Add Answer</button><br><br>

        <input type="submit" value="Save">
    </form>

    <script>
        let i=0;

        function showAnswers() {
            var t = document.getElementById("type").value;
            var d = document.getElementById("ans_div");
            d.innerHTML = "";
            i = 0;
            if (t == "mcq") {
                addAns();
                addAns();
            }
        }

        function addAns() {
            var d = document.getElementById("ans_div");
            var box = document.createElement("div");
            box.innerHTML ="<input type='text' name='answers[" + i + "][text]' placeholder='Answer'>" +
                        "<input type='checkbox' name='answers[" + i + "][is_correct]' value='1'> Correct<br>";
            d.appendChild(box);
            i++;
            
        }


        window.onload = showAnswers;


    </script>
</body>
</html>
