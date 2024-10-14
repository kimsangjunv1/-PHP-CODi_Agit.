<?php
    // 최상위 경로
    $rootPath = $_SERVER['DOCUMENT_ROOT'];

    // MySQL 연결
    include $rootPath . "/src/components/common/component_connect.php";
    
    $sql = "
        CREATE TABLE boardComment(
        postID int(10) NOT NULL,
        memberID int(10) NOT NULL,
        commentID int(10) unsigned auto_increment,
        commentName varchar(30) NOT NULL,
        commentMsg varchar(255) NOT NULL,
        commentPass varchar(10) NOT NULL,
        commentDelete int(10) NOT NULL,
        modTime int(20) NOT NULL,
        regTime int(20) NOT NULL,
        PRIMARY KEY (commentID)
        ) charset=utf8;
    ";
    
    $result = $connect -> query($sql);

    if ( $result ) {
        echo "댓글 테이블 생성 성공 하였습니다.";
    } else {
        echo "댓글 테이블 생성에 실패 하였습니다.";
    }
?>