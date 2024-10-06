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

    // $isChecked = $_POST["agreement"];

    // if (!$isChecked) {
    //     echo "
    //         <script>
    //             console.log('체크');
    //             alert('동의에 체크를 해주세요.');
    //             history.back();
    //         </script>
    //     ";
    // }
?>

<!DOCTYPE html>
<html lang="ko">
    <head>
        <?php include $rootPath . "/src/components/layout/head.php"; ?>
    </head>
    
    <body>
        <!-- 메인 -->
        <main id="join">
            <section class="container-inner form">
                <form action="/join/process" name="join" method="post" class="form">
                    <fieldset>
                        <article class="header">
                            <h2>회원가입</h2>
                            <p>하단의 내용을 채워주세요.</p>
                        </article>
                
                        <article class="main">
                            <legend class="blind">회원가입</legend>
                            <section>
                                <label class="label" for="youEmail">이메일</label>
                                <input type="email" id="youEmail" name="youEmail" placeholder="이메일을 적어주세요!" class="input border" required />
                            </section>
                            <section>
                                <label class="label" for="youName">이름</label>
                                <input type="text" id="youName" name="youName" placeholder="이름을 적어주세요!" class="input border" required />
                            </section>
                            <section>
                                <label class="label" for="youPass">비밀번호</label>
                                <input type="password" id="youPass" name="youPass" placeholder="비밀번호를 적어주세요!" class="input border" required />
                            </section>
                            <section>
                                <label class="label" for="youPassC">비밀번호 확인</label>
                                <input type="password" id="youPassC" name="youPassC" placeholder="확인 비밀번호를 적어주세요!" class="input border" required />
                            </section>
                            <!-- <section>
                                <label class="label" for="youPhone">휴대폰번호</label>
                                <input type="text" id="youPhone" name="youPhone" placeholder="휴대폰번호를 적어주세요!" class="input border" required />
                            </section> -->
                        </article>

                        <article class="footer">
                            <a href="/join" class="button border lg">이전으로</a>
                            <button type="submit" class="button black lg">회원가입 완료</button>
                        </article>
                    </fieldset>
                </form>
            </section>
        </main>
        <!-- 메인 END -->

        <!-- 푸터 -->
        <?php include $rootPath . "/src/components/layout/footer.php"?>
        <!-- 푸터 END -->
    </body>
</html>