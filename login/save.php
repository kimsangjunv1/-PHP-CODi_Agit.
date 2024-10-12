<?php
    // 최상위 경로
    $rootPath = $_SERVER['DOCUMENT_ROOT'];

    // MySQL 연결
    include $rootPath . "/src/components/common/component_connect.php";
    include $rootPath . "/src/components/common/component_session.php";

    $youEmail = $_POST['youEmail'];
    $youPass = sha1($_POST['youPass']);
    
    function msg($target){
        echo "
            <script>
                alert('$target');
                history.back();
            </script>
        ";
    }

    // 데이터 조회
    $sql = "SELECT memberID, youEmail, youName, youPass, youGrade FROM boardMember WHERE youEmail = '$youEmail' AND youPass = '$youPass'";
    $result = $connect -> query($sql);
    
    if ($result) {
        $count = $result -> num_rows;
    } else {
        msg("에러발생 - 관리자에게 문의하세요");
    }

    if ($count == 0) {
        //로그인 실패
        msg("이메일 또는 비밀번호를 다시 확인해주세요.");
    } else {
        //로그인 성공
        $memberInfo = $result -> fetch_array(MYSQLI_ASSOC);

        //섹션 생성
        $_SESSION['memberID'] = $memberInfo['memberID'];
        $_SESSION['youEmail'] = $memberInfo['youEmail'];
        $_SESSION['youName'] = $memberInfo['youName'];
        $_SESSION['youGrade'] = $memberInfo['youGrade'];

        Header("Location: /home");
    }
?>