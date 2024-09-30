<?php
    // 두개의 테이블 join
    $sql = $postQuery;
        
    $result = $connect -> query($sql);

    if ( $result ) {
        $count = $result -> num_rows;

        if ( $count > 0 ) {
            for ( $i=1; $i <= $count; $i++ ) {
                $info = $result -> fetch_array(MYSQLI_ASSOC);

                echo "<div class='item'>";
                echo "<p>".$info['postID']."</p>";
                echo "<p><a href='view?postID={$info['postID']}'>".$info['postTitle']."</p>";
                echo "<p>".$info['youName']."</p>";
                echo "<p>".date('Y-m-d', $info['regTime'])."</p>";
                echo "<p>".$info['postView']."</p>";
                echo "</div>";
            }
        } else {
            echo "<div><p colspan='5'>게시글이 없습니다.</p></div>";
        }
    } else {
        echo "<div><p colspan='5'>게시글이 없습니다.</p></div>";
    }
?>