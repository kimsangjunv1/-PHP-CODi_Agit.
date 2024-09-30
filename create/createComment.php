<?php
    include "../connect/connect.php";
    
    $sql = "CREATE TABLE classComment(";
    $sql .= "commentID int(10) unsigned auto_increment,";
    $sql .= "memberID int(10) NOT NULL,";
    $sql .= "blogID int(10) NOT NULL,";
    $sql .= "commentName varchar(30) NOT NULL,";
    $sql .= "commentMsg varchar(255) NOT NULL,";
    $sql .= "commentPass varchar(10) NOT NULL,";
    $sql .= "commentDelete int(10) NOT NULL,";
    $sql .= "regTime int(20) NOT NULL,";
    $sql .= "PRIMARY KEY (commentID)";
    $sql .= ") charset=utf8;";
    
    $result = $connect -> query($sql);

    if ( $result ) {
        echo "테이블 생성 성공 하였습니다.";
    } else {
        echo "테이블 생성에 실패 하였습니다.";
    }
?>