<?php
    // 최상위 경로
    $rootPath = $_SERVER['DOCUMENT_ROOT'];

    // MySQL 연결
    include $rootPath . "/src/components/common/component_connect.php";
    
    $sql = "
        CREATE TABLE boardLikes(
        likeID int(10) unsigned NOT NULL auto_increment,
        postID int(10) NOT NULL,
        memberID int(10) NOT NULL,
        regTime TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (likeID)
        )DEFAULT CHARSET=utf8;
    ";
    
    $result = $connect -> query($sql);

    if ( $result ) {
        echo "좋아요의 테이블 생성을 성공 하였습니다.";
    } else {
        echo "테이블 생성에 실패 하였습니다." . $connect->error;
    }
?>