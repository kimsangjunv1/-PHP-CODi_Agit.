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
            <section class="container-inner">
                <form action="/join/form" name="join" method="post" class="form">
                    <fieldset>
                        <legend class="blind">회원가입</legend>

                        <article class="header">
                            <h2>회원가입</h2>
                            <p>회원가입을 진행하기 전,<br/>하단의 내용을 참고해주세요</p>
                        </article>

                        <article class="main">
                            <section class="privacy">
                                <h3>개인정보 수집 및 이용에 대한 안내</h3>
                                <ul>
                                    <li>회원가입은 1인당 1개의 이메일 계정을 이용할 수 있습니다.</li>
                                    <li>수집하는 개인정보는 이메일, 별명, 비밀번호입니다.</li>
                                    <li>목적: 회원 식별, 가입 의사 확인, 회원과의 원활한 의사소통</li>
                                    <li>보유기간: 회원 탈퇴 시까지 보유하며, 탈퇴일로부터 즉시 파기합니다.</li>
                                    <li>개인정보 수집에 대한 동의를 거부할 권리가 있으며, 회원 가입 시 동의한 것으로 간주합니다.</li>
                                </ul>
                            </section>
    
                            <section class="check">
                                <input type="checkbox" name="agreement" id="joinCheck" value="true">
                                <label for="joinCheck">약관에 동의할게요.</label>
                            </section>
                        </article>

                        <article class="footer">
                            <a href="/login" class="button border lg">이전으로</a>
                            <button type="submit" class="button brand lg">다음으로</button>
                        </article>
                    </fieldset>
                </form>
            </section>
        </main>
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