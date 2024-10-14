<?php
    // 최상위 경로
    $rootPath = $_SERVER['DOCUMENT_ROOT'];

    // MySQL 연결
    include $rootPath . "/src/components/common/component_connect.php";

    $sql = "
        CREATE TABLE boardCategory (
        categoryID int(10) NOT NULL AUTO_INCREMENT,
        categoryTitleKor varchar(150) NOT NULL,
        categoryTitleEng varchar(150) NOT NULL,
        categoryDescription varchar(255) NOT NULL,
        categoryUsageCount int(10) NOT NULL DEFAULT 0,
        categoryOrder int(10) NOT NULL DEFAULT 0,
        categoryStatus int(10) NOT NULL DEFAULT 1,
        modTime TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        regTime TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY(categoryID)
        )
    ";

    $result = $connect -> query($sql);

    if ( $result ) {
        echo "카테고리 테이블 생성을 성공 하였습니다.";
    } else {
        echo "테이블 생성에 실패 하였습니다." . $connect->error;
    }
?>