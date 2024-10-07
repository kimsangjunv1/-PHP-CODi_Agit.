<article id="showcase">
    <!-- 게시물 컴포넌트 -->
    <?php 
        // 필요한 데이터를 정의
        $isSearch = false;          // 찾기를 위한 컴포넌트인지
        $isVertical = true;         // 내용 표시 방향
        $limit = 5;                 // 찾을 갯수 제한
        $postQuery = "
            SELECT b.postID, b.postTitle, b.postContents, b.postCategory, m.youName, b.regTime, b.postView, b.postLike, b.postImgFileUrl
            FROM boardPost b
            JOIN boardMember m
            ON (b.memberID = m.memberID)
            ORDER BY postID DESC
        ";


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
                            <section class='contents'>
                                <div>
                                    <p>NEW</p>
                                    <div>
                                        <p class='currentSlide'>{$i}</p>
                                        <p>{$count}</p>
                                    </div>
                                </div>
                                <div class='progress'></div>
                                <h5>{$info['postTitle']}</h5>
                                <p>".strip_tags($info['postContents'])."</p>
                            </section>
                            <section class='thumbnail'>
                    ";

                    for ($e=1; $e<= 4; $e++) {
                        echo "
                            <figure>
                                <img src='" . $info['postImgFileUrl'] . "' alt='썸네일'>
                            </figure>
                        ";
                    };

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
</article>