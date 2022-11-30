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

    <?php include "../include/head.php"?>
</head>
<body>
    <div id="skip">
        <a href="#header">헤더 영역 바로가기</a>
        <a href="#main">컨텐츠 영역 바로가기</a>
        <a href="#footer">푸터 영역 바로가기</a>
    </div>
    <!-- //skip -->

    <?php include "../include/header.php"?>
    <!-- header -->
    
    <main id="mainblog">
        <img class="main_bg" src="../assets/img/main_bg02.jpg" alt="">
        <section id="main" class="container section">
        <?php include "../include/mainOne.php" ?>
            <div class="main_cont">
                <section class="main__blog_new">
                    <div class="main__blog_new_title">
                        <h2>BLOG 소식</h2>
                        <a href="../blog/blog.php"><span>더보기</span></a>
                    </div>
                    <div class="main__blog__inner">
                        <div class="main__blog__contents">
                            <article class="card__wrap">
                                <div class="card__inner column2">
<?php
        if(isset($_GET['page'])){
            $page = (int) $_GET['page'];
        } else {
            $page = 1;
        }
    
        $sql = "SELECT * FROM classBlog WHERE blogDelete = 0 ";
        $result = $connect -> query($sql);
        
        $totalCount = $result -> num_rows;
    
        $viewNum = 10;
        $viewLimit = ($viewNum * $page) - $viewNum;
    
        // echo "<pre style='position:fixed; top:150px; right: 50px; color:red;'>";
        // var_dump($page);
        // echo "</pre>";
    
        function msg($alert){
            // echo "<p>👩🏻‍💻".$alert."건의 게시물을 작성했습니다</p>";
        }
    
        $sql = $sql."ORDER BY blogID DESC LIMIT 5";
        $result = $connect -> query($sql);
        
        // 전체 게시글 개수($count)
        msg($totalCount);
?>
<?php foreach($result as $blog){ ?>
    <div class="card">
        <figure class="card__header">
            <img src="../assets/blog/<?=$blog['blogImgSrc']?>" alt="vscode에 scss설치하기">
            <a href="../blog/blogView.php?blogID=<?=$blog['blogID']?>" class="go"></a>
            <span class="cate"><?=$blog['blogCategory']?></span>
        </figure>
        <div class="card__contents">
            <div class="title">
                <h3><a href="../blog/blogView.php?blogID=<?=$blog['blogID']?>"><?=$blog['blogTitle']?></a></h3>
                <p><?=$blog['blogContents']?></p>
            </div>
            <div class="info">
                <em class="author"><?=$blog['blogAuthor']?></em>
                <span class="time"><?=date('Y-m-d', $blog['blogRegTime'])?></span>
            </div>
        </div>
    </div>
<?php } ?>
                        </div>
                    </article>
                </div>
            </div>
                </section>
                <section class="board_new">
                    <div class="board_new_title">
                        <h2>게시판 소식</h2>
                        <a href="../board/board.php"><span>더보기</span></a>
                    </div>
                <div class="main__table">
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
    $sql = "SELECT b.boardID, b.boardTitle, m.youName, b.regTime, b.boardView FROM classBoard b JOIN classMember m ON (b.memberID = m.memberID) ORDER BY boardID DESC LIMIT 5";
    $result = $connect -> query($sql);
    if($result){
        $count = $result -> num_rows;
        if($count > 0){
            for($i=1; $i <= $count; $i++){
                $info = $result -> fetch_array(MYSQLI_ASSOC);
                echo "<tr>";
                echo "<td>".$info['boardID']."</td>";
                echo "<td><a href='../board/boardView.php?boardID={$info['boardID']}'>".$info['boardTitle']."</td>";
                echo "<td>".$info['youName']."</td>";
                echo "<td>".date('Y-m-d', $info['regTime'])."</td>";
                echo "<td>".$info['boardView']."</td>";
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
                </section>
            </div>
        </section>    
    </main>
    <!-- //main -->

    <?php include "../include/footer.php"?>
    <!-- footer -->
</body>

</html>