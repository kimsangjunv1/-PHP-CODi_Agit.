<?php
    // 1.	SQL 쿼리를 미리 준비 (prepare()).
    // 2.	쿼리의 변수 자리에 바인딩할 값을 지정 (bind_param()).
    // 3.	준비된 쿼리를 실행 (execute()).

    // 최상위 경로
    $rootPath = $_SERVER['DOCUMENT_ROOT'];
    
    // MySQL 연결
    include $rootPath . "/src/components/common/component_connect.php";
    include $rootPath . "/src/components/common/component_session.php";

    header('Content-Type: application/json');
    
    $data = json_decode(file_get_contents("php://input"), true);
    $postID = $data['postID'];
    $memberID = $data['memberID'];

    // 먼저 로그인한 사용자가 이 게시물에 이미 좋아요를 눌렀는지 확인
    $sql = "SELECT * FROM boardLikes WHERE memberID = ? AND postID = ?";
    $result = $connect->prepare($sql);


    // i: 정수 (integer)
	// s: 문자열 (string)
	// d: 실수 (double)
	// b: 바이너리 데이터 (blob)
    $result -> bind_param("ii", $memberID, $postID);
    $result -> execute();
    $result = $result -> get_result();

    $isAvailiable = $result -> num_rows > 0;

    if ($isAvailiable) {
        // 이미 좋아요를 눌렀다면, 좋아요 취소
        $sql = "DELETE FROM boardLikes WHERE memberID = ? AND postID = ?";

        $result = $connect->prepare($sql);
        $result -> bind_param("ii", $memberID, $postID);
        $result -> execute();

        echo json_encode(['success' => true, 'message' => '좋아요 취소됨', 'stat' => 0]);
    } else {
        // 좋아요를 누르지 않았다면, 새로 좋아요 추가
        $sql = "INSERT INTO boardLikes (memberID, postID) VALUES (?, ?)";

        $result = $connect->prepare($sql);
        $result -> bind_param("ii", $memberID, $postID);
        $result -> execute();

        echo json_encode(['success' => true, 'message' => '좋아요 추가됨', 'stat' => 1]);
    }
?>