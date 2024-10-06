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
        <!-- 메인 -->
        <main id="join">
            <section class="container-inner">
                <form action="/join/form" name="join" method="post" class="form">
                    <fieldset>
                        <legend class="blind">회원가입</legend>

                        <article class="header">
                            <h2>회원가입</h2>
                            <p>회원가입은 1인당 1개의 이메일 계정을 이용할 수 있습니다.<br>개인정보를 수집 및 이용하며, 회원의 개인정보를 안전하게 취급하고, 교육을 목적으로 사용됩니다.</p>
                        </article>

                        <article class="main">
                            <section class="privacy">
                                <h3>개인정보 수집 및 이용에 대한 안내</h3>
                                <ul>
                                    <li>목적 : 가입자 개인 식별, 가입 의사 확인, 가입자와의 원활한 의사소통, 가입자와의 교육 커뮤니테이션</li>
                                    <li>항목 : 아이디(이메일주소), 비밀번호, 이름, 생년월일, 휴대폰번호</li>
                                    <li>보유기간 : 회원 탈퇴 시까지 보유(탈퇴일로부터 즉시 파기합니다.)</li>
                                    <li>개인정보 수집에 대한 동의를 거부할 권리가 있으며, 회원 가입시 개인정보 수집을 동의함으로 간주합니다.</li>
                                </ul>
                            </section>
    
                            <section class="check">
                                <input type="checkbox" name="agreement" id="joinCheck" value="true">
                                <label for="joinCheck">약관에 동의합니다.</label>
                            </section>
                        </article>

                        <article class="footer">
                            <a href="/login" class="button border lg">이전으로</a>
                            <button type="submit" class="button black lg">다음</button>
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
    <script defer>
        const elementForm = document.querySelector("form");
        const elementSubmit = elementForm.querySelector(".footer button");
        const elementCheckBox = elementForm.querySelector(".main input[type='checkbox']");
        
        elementSubmit.addEventListener("click", (event) => {
            let isChecked = elementCheckBox.checked;

            if (!isChecked) {
                event.preventDefault();
                alert("체크를 해주세요");
            }
        })

    </script>
</html>