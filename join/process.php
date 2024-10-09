<?php
    // 최상위 경로
    $rootPath = $_SERVER['DOCUMENT_ROOT'];

    // MySQL 연결
    include $rootPath . "/src/components/common/component_connect.php";
    include $rootPath . "/src/components/common/component_session.php";

    // 회원가입 데이터 입력 --> 유효성 검사 --> 이메일주소/핸드폰(중복X) --> 회원가입(데이터베이스 입력)
    // 회원가입 데이터 입력 --> 유효성 검사 --> 이메일주소/핸드폰(중복O) --> 로그인 페이지 유도

    // 함수 : MSG 출력 후 이전 페이지로 이동
    function msg($message) {
        echo "
            <script>
                alert('{$message}');
                window.history.replaceState(null, null, window.location.href); // 현재 히스토리 상태를 덮어씌움
                window.location.href = '/join/form'; // 다시 보내고 싶은 페이지로 리다이렉션
            </script>
        ";
        // exit;
    };

    function isFalse($target, $message) {
        if ($target == false) {
            msg($message);
        }
    }

    $youEmail = $_POST['youEmail'];
    $youName = $_POST['youName'];
    $youPass = $_POST['youPass'];
    $youPassRecheck = $_POST['youPassRecheck'];
    $regTime = time();

    // 이메일 체크(내장 함수)
    $check_email = filter_var($youEmail, FILTER_VALIDATE_EMAIL);
    isFalse($check_email, "이메일이 잘못되었습니다.<br> 올바른 이메일을 작성해주세요");

    // 이름 유효성 검사 : 정규식 표현, 한글만, 3-5글자
    $check_name = preg_match("/^[가-힣a-zA-Z]{3,15}$/", $youName);
    isFalse($check_name, "이름은 한글 및 영문으로만 작성할 수 있어요,<br> 올바른 이름을 작성해주세요");

    // 비밀번호 유효성 검사
    $finalPass = $youPass !== $youPassRecheck;
    isFalse($check_name, "비밀번호가 일치하지 않습니다. <br> 다시 한번 확인해주세요.");

    // 휴대폰 번호 유효성 검사
    // $check_number = preg_match("/^(010|011|016|017|018|019)-[0-9]{3,4}-[0-9]{4}$/", $youPhone);
    // isFalse($check_number, "번호가 정확하지 않습니다..<br> 올바른 번호(000-0000-0000)를 작성해주세요");

    // 이메일 중복 검사
    $isEmailCheck = false;
    $dataEmail = "SELECT youEmail FROM boardMember WHERE youEmail = '$youEmail'";
    $result = $connect -> query($dataEmail);

    // 결과 조회 되었다면 count에 삽입
    if ( $result ) {
        $count = $result -> num_rows;
    } else {
        msg("이메일 검사에서 에러발생, 관리자에게 문의해주세요.");
    }
    
    // 검색된게 있는지 없는지 확인
    if ($count == 0) {
        $isEmailCheck = true;
    } else {
        msg("이미 존재하는 이메일 입니다.");
    }

    // 핸드폰 중복 검사
    // $isPhoneCheck = false;
    // $dataPhone = "SELECT youPhone FROM boardMember WHERE youPhone = '$youPhone'";
    // $result = $connect -> query($dataPhone);
    // if($result){
    //     $count = $result -> num_rows;

    //     if($count == 0){
    //         //회원가입 가능
    //         $isPhoneCheck = true;
    //     } else {
    //         //회원가입 불가능
    //         msg("이미 회원가입이 되어 있습니다. 로그인 해주세요!!");
    //         exit;
    //     }
    // } else {
    //     msg("에러발생2 : 관리자에게 문의하세요!");
    //     exit;
    // }

    // 비밀번호 암호화
    $youPass = sha1($youPass);

    // 회원유형
    // 0 : 게스트
    // 1 : 일반 유저
    // 2 : 관리자


    // 회원가입 결과
    $sql = "INSERT INTO boardMember(youEmail, youName, youPass, youGrade, regTime) VALUES('$youEmail', '$youName', '$youPass',1 , '$regTime')";
    $result = $connect -> query($sql);

    !$result ? msg("회원가입 과정에서 에러가 발생했습니다, 관리자에게 문의해주세요.") : Header("Location: /join/save");
?>