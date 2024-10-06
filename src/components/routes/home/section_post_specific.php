<article id="programmers">
    <section class="title-container">
        <h5>프로그래머스</h5>
        <a href="/category?type=programmers">더보기</a>
    </section>

    <section class="contents">
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
                WHERE postCategory = 'programmers'
                ORDER BY postID DESC
            ";

            include $rootPath . "/src/components/common/component_post.php";
        ?>
        <!-- 게시물 컴포넌트 END -->
    </section>
</article>

<article id="tip">
    <section class="title-container">
        <h5>팁</h5>
        <a href="/category?type=tip">더보기</a>
    </section>

    <section class="contents">
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
                WHERE postCategory = 'tip'
                ORDER BY postID DESC
            ";

            include $rootPath . "/src/components/common/component_post.php";
        ?>
        <!-- 게시물 컴포넌트 END -->
    </section>
</article>