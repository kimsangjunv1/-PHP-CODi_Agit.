<?php
    $isNowLogin = isset($_SESSION['memberID']);
    $rootPath = $_SERVER['DOCUMENT_ROOT'];
?>

<header id="header">
    <div class="container-inner">
        <article class="contents">
            <a href="/home">
                <img src="/src/assets/images/common/img-header-logo.svg" alt="코디 아지트">
            </a>
    
            <nav class="menu">
                <section>
                    <a href="/home">홈</a>
                    <a href="/category?type=">카테고리</a>
                    <button type="button" class="btn-search-control" value=1>검색</button>
                </section>
    
                <section class="info">
                    <?php if ( $isNowLogin ) { ?>
                        <!-- <a href="/login/leave">로그아웃</a> -->
                        <a href="/profile"><?= $_SESSION['youName']?>님 ✨</a>
                    <?php } else { ?>
                        <!-- <a href="/join">회원가입</a> -->
                        <a href="/login">시작하기</a>
                    <?php } ?>
                </section>
            </nav>
        </article>

        <article class="progress-container">
            <div id="progress">
                <div class="bar"></div>
            </div>
        </article>
    </div>
</header>