<?php
include("../session.php");
include("../Model/questionModel.php");
include("../Model/categoryModel.php");

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: QuestionList.php");
    exit;
}

$q = fetchQuestionWithAnswers($id);
$cats = getAllCategories();
?>
<html>
<head>
    <title>Edit Question</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h2>Edit Question</h2>


    <form action="../Controller/EditQuestionController.php" method="post">
        <input type="hidden"name="question_id" value="<?= $q['question_id'] ?>">

        <label>Question:</label><br>
        <textarea name="question_text"><?= $q['question_text'] ?></textarea><br><br>

        <label>Category:</label>
        <select name="category_id">
            <?php foreach ($cats as $c): ?>
                <option value="<?= $c['category_id'] ?>" <?php if ($c['category_id'] == $q['category_id']) echo "selected"; ?>>
                    <?= $c['category_name'] ?>
                </option>
            <?php endforeach; ?>
        </select><br><br>

        <h4>Answers (MCQ only)</h4>
        <div id="ans_div">
        <?php
        if ($q['question_type'] == 'mcq' && isset($q['answers'])) {
            foreach ($q['answers'] as $i => $a) {
                echo "<div style='margin-bottom:10px'>";
                echo "<input type='text' name='answers[$i][text]' value='" . $a['answer_text'] . "'>";
                echo "<input type='checkbox' name='answers[$i][is_correct]' value='1' " . ($a['is_correct'] ? "checked" : "") . "> Correct";
                echo "</div>";
            }
        }
        ?>
        </div>

        <?php if ($q['question_type'] == 'mcq'): ?>
            <button type="button" onclick="addAns()">Add Answer</button>
        <?php else: ?>
            <p><i>No answer editing for essay type.</i></p>
        <?php endif; ?>

        <br><br>
        <input type="submit" name="update_question" value="Update">
    </form>
    <br><a href="QuestionList.php">Back</a>

    <script>
        var count = <?= isset($q['answers']) ? count($q['answers']) : 0 ?>;

        function addAns() {
            var box = document.getElementById("ans_div");
            var div = document.createElement("div");
            div.innerHTML=    "<input type='text' name='answers[" +count+"][text]' placeholder='New answer'>" +
                              "<input type='checkbox' name='answers["+count+"][is_correct]' value='1'> Correct";
            box.appendChild(div);
            count++;
        }
    </script>
</body>
</html>
