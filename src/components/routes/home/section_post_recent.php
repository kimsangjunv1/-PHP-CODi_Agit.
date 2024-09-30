<article id="recent">
    <section class="title-container">
        <h5>BLOG 소식</h5>
        <a href="../blog/blog.php"><span>더보기</span></a>
    </section>

    <section class="contents">
        <?php
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

            $sql = "SELECT * FROM classBlog WHERE blogDelete = 0";
            $result = $connect -> query($sql);

            $viewNum = 10; // 한 페이지에 표시할 블로그 수
            $viewLimit = ($viewNum * $page) - $viewNum;

            // 전체 게시글 개수($totalCount) 출력 함수
            function msg($target) {
                echo "<p>👩🏻‍💻".$target."건의 게시물을 작성했습니다</p>";
            }

            // 블로그 게시글을 조회하는 SQL
            $sql .= " ORDER BY blogID DESC LIMIT {$viewLimit}, {$viewNum}"; // 수정: LIMIT 구문을 개선
            $result = $connect -> query($sql);

            // 전체 게시글 개수 출력
            msg($result -> num_rows);
        ?>

        <?php if ($result && $result->num_rows > 0): ?>
            <?php foreach ($result as $blog): ?>
                <div class="card">
                    <figure class="card__header">
                        <img src="../assets/blog/<?= htmlspecialchars($blog['blogImgSrc']) ?>" alt="vscode에 scss설치하기">
                        <a href="../blog/blogView.php?blogID=<?= $blog['blogID'] ?>" class="go"></a>
                        <span class="cate"><?= htmlspecialchars($blog['blogCategory']) ?></span>
                    </figure>
                    <div class="card__contents">
                        <div class="title">
                            <h3><a href="../blog/blogView.php?blogID=<?= $blog['blogID'] ?>"><?= htmlspecialchars($blog['blogTitle']) ?></a></h3>
                            <p><?= htmlspecialchars($blog['blogContents']) ?></p>
                        </div>
                        <div class="info">
                            <em class="author"><?= htmlspecialchars($blog['blogAuthor']) ?></em>
                            <span class="time"><?= date('Y-m-d', $blog['blogRegTime']) ?></span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>게시글이 없습니다.</p>
        <?php endif; ?>
    </section>
</article>