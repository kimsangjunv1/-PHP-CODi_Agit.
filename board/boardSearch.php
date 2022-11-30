<?php

    include "../connect/connect.php";
    include "../connect/session.php";

?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시판</title>
    <?php include "../include/link.php" ?>
</head>
<body>
    <div id="skip">
        <a href="#header">헤더 영역 바로가기</a>
        <a href="#main">컨텐츠 영역 바로가기</a>
        <a href="#footer">푸터 영역 바로가기</a>
    </div>
    <!-- //skip -->
    <?php include "../include/header.php" ?>
    <!-- //header -->
    <main id="main">
        <section id="board" class="container">
            <h2>게시판 영역입니다.</h2>
            <div class="board__inner">
                <div class="board__title">
                    <h3>검색 결과 게시판</h3>
<?php
     if(isset($_GET['page'])){
        $page = (int)$_GET['page'];
    } else {
        $page = 1;
    }

    function msg($alert){
        echo "<p> 💙총 ".$alert."건이 검색되었습니다. :3 </p>";
    }

        $searchKeyword = $_GET['searchKeyword'];
        $searchOption = $_GET['searchOption'];

    // echo $searchKeyword,$searchOption;
    $searchKeyword = $connect -> real_escape_string(trim($searchKeyword));
    $searchOption = $connect -> real_escape_string(trim($searchOption));

    // $sql = "SELECT b.myBoardID, b.boardTitle, b.boardContents, b.regTime, b.boardView FROM myBoard b JOIN myMember m ON(b.myBoardID = m.myBoardID) ";
    $sql = "SELECT b.myBoardID, b.boardTitle, b.boardContents, m.youName, b.regTime, b.boardView FROM myBoard b JOIN myMember m ON(b.myMemberID = m.myMemberID) ";
    
    switch($searchOption){
        case "title" : 
            $sql .= "WHERE b.boardTitle LIKE '%{$searchKeyword}%' ORDER BY myBoardID DESC ";
            break;
        case "content" : 
            $sql .= "WHERE b.boardContents LIKE '%{$searchKeyword}%' ORDER BY myBoardID DESC ";
            break;
        case "name" : 
            $sql .= "WHERE m.youName LIKE '%{$searchKeyword}%' ORDER BY myBoardID DESC ";
            break;
    };

    // echo $sql;

    $result = $connect -> query($sql);

    // 전체 게시글 갯수
    $totalCount = $result -> num_rows;
    msg($totalCount);

?>
                </div>
                <div class="board__table">
                    <table>
                        <colgroup>
                            <col style="width: 5%">
                            <col>
                            <col style="width: 10%">
                            <col style="width: 10%">
                            <col style="width: 7%">
                        </colgroup>
                        <thead>
                            <tr>
                                <th>번호</th>
                                <th>제목</th>
                                <th>등록자</th>
                                <th>등록일</th>
                                <th>조회수</th>
                            </tr>
                        </thead>
                        <tbody>
<?php
    $viewNum = 10;
    $viewLimit = ($viewNum * $page) - $viewNum;

    $sql = $sql."LIMIT {$viewLimit},{$viewNum}";
    $result = $connect -> query($sql);

    // echo $sql;

    if($totalCount > 0){
        $count = $result -> num_rows;
        for($i=1; $i <= $count; $i++){
            $info = $result -> fetch_array(MYSQLI_ASSOC);
            echo "<tr>";
            echo "<td>".$info['myBoardID']."</td>";
            echo "<td><a href='boardView.php?myBoardID={$info['myBoardID']}'>".$info['boardTitle']."</a></td>";
            echo "<td>".$info['youName']."</td>";
            echo "<td>".date('Y-m-d',$info['regTime'])."</td>";
            echo "<td>".$info['boardView']."</td>";
            echo "</tr>";
        }
    }else {
        echo "<tr><td colspan = '5'>게시판이 없습니다 ;< </td></tr>";
    }
?>
                        </tbody>
                    </table>
                </div>
                <div class="board__pages">
                    <ul>
<?php
    //총 페이지 갯수
    $boardCount = ceil($totalCount/$viewNum);

    
    // echo $boardCount;

    //현재 페이지를 기준으로 보여주고 싶은 갯수
    $pageCurrent = 5;
    $startPage = $page - $pageCurrent;
    $endPage = $page + $pageCurrent;

    //처음 페이지 초기화
    if($startPage < 1) $startPage = 1;

    //마지막 페이지 초기화
    if($endPage >= $boardCount ) $endPage = $boardCount;

    //이전페이지, 처음페이지
    if($page != 1){
        $prevPage = $page - 1;
        echo "<li><a href='boardSearch.php?page=1&searchKeyword={$searchKeyword}&searchOption={$searchOption}'>처음으로</a></li>";
        echo "<li><a href='boardSearch.php?page={$prevPage}&searchKeyword={$searchKeyword}&searchOption={$searchOption}'>이전</a></li>";
    }

    //페이지 넘버 표시
    for($i=$startPage; $i<=$endPage; $i++){
        $active = "";
        if($i == $page)$active = "active";

        echo "<li class='{$active}'><a href='boardSearch.php?page={$i}&searchKeyword={$searchKeyword}&searchOption={$searchOption}'>{$i}</a></li>";
    }

    //다음 페이지, 마지막페이지
    if($page != $boardCount){
        $nextPage = $page + 1;
        echo "<li><a href='boardSearch.php?page={$nextPage}&searchKeyword={$searchKeyword}&searchOption={$searchOption}'>다음</a></li>";
        echo "<li><a href='boardSearch.php?page={$boardCount}&searchKeyword={$searchKeyword}&searchOption={$searchOption}'>마지막으로</a></li>";
    }
?>
                    </ul>
                </div>
            </div>
        </section>
    </main>
    <!-- //main -->
    <?php include "../include/footer.php" ?>
    <!-- //footer -->
</body>
</html>