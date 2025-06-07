<?php


session_start();
include("QuestionController.php");
$errors = array();

if (!isset($_POST['question_text']) || $_POST['question_text'] == "") {
    $errors[] = "Please write a question.";  }

if(!isset($_POST['category_id']) || $_POST['category_id'] == "") {
    $errors[] = "Select category.";  }

if(isset($_POST['question_type']) && $_POST['question_type'] == "mcq") {
    if (!isset($_POST['answers']) || empty($_POST['answers'])) {
        $errors[] = "Give answers for MCQ.";

}
}

if(count($errors) > 0) {
    $_SESSION['errors'] = $errors;
    header("Location: ../View/AddQuestion.php");
    die();
}

$tex =$_POST['question_text'];
$type=$_POST['question_type'];
$cat =$_POST['category_id'];
$ans =array();
if (isset($_POST['answers'])) {
    $ans=$_POST['answers'];
}

$data=array(
    'text' => $text,
    'type' => $type,
    'category_id' => $cat,
    'answers' => $ans
);

$result =addQuestion($data);

if ($result) {
   $msg ="Question added successfully.";
} else {
  
  $msg ="Something went wrong.";
}


header("Location: ../View/QuestionList.php?message=".urlencode($msg));
exit;

?>
