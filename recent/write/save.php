<?php
    include "../connect/connect.php";
    include "../connect/session.php";

    $postTitle = $_POST['postTitle'];
    $postContents = nl2br($_POST['postContents']);

    $postTitle = $connect -> real_escape_string($postTitle);
    $postContents = $connect -> real_escape_string($postContents);
    $postView = 1;
    $regTime = time();
    $memberID = $_SESSION['memberID'];
    
    $sql = "INSERT INTO boardDevlog(memberID, postTitle, postContents, postView, regTime) VALUES('$memberID', '$postTitle', '$postContents', '$postView', '$regTime')";
    $connect -> query($sql);
?>
<script>
    location.href = "board.php";
</script>