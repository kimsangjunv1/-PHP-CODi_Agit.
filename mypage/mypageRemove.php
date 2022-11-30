<?php
   include "../../connect/connect.php";
   include "../../connect/session.php";
   include "../../connect/sessionCheck.php";
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>공지사항</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/board.css">
</head>
<body>
    <div style="display:none" class="scroll">
        <p>아래로 스크롤 해주세요.</p>
        <img src="../../assets/img/site_intro_scroll.png" alt="">
    </div>
    <div class="wrap">
        <div class="site">
            <?php include "../include/header.php" ?>
            <div class="remove">
                <div class="remove_info">
                    <img class="notice_logo" src="../../assets/img/site_board_edit_delete.png" alt="">
<?php
    $youDeleteAnswer = $_GET['youDeleteAnswer'];
    var_dump($youDeleteAnswer);
    $myMemberID = $_SESSION['myMemberID'];

    // $myBoardID = $connect -> real_escape_string($myBoardID);
    $myMemberID = $connect -> real_escape_string($myMemberID);


    // $sql = "SELECT myBoardID, myMemberID FROM myBoard WHERE myMemberID = {$myMemberID} && myBoardID = {$myBoardID}";
    // $result = $connect -> query($sql);

    // $memberInfo = $result -> fetch_array(MYSQLI_ASSOC);
    
    if("삭제하겠습니다" == $youDeleteAnswer){
        $sql = "DELETE FROM myBoard WHERE myMemberID = {$myMemberID}";
        $connect -> query($sql);
        $sql = "DELETE FROM myEvent WHERE myMemberID = {$myMemberID}";
        $connect -> query($sql);
        $sql = "DELETE FROM myComment WHERE myMemberID = {$myMemberID}";
        $connect -> query($sql);
        $sql = "DELETE FROM myDecoboard WHERE myMemberID = {$myMemberID}";
        $connect -> query($sql);
        $sql = "DELETE FROM myEvent WHERE myMemberID = {$myMemberID}";
        $connect -> query($sql);
        $sql = "DELETE FROM myEventComment WHERE myMemberID = {$myMemberID}";
        $connect -> query($sql);
        $sql = "DELETE FROM myComment WHERE myMemberID = {$myMemberID}";
        $connect -> query($sql);
        $sql = "DELETE FROM test WHERE myMemberID = {$myMemberID}";
        $connect -> query($sql);
        $sql = "DELETE FROM myMember WHERE myMemberID = {$myMemberID}";
        $connect -> query($sql);

        echo "<script>alert('삭제되었습니다..');</script>";
        echo "<script>location.href='../main/main.php';</script>";

        session_start();
        session_destroy();

    } else {
        echo "<script>alert('답변이 틀렸습니다.');</script>";

    }
?>
                    <p class="cross">ID가 삭제되었습니다, 하단의 버튼을 눌러 확인해주세요!</p>
                    <img src="../assets/img/site_board_notice_cross.png" alt="">
                    <button style="width:216px;" type="submit" class="input__Btn"><a href="board.php">확인</a></button>
                </div>
            </div>
        </div>
        <?php include "../include/footer.php" ?>
    </div>
</body>
<script src="../../assets/javascript/common.js"></script>
<script src="../../assets/javascript/board.js"></script>
</html>