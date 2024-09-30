<?php
    // SEO
    $seo = [
        'title' => '데브로그',
        'description' => '오류해결과 관련된 팁들을 모아놨어요!',
    ];

    // 최상위 경로
    $rootPath = $_SERVER['DOCUMENT_ROOT'];

    // MySQL 연결
    include $rootPath . "/connect/connect.php";
    include $rootPath . "/connect/session.php";
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
        <main id="join">
            <section class="container-inner">
                <article>
                    <h2>회원가입</h2>
                    <p>회원가입은 1인당 1개의 이메일 계정을 이용할 수 있습니다.<br>개인정보를 수집 및 이용하며, 회원의 개인정보를 안전하게 취급하고, 교육을 목적으로 사용됩니다.</p>
                </article>

                <article>
                    <h3>개인정보 수집 및 이용에 대한 안내</h3>

                    <section class="privacy">
                        <ul>
                            <li>목적 : 가입자 개인 식별, 가입 의사 확인, 가입자와의 원활한 의사소통, 가입자와의 교육 커뮤니테이션</li>
                            <li>항목 : 아이디(이메일주소), 비밀번호, 이름, 생년월일, 휴대폰번호</li>
                            <li>보유기간 : 회원 탈퇴 시까지 보유(탈퇴일로부터 즉시 파기합니다.)</li>
                            <li>개인정보 수집에 대한 동의를 거부할 권리가 있으며, 회원 가입시 개인정보 수집을 동의함으로 간주합니다.</li>
                        </ul>
                    </section>

                    <section class="check">
                        <input type="checkbox" name="joinCheck" id="joinCheck">
                        <label for="joinCheck">약관에 동의합니다.</label>
                    </section>
                </article>
                
                <article>
                    <form action="/join/save" name="join" method="post">
                        <fieldset>
                            <legend class="blind">회원가입</legend>
                            <section>
                                <label for="youEmail">이메일</label>
                                <input type="email" id="youEmail" name="youEmail" placeholder="이메일을 적어주세요!" required>
                            </section>
                            <section>
                                <label for="youName">이름</label>
                                <input type="text" id="youName" name="youName" placeholder="이름을 적어주세요!" required>
                            </section>
                            <section>
                                <label for="youPass">비밀번호</label>
                                <input type="password" id="youPass" name="youPass" placeholder="비밀번호를 적어주세요!" required>
                            </section>
                            <section>
                                <label for="youPassC">비밀번호 확인</label>
                                <input type="password" id="youPassC" name="youPassC" placeholder="확인 비밀번호를 적어주세요!" required>
                            </section>
                            <section>
                                <label for="youPhone">휴대폰번호</label>
                                <input type="text" id="youPhone" name="youPhone" placeholder="휴대폰번호를 적어주세요!" required>
                            </section>
                            <button type="submit">회원가입 완료</button>
                        </fieldset>
                    </form>
                </article>
            </section>
        </main>
        <!-- 메인 END -->

        <!-- 푸터 -->
        <?php include $rootPath . "/src/components/layout/footer.php"?>
        <!-- 푸터 END -->
    </body>
</html>