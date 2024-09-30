<?php
    // echo "<pre style='position:fixed; top:50px; left: 50px; color:red;'>";
    // echo "<p>로그인 상태</p>";
    // var_dump($_SESSION);
    // echo "</pre>";
    
    $isNowLogin = isset($_SESSION['memberID']);
    $rootPath = $_SERVER['DOCUMENT_ROOT'];
?>

<header id="header">
    <div class="container-inner">
        <a href="/home">
            <img src="/src/assets/images/common/img-header-logo.webp" alt="코디 피드">
        </a>

        <nav>
            <section class="menu">
                <a href="/home"><span>홈</span></a>
                <a href="/devlog"><span>데브로그</span></a>
            </section>

            <section class="info">
                <?php if ( $isNowLogin ) { ?>
                    <a href="/login/leave">로그아웃</a>
                    <a href="/mypage/mypage.php"><?= $_SESSION['youName']?>님 ✨</a>
                <?php } else { ?>
                    <a href="/join">회원가입</a>
                    <a href="/login">로그인</a>
                <?php } ?>
            </section>
        </nav>
    </div>
</header>