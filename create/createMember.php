<?php
    // 최상위 경로
    $rootPath = $_SERVER['DOCUMENT_ROOT'];

    // MySQL 연결
    include $rootPath . "/src/components/common/component_connect.php";
    
    $sql = "
        CREATE TABLE boardMember(
        memberID int(10) unsigned NOT NULL AUTO_INCREMENT,
        youEmail varchar(40) UNIQUE NOT NULL,
        youName varchar(10) NOT NULL,
        youGrade int(10) NOT NULL,
        youPass varchar(50) NOT NULL,
        regTime int(20) NOT NULL,
        PRIMARY KEY(memberID)
        ) CHARSET=utf8
    ";
    
    // youPhone varchar(20) NOT NULL,

    $result = $connect -> query($sql);

    if ( $result ) {
        echo "회원 테이블 생성 성공 하였습니다.";
    } else {
        echo "회원 테이블 생성에 실패 하였습니다.";
    }
?>