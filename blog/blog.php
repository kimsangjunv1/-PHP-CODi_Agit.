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
    <title>PHP 사이트 만들기</title>
    <?php include "../include/head.php" ?>
    
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
        <section id="blog" class="container section">
            <div class="blog__desc">
                <div class="blog__menu__info">
                    <h2>개발 포스팅</h2>
                    <p>개발과 관련된 글을 모아봤어요 :></p>
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
            echo "<p>👩🏻‍💻".$alert."건의 게시물을 작성했습니다</p>";
        }
    
        $sql = $sql."ORDER BY blogID DESC LIMIT {$viewLimit}, {$viewNum}";
        $result = $connect -> query($sql);
        
        // 전체 게시글 개수($count)
        msg($totalCount);
    ?>
                </div>
                <div class="blog__search">
                    <form action="blogSearch.php">
                        <legend class="blind">블로그 서치</legend>
                        <select name="searchOption" id="searchOption">
                            <option value="jquery">jquery</option>
                            <option value="javascript">javascript</option>
                            <option value="html">html</option>
                            <option value="css">css</option>
                        </select>
                        <input type="search" name="searchKeyword" id="searchKeyword" class="input_style3" placeholder="검색어를 입력하세요!" aria-label="search" required>
                        <button>⚲</button>
                        <a href="blogWrite.php" class="btn">글쓰기</a>
                    </form>
                </div>
            </div>
            <div class="blog__inner">
                <div class="blog__contents">
                    <article class="card__wrap">
                        <div class="card__inner column2">
<?php foreach($result as $blog){ ?>
    <div class="card">
        <figure class="card__header">
            <img src="../assets/blog/<?=$blog['blogImgSrc']?>" alt="vscode에 scss설치하기">
            <a href="blogView.php?blogID=<?=$blog['blogID']?>" class="go"></a>
            <span class="cate"><?=$blog['blogCategory']?></span>
        </figure>
        <div class="card__contents">
            <div class="title">
                <h3><a href="blogView.php?blogID=<?=$blog['blogID']?>"><?=$blog['blogTitle']?></a></h3>
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
                        <div class="card__pages">
                            <ul>
<?php
    //총 페이지 갯수
    $boardCount = ceil($totalCount/$viewNum);

    //현재 페이지를 기준으로 보여주고 싶은 갯수
    $pageCurrent = 5;
    $startPage = $page - $pageCurrent;
    $endPage = $page + $pageCurrent;

    //처음 페이지 초기화
    if($startPage < 1) $startPage = 1;

    //마지막 페이지 초기화
    if($endPage >= $boardCount) $endPage = $boardCount;

    //이전 페이지, 처음 페이지
    if($page != 1){
        $prevPage = $page - 1;
        echo "<li><a href='blog.php?page=1' style='font-size:12px'>&lt;&lt;</a></li>";
        echo "<li><a href='blog.php?page={$prevPage}' style='font-size:12px'>&lt;</a></li>";
    } 

    //페이지 넘버 표시
    for($i=$startPage; $i<=$endPage; $i++){
        $active = "";
        if($i == $page) $active = "active";

        echo "<li class='{$active}'><a href='blog.php?page={$i}'>{$i}</a></li>";
    }

    //다음 페이지, 마지막 페이지
    if($page != $endPage) {
        $nextPage = $page + 1;
        echo "<li><a href='blog.php?page={$nextPage}' style='font-size:12px'>&gt;</a></li>";
        echo "<li><a href='blog.php?page={$boardCount}' style='font-size:12px'>&gt;&gt;</a></li>";
    }
?>
                            </ul>
                        </div>
                    </article>
                </div>
                <div class="blog__aside">
                    <div class="aside__intro">
                        <img src="../assets/blog/card_bg_01.png" alt="프로필 이미지">
                        <!-- <div class="img"> -->
                            <!-- <img src="../assets/img/banner_bg01.jpg" alt="배너 이미지"> -->
                        <!-- </div> -->
                        <div class="desc">
                            어떤 일이라도 <em>노력</em>하고 즐기면 그 결과는 <em>빛</em>을 바란다고 생각합니다.
                        </div>
                    </div>
                    <div class="blog__aside__cate">
                        <h3>카테고리</h3>
                        <ul>
                            <?php include "../include/category.php" ?>
                        </ul>
                    </div>
                    <div class="blog__aside__new">
                        <h3>최신글</h3>
                        <ul>
                            <?php include "../include/blogNew.php" ?>
                        </ul>
                    </div>
                    <div class="blog__aside__pop">
                        <h3>인기글</h3>
                        <ul>
                            <?php include "../include/blogNew.php" ?>
                        </ul>
                    </div>
                    <div class="blog__aside__comment">
                        <h3>최신 댓글</h3>
                        <ul>
                            <?php include "../include/blogNewComment.php" ?>

                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- //main -->
    <?php include "../include/footer.php" ?>
    <!-- //footer -->
</body>
</html>