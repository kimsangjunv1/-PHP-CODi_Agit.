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

    $memberID = $_SESSION['memberID'];
    $grade = $_SESSION['youGrade'];

    $isGuest = $grade == 0;

    $sql = "SELECT * FROM boardMember WHERE memberID = '$memberID'";
    $result = $connect -> query($sql);

    $info = $result -> fetch_array(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="ko">
    <head>
        <?php include $rootPath . "/src/components/layout/head.php"; ?>
    </head>

    <body>
        <?php include $rootPath . "/src/components/layout/header.php"; ?>

        <main id="profile">
            <section class="container-inner">
                <?php
                    if (!$isGuest) {
                        echo "
                            <article class='info'>
                                <h2>회원정보</h2>
                                <p>안녕하세요 {$info['youName']}님!<br>이곳에서 회원정보를 수정 할 수 있어요</p>
                            </article>

                            <article class='details'>
                                <div>
                                    <strong class='label'>이메일</strong>
                                    <span>{$info['youEmail']}</span>
                                </div>
                                <div>
                                    <strong class='label'>이름</strong>
                                    <span>{$info['youName']}</span>
                                </div>
                                <div>
                                    <strong class='label'>생성일자</strong>
                                    <span>" . date('Y-m-d H:i',$info['regTime']) . "</span>
                                </div>
                            </article>
                        ";
                    } else {
                        echo "
                            <article class='alert'>
                                <p>게스트 로그인은 회원정보 수정을 지원하지 않아요.</p>
                            </article>
                        ";
                    }
                ?>

                <article class="manage">
                    <?php
                        $option="button";
                        
                        include $rootPath . "/src/components/common/component_category.php";
                    ?>

                    <form 
                        action="/category/save" 
                        method="POST"
                    >
                        <fieldset>
                            <legend class="blind">카테고리 추가 폼</legend>

                            <section>
                                <label for="titleKor" class="label">한국어</label>
                                <input name="categoryTitleKor" id="titleKor" type="text">
                            </section>

                            <section>
                                <label for="titleEng" class="label">영어</label>
                                <input name="categoryTitleEng" id="titleEng" type="text">
                            </section>

                            <section>
                                <label for="description" class="label">설명</label>
                                <input name="categoryDescription" id="description" type="text">
                            </section>

                            <button type="submit" class="button border lg">추가하기</button>
                        </fieldset>
                    </form>
                </article>

                <article class="state">
                    <?php
                        // if (!$isGuest) {
                        //     echo "
                        //         <a href='/profile/modify/save' class='button brand lg'>저장하기</a>
                        //     ";
                        // };
                    ?>
                    <a href='/login/leave' class='button border lg'>로그아웃</a>
                </article>

                <article class="remove">
                    <?php
                        if (!$isGuest) {
                            echo "
                                <form action='/profile/modify/remove' method='POST'>
                                    <fieldset>
                                        <legend class='blind'>회원 삭제 영역</legend>
                                        <input type='text' name='userAnswer' placeholder='`삭제하겠습니다.`를 입력해주세요.' class='input border'>
                                        <button type='submit' class='button red lg'>탈퇴하기</button>
                                    </fieldset>
                                </form>
                            ";
                        };
                    ?>
                </article>
            </section>
        </main>
        
        <?php include $rootPath . "/src/components/layout/footer.php"?>
        <?php include $rootPath . "/src/components/common/component_skip.php"; ?>
    </body>
</html>