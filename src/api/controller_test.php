<?php
    // 최상위 경로
    $rootPath = $_SERVER['DOCUMENT_ROOT'];
    
    // 공통 파일 포함
    include_once $rootPath . "/src/components/common/component_connect.php";
    include_once $rootPath . "/src/components/common/component_session.php";
    include_once $rootPath . "/src/components/common/component_cors.php";

    // SQL 실행
    $sql = "SELECT * FROM boardLikes;";
    $result = $connect->query($sql);

    // 결과 처리
    if ($result) {
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        // JSON 출력
        header("Content-Type: application/json; charset=UTF-8");
        echo json_encode($data);
    } else {
        // 에러 응답
        http_response_code(500);
        echo json_encode(["error" => $connect->error]);
    }
?>