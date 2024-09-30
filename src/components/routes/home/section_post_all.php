<article id="all">
    <section class="title-container">
        <h5>게시판 소식</h5>
        <a href="../board/board.php"><span>더보기</span></a>
    </section>

    <section class="contents">
        <?php
            // 두개의 테이블 join
            $sql = "SELECT b.postID, b.postTitle, m.youName, b.regTime, b.postView 
                    FROM boardDevlog b 
                    JOIN classMember m ON (b.memberID = m.memberID) 
                    ORDER BY postID DESC 
                    LIMIT 5";

            $result = $connect->query($sql);

            if ($result && $result->num_rows > 0) {
                while ($info = $result->fetch_array(MYSQLI_ASSOC)) {
                    echo "<div class='item'>"; // 수정: backticks 대신 single quotes 사용
                    echo "<p>{$info['postID']}</p>";
                    echo "<p><a href='../board/postView.php?postID={$info['postID']}'>{$info['postTitle']}</a></p>"; // 수정: 태그 닫기 수정
                    echo "<p>{$info['youName']}</p>";
                    echo "<p>" . date('Y-m-d', $info['regTime']) . "</p>";
                    echo "<p>{$info['postView']}</p>";
                    echo "</div>";
                }
            } else {
                echo "<p>게시글이 없습니다.</p>"; // 테이블 구조 대신 일반 문장으로 출력
            }
        ?>
    </section>
</article>