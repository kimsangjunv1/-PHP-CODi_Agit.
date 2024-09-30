<?php
    include "../connect/connect.php";
    
    $sql = "CREATE TABLE classMember(";
    $sql .= "memberID int(10) unsigned NOT NULL AUTO_INCREMENT,";
    $sql .= "youEmail varchar(40) UNIQUE NOT NULL,";
    $sql .= "youName varchar(10) NOT NULL,";
    $sql .= "youPass varchar(50) NOT NULL,";
    $sql .= "youPhone varchar(20) NOT NULL,";
    $sql .= "regTime int(20) NOT NULL,";
    $sql .= "PRIMARY KEY(memberID)";
    $sql .= ") CHARSET=utf8";
    
    $result = $connect -> query($sql);

    if ( $result ) {
        echo "테이블 생성 성공 하였습니다.";
    } else {
        echo "테이블 생성에 실패 하였습니다.";
    }
?>