<?php
    // 두개의 테이블 join
    if (!$isSearch) {
        $sql = $postQuery;
    };

    // 제한 갯수
    $sql .= isset($limit) ? "LIMIT {$limit}" : "LIMIT {$viewLimit}, {$viewNum}";

    // 내용 표시 방향
    $direction = isset($isVertical) ? "vertical" : "";

    $result = $connect -> query($sql);

    if ( $result ) {
        $count = $result -> num_rows;

        if ( $count > 0 ) {
            for ( $i=1; $i <= $count; $i++ ) {
                $info = $result -> fetch_array(MYSQLI_ASSOC);

                echo "
                    <a href='/category/view?postID={$info['postID']}' class='item {$direction}'>
                        <section class='thumbnail'>
                            <img src='" . $info['postImgFileUrl'] . "' alt='썸네일'>
                            
                            <section class='desc'>
                                <p class='category'>".$info['postCategory']."</p>
                                <h5>".$info['postTitle']."</h5>
                                <div>
                                    <p class='date'>".date('Y-m-d', $info['regTime'])."</p>
                                    <p class='view'>".$info['postView']."</p>
                                    <p class='like'>".$info['postLike']."</p>
                                </div>
                            </section>
                        </section>
                    </a>
                ";
            }
        } else {
            echo "<div class='item empty'>게시물이 없습니다.</div>";
        }
    } else {
        echo "<div class='item empty'>게시물이 없습니다.</div>";
    }
?>