<?php
    include "../connect/connect.php";
    include "../connect/session.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP 사이트 만들기</title>

    <?php include "../src/components/layout/head.php"?>
</head>
<body>
    <div id="skip">
        <a href="#header">헤더 영역 바로가기</a>
        <a href="#main">컨텐츠 영역 바로가기</a>
        <a href="#footer">푸터 영역 바로가기</a>
    </div>
    <!-- //skip -->

    <?php include "../src/components/layout/header.php"?>
    <!-- header -->
    
    <main id="main">
    <section id="board" class="container section">
            <h2>게시판</h2>
            <p> 게시판 설명이 들어갈 자리입니다.</p>
            <div class="board__inner">
                <div class="board__view">
                    <table>
                        <colgroup>
                            <col style="width: 20%">
                            <col style="width: 80%">
                        </colgroup>
                        <tbody>
<?php
    $postID = $_GET['postID'];
    // echo $postID;
    // 보드뷰 + 1(UPDATE)
    $sql = "UPDATE boardDevlog SET postView = postView + 1 WHERE postID = {$postID}";
    $connect -> query($sql);
    $sql = "SELECT b.postTitle, m.youName, b.regTime, b.postView, b.postContents FROM boardDevlog b JOIN classMember m ON(m.memberID = b.memberID) WHERE b.postID = {$postID}";
    $result = $connect -> query($sql);
    if($result){
        $info = $result -> fetch_array(MYSQLI_ASSOC);
        // echo "<pre>";
        // var_dump($info);
        // echo "</pre>";
        echo "<tr><th>제목</th><td>".$info['postTitle']."</td></tr>";
        echo "<tr><th>등록자</th><td>".$info['youName']."</td></tr>";
        echo "<tr><th>등록일</th><td>".date('Y-m-d H:i', $info['regTime'])."</td></tr>";
        echo "<tr><th>조회수</th><td>".$info['postView']."</td></tr>";
        echo "<tr><th>내용</th><td class='height'>".$info['postContents']."</td></tr>";
    }
?>
                        </tbody>
                    </table>
                </div>
                <div class="board__btn">
                    <a href="boardModify.php">수정하기</a>
                    <a href="boardRemove.php">삭제하기</a>
                    <a href="board.php">목록보기</a>
                </div>
        </section>
        <!-- //board -->
    </main>
    <!-- //main -->

    <?php include "../src/components/layout/footer.php"?>
    <!-- footer -->
</body>
</html>