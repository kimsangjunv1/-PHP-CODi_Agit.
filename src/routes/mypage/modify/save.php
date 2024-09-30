<?php
    include "../../connect/connect.php";

    // 받아올 값(POST 방식)
    $commentPass = $_POST["pass"];
    $commentMsg = $_POST["msg"];
    $commentID = $_POST["commentID"];

    $sql = "UPDATE myBoardComment SET commentMsg = '{$commentMsg}', commentPass = '{$commentPass}' WHERE myCommentID = {$commentID}";
    
    // 데이터 가져옴
    $result = $connect -> query($sql);

    echo json_encode(array("info" => $commentID));
?>