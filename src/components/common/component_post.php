<?php
    // 페이지 세팅
    isset($_GET['page']) ? $page = (int) $_GET['page'] : $page = 1;

    $viewNum = 10;
    $viewLimit = ($viewNum * $page) - $viewNum;

    // 두개의 테이블 join
    $sql = $postQuery;

    // 제한 갯수
    $sql .= isset($limit) ? "LIMIT {$limit}" : "LIMIT {$viewLimit}, {$viewNum}";

    // 내용 표시 방향
    if (isset($isVertical)) {
        $direction = $isVertical ? "vertical" : "";
    }

    $result = $connect -> query($sql);

    if ( $result ) {
        $count = $result -> num_rows;

        if ( $count > 0 ) {
            for ( $i=1; $i <= $count; $i++ ) {
                $info = $result -> fetch_array(MYSQLI_ASSOC);

                echo "
                    <a href='/category/view?postID={$info['postID']}' class='item {$direction}'>
                        <img src='{$info['postImgFileUrl']}' alt='썸네일'>
                        
                        <section class='desc'>
                            <p class='category'>{$info['postCategory']}</p>
                            <h5 class='title'>{$info['postTitle']}</h5>
                ";

                if (isset($isNeedContents) && $isNeedContents) { echo "<p class='preview'>".strip_tags($info['postContents'])."</p>"; }
                if (isset($isNeedDate) && $isNeedDate) { echo "<p class='date'>".date('Y-m-d', $info['regTime'])."</p>"; }
                
                if (isset($isNeedInfo) && $isNeedInfo) { 
                    echo "
                        <div>
                            <p class='view'>".$info['postView']."</p>
                            <p class='like'>".$info['postLike']."</p>
                        </div>
                    "; 
                }

                echo "
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