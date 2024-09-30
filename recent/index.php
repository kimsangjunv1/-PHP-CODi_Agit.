<?php
    include "../connect/connect.php";
    include "../connect/session.php";

    if(isset($_GET['page'])){
        $page = (int) $_GET['page'];
    } else {
        $page = 1;
    }
    $viewNum = 10;
    $viewLimit = ($viewNum * $page) - $viewNum;
    //echo $_GET['page'];
    //1~20  --> 1page  : DESC 0,  20  ---> ($viewNum * 1) - $viewNum
    //21~40 --> 2page  : DESC 20, 20  ---> ($viewNum * 2) - $viewNum
    //41~60 --> 3page  : DESC 40, 20  ---> ($viewNum * 3) - $viewNum
    //61~80 --> 4page  : DESC 60, 20  ---> ($viewNum * 4) - $viewNum
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
<body class="login__bg">
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
            <h2>개발자 게시판</h2>
            <p> 게시판 설명이 들어갈 자리입니다.</p>
            <div class="board__inner">
                <div class="board__search">
                    <div class="left">
<?php
    // function msg($alert){
    //     echo "<p>👩🏻‍💻".$alert."건의 게시물을 작성했습니다</p>";
    // }
    // // 전체 게시글 개수($count)
    // msg($totalCount);
?>
                        * 총 <em>21</em>건의 게시물이 등록되어 있습니다.
                    </div>
                    <div class="right">
                        <form action="boardSearch.php" name="boardSearch" method="get">
                            <fieldset>
                                <legend class="blind">게시판 검색 영역</legend>
                                <select name="searchOption" id="searchOption">
                                    <option value="title">제목</option>
                                    <option value="content">내용</option>
                                    <option value="name">등록자</option>
                                </select>
                                <input type="search" name="searchKeyword" id="searchKeyword" class="input_style3" placeholder="검색어를 입력하세요!"
                                    aria-label="search" required>
                                <button type="submit" >⚲</button>
                                <a href="boardWrite.php" >글쓰기</a>
                            </fieldset>
                        </form>
                    </div>
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
    // 두개의 테이블 join
    $sql = "SELECT b.postID, b.postTitle, m.youName, b.regTime, b.postView FROM boardDevlog b JOIN classMember m ON (b.memberID = m.memberID) ORDER BY postID DESC LIMIT {$viewLimit}, {$viewNum}";
    $result = $connect -> query($sql);
    if($result){
        $count = $result -> num_rows;
        if($count > 0){
            for($i=1; $i <= $count; $i++){
                $info = $result -> fetch_array(MYSQLI_ASSOC);
                echo "<tr>";
                echo "<td>".$info['postID']."</td>";
                echo "<td><a href='postView.php?postID={$info['postID']}'>".$info['postTitle']."</td>";
                echo "<td>".$info['youName']."</td>";
                echo "<td>".date('Y-m-d', $info['regTime'])."</td>";
                echo "<td>".$info['postView']."</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>게시글이 없습니다.</td></tr>";
        }
    }

    // 게시물이 없을 때에는 1만 나오게 
    if(!isset($result)){

    }
?>






                        </tbody>
                    </table>
                </div>
                <div class="board__pages">
                    <ul>
<?php
    $sql = "SELECT count(postID) FROM boardDevlog";
    $result = $connect -> query($sql);
    $boardCount = $result -> fetch_array(MYSQLI_ASSOC);
    $totalCount = $result -> num_rows;

    $boardCount = $boardCount['count(postID)'];

    // 총 페이지 갯수
    $boardCount = ceil($boardCount/$viewNum);

    // echo $boardCount;
    // 현재 페이지를 기준으로 보여주고 싶은 갯수
    $pageCurrent = 5;
    $startPage = $page - $pageCurrent;
    $endPage = $page + $pageCurrent;

    // 처음 페이지 초기화
    if($startPage < 1) $startPage = 1;

    // 마지막 페이지 초기화
    if($endPage >= $boardCount) $endPage = $boardCount;

    //테스트
    if($totalCount=1){
        $boardCount = 1;   
    } else {
        alert("dd");
    }
    // var_dump($result);

    // 이전 페이지, 처음 페이지
    if($page != 1){
        $prevPage = $page - 1;
        echo "<li><a href='board.php?page=1' style='font-size:12px'>&lt;&lt;</a></li>";
        echo "<li><a href='board.php?page={$prevPage}' style='font-size:12px'>&lt;</a></li>";
    }
    // 페이지 넘버 표시
    for($i=$startPage; $i<=$endPage; $i++){
        $active = "";
        if($i == $page) $active = "active";
        echo "<li class='{$active}'><a href='board.php?page={$i}'>{$i}</a></li>";
    }
    // 다음 페이지, 마지막 페이지
    if($page != $endPage){
        $nextPage = $page + 1;
        echo "<li><a href='board.php?page={$nextPage}' style='font-size:12px'>&gt;</a></li>";
        echo "<li><a href='board.php?page={$boardCount}' style='font-size:12px'>&gt;&gt;</a></li>";
    }
?>
                    </ul>
                </div>
            </div>
        </section>
        <!-- //board -->
    </main>
    <!-- //main -->

    <?php include "../src/components/layout/footer.php"?>
    <!-- footer -->
</body>
</html>