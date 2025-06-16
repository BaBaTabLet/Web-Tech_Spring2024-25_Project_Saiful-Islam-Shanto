<?php


include("../session.php");
include("../Model/testModel.php");

if (!isset($_GET['category_id']))
 {
 header("Location: SelectTest.php");
 exit;
}

$catId =$_GET['category_id'];
$qs =getQuestionsByCategory($catId);
$time = ount($qs) * 60;

?>

<html>
<head>
 <title>Test</title>
</head>
<body>
    <h2>Test Start</h2>
    <div id="timer" style="font-weight: bold; color: red;">
    </div>

    <form id="test_form" method="post" action="../Controller/TestController.php">
        <input type="hidden" name="category_id" value="<?= $catId ?>">

       <?php

  foreach ($qs as $i => $q) {
    echo "<div style='margin-bottom: 20px'>";
    echo "<h4>Q" . ($i + 1) . ": " . $q['question_text'] . "</h4>";

            if ($q['question_type'] == 'mcq') {
                foreach ($q['answers'] as $a) {
                    echo "<label><input type='radio' name='answers[" . $q['question_id'] . "]' value='" . $a['answer_id'] . "' required> " . $a['answer_text'] . "</label><br>";
                }
            }
     else if ($q['question_type'] == 'essay') {
        echo "<textarea name='answers[" . $q['question_id'] . "]'></textarea><br>";
        echo "<small>Essay questions not auto scored.</small>";
  }

   echo "</div>";
  }
 ?>

     <input type="submit" name="submit_test" value="Submit">
    </form>



    <script>
     var time = <?= $time ?>;
     var timerBox = document.getElementById("timer");
     var form = document.getElementById("test_form");
      var countdown = setInterval(function() 
        {
            var min =Math.floor(time/60);
            var sec=time% 60;
            if (sec < 10) sec ="0"+sec;
            timerBox.innerHTML =min +":"+sec;time--;

         if (time < 0) {
              clearInterval(countdown);
             alert("Time's up! Submitting.");
              form.submit(); }
 },1000);

    </script>

</body>
</html>
