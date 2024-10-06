<?php
    // SEO
    $seo = [
        'title' => '카테고리',
        'description' => '오류해결과 관련된 팁들을 모아놨어요!',
    ];

    // 최상위 경로
    $rootPath = $_SERVER['DOCUMENT_ROOT'];

    // MySQL 연결
    include $rootPath . "/src/components/common/component_connect.php";
    include $rootPath . "/src/components/common/component_session.php";

    $myMemberID = $_SESSION['memberID'];

    $sql = "SELECT * FROM boardMember WHERE memberID = '$myMemberID'";
    $result = $connect -> query($sql);

    $info = $result -> fetch_array(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="ko">
    <head>
        <?php include $rootPath . "/src/components/layout/head.php"; ?>
    </head>

    <body>
        <!-- 스킵 -->
        <?php include $rootPath . "/src/components/common/component_skip.php"; ?>
        <!-- 스킵 END -->

        <!-- 헤더 -->
        <?php include $rootPath . "/src/components/layout/header.php"; ?>
        <!-- 헤더 END -->

        <!-- 메인 -->
        <main id="profile">
            <section class="container-inner">
                <article>
                    <h2><?=$info['youName']?>님의 회원정보</h2>
                    <p>안녕하세요 <?=$info['youName']?>님!<br>이곳에서 회원정보를 수정 할 수 있어요</p>
                </article>

                <article>
                    <div>
                        <strong>이메일</strong>
                        <span><?=$info['youEmail']?></span>
                    </div>
                    <div>
                        <strong>이름</strong>
                        <span><?=$info['youName']?></span>
                    </div>
                    <div>
                        <strong>생성일자</strong>
                        <span><?=date('Y-m-d H:i',$info['regTime'])?></span>
                    </div>
                    <!-- <div>
                        <strong>연락처</strong>
                        <span><?=$info['youPhone']?></span>
                    </div> -->
                </article>
                
                <article>
                    <a href="/profile/modify/save">저장하기</a>   
                    <a href="/profile/modify/remove">탈퇴하기</a>   
                    <a href="/login/leave">로그아웃</a>   
                </article>
            </section>
        </main>
        <!-- 메인 END -->

        <!-- 푸터 -->
        <?php include $rootPath . "/src/components/layout/footer.php"?>
        <!-- 푸터 END -->
    </body>
</html>