<?php
    // 최상위 경로
    $rootPath = $_SERVER['DOCUMENT_ROOT'];

    // MySQL 연결
    include $rootPath . "/src/components/common/component_connect.php";
    
    $sql = "
        CREATE TABLE classBlog(
        blogID int(10) unsigned auto_increment,
        memberID int(10) unsigned NOT NULL,
        blogTitle varchar(255) NOT NULL,
        blogContents longtext NOT NULL,
        blogCategory varchar(20) NOT NULL,
        blogAuthor varchar(20) NOT NULL,
        blogView int(10) NOT NULL,
        blogLike int(10) NOT NULL,
        blogImgSrc varchar(100) DEFAULT NULL,
        blogImgSize varchar(100) DEFAULT NULL,
        blogDelete int(10) NOT NULL,
        blogRegTime int(20) NOT NULL,
        blogModTime int(20) DEFAULT NULL,
        PRIMARY KEY (blogID)
        ) charset=utf8;
    ";

    $result = $connect -> query($sql);

    if ( $result ) {
        echo "테이블 생성 성공 하였습니다.";
    } else {
        echo "테이블 생성에 실패 하였습니다.";
    }
?>