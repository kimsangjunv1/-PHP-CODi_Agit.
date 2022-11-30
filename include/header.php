<?php
    // echo "<pre style='position:fixed; top:50px; left: 50px; color:red;'>";
    // var_dump($_SESSION);
    // echo "</pre>";
?>
<header id="header">
    <div class="header__inner container">
        <div class="left">
            <a href="../index.php" class="star"><span class="ir">메인으로</span></a>
        </div>
        <h1>
            <a href="../main/main.php">PHP BLOG</a>
        </h1>
        <div class="right">
            <nav class="nav">
                <ul>
                    
                    <li><a href="../board/board.php"><span>게시판</span></a></li>
                    <li><a href="../blog/blog.php"><span>블로그</span></a></li>
                </ul>
            </nav>
            <?php if(isset($_SESSION['memberID'])){ ?>
                <ul>
                    <li><a href="../login/logout.php">로그아웃</a></li>
                    <li><a href="../mypage/mypage.php"><?=$_SESSION['youName']?>님 ✨</a></li>
                </ul>
            <?php } else { ?>
                <ul>
                    <li><a href="../join/join.php">회원가입</a></li>
                    <li><a href="../login/login.php">로그인</a></li>
                </ul>
            <?php } ?>
        </div>
        
    </div>
</header>