<?php
    // 최상위 경로
    $rootPath = $_SERVER['DOCUMENT_ROOT'];

    // MySQL 연결
    include $rootPath . "/connect/connect.php";
    
    $sql = "
        CREATE TABLE boardDevlog(
        postID int(10) unsigned NOT NULL auto_increment,
        memberID int(10) NOT NULL,
        postTitle varchar(50) NOT NULL,
        postContents longtext NOT NULL,
        postView int(10) NOT NULL,
        postImgFileUrl varchar(100) DEFAULT NULL,
        regTime int(20) NOT NULL,
        PRIMARY KEY (postID)
        ) charset=utf8;
    ";
    
    $result = $connect -> query($sql);

    if ( $result ) {
        echo "테이블 생성 성공 하였습니다.";
    } else {
        echo "테이블 생성에 실패 하였습니다." . $connect->error;
    }
?>