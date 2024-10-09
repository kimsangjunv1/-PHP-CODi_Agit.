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
?>

<!DOCTYPE html>
<html lang="ko">
    <head>
        <?php include $rootPath . "/src/components/layout/head.php"; ?>
    </head>
    
    <body>
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
                                <input type="email" name="youEmail" placeholder="이메일을 적어주세요!" class="input border" required />
                            </section>
                            <section>
                                <label class="label" for="youName">별명</label>
                                <input type="text" name="youName" placeholder="별명을 적어주세요!" class="input border" required />
                            </section>
                            <section>
                                <label class="label" for="youPass">비밀번호</label>
                                <input type="password" name="youPass" placeholder="비밀번호를 적어주세요!" class="input border" required />
                            </section>
                            <section>
                                <label class="label" for="youPassRecheck">비밀번호 확인</label>
                                <input type="password" name="youPassRecheck" placeholder="확인 비밀번호를 적어주세요!" class="input border" required />
                            </section>
                            <!-- <section>
                                <label class="label" for="youPhone">휴대폰번호</label>
                                <input type="text" id="youPhone" name="youPhone" placeholder="휴대폰번호를 적어주세요!" class="input border" required />
                            </section> -->
                        </article>

                        <article class="footer">
                            <a href="/join" class="button border lg">이전으로</a>
                            <button type="submit" class="button brand lg">가입하기</button>
                        </article>
                    </fieldset>
                </form>
            </section>
        </main>
    </body>
</html>