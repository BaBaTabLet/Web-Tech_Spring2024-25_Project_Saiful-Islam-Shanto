<?php


include("db.php");
function getQuestionsByCategory($catId) 
{
    $con =getConnection();
    $q ="SELECT * FROM questions WHERE category_id = $catId";
    $res =mysqli_query($con, $q);
    $data =array();
    while ($row = mysqli_fetch_assoc($res)) {
    if ($row['question_type'] == 'mcq') {
      $row['answers'] = getAnswers($row['question_id']); }
     $data[] = $row; }

    return $data;
}

function getAnswers($qid) {
    $con =getConnection();
    $q ="SELECT * FROM answers WHERE question_id = $qid";
    $res =mysqli_query($con, $q);
    $data =array();
    while ($row = mysqli_fetch_assoc($res)) 
    {
        $data[] = $row;
    }
    return $data;
}

function calculateScore($submitted) {
    $score = 0;
    $total = count($submitted);
    if ($total ==0)
    return 0;

    $ids =implode(",", array_keys($submitted));
    $con =getConnection();
    $q ="SELECT question_id, answer_id FROM answers WHERE is_correct = 1 AND question_id IN ($ids)";
    $res = mysqli_query($con, $q);

    $correct = array();
    while ($row = mysqli_fetch_assoc($res)) {
        $correct[$row['question_id']][] = $row['answer_id'];
    }

    foreach ($submitted as $qid => $ansid)
     {
        if (isset($correct[$qid]) && in_array($ansid, $correct[$qid])) {
            $score++; }
    }
  return ($score / $total) * 100;
}

function saveResult($uid, $cid, $score) {
    $con =getConnection();
    $q ="INSERT INTO test_attempts (user_id, category_id, score) VALUES ($uid, $cid, $score)";
    return mysqli_query($con, $q);
}
function getHistory($uid) {
    $con = getConnection();
    $q = "SELECT ta.*, c.category_name FROM test_attempts ta JOIN categories c ON ta.category_id = c.category_id WHERE ta.user_id = $uid ORDER BY ta.attempt_date DESC";
    $res = mysqli_query($con, $q);
    $list = array();
    while ($row = mysqli_fetch_assoc($res)) 
    { $list[] = $row;}
    return $list;
}

?>
