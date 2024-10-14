<article class="specific">
    <section class="contents">
        <!-- 게시물 컴포넌트 -->
        <?php
            $isNeedContents = true;
            $isNeedDate = true;
            $limit = 5;                 // 찾을 갯수 제한

            if ($selectedType) {
                $postQuery = "
                    SELECT b.postID, b.postTitle, b.postContents, b.postCategory, m.youName, b.regTime, b.postView, b.postLike, b.postImgFileUrl
                    FROM boardPost b
                    JOIN boardMember m
                    ON (b.memberID = m.memberID)
                    WHERE postCategory = '{$selectedType}'
                    ORDER BY postID DESC
                ";
            } else {
                $postQuery = "
                    SELECT b.postID, b.postTitle, b.postContents, b.postCategory, m.youName, b.regTime, b.postView, b.postLike, b.postImgFileUrl
                    FROM boardPost b
                    JOIN boardMember m
                    ON (b.memberID = m.memberID)
                    ORDER BY postID DESC
                ";
            }
            
            include $rootPath . "/src/components/common/component_post.php";
        ?>
        <!-- 게시물 컴포넌트 END -->
    </section>
</article>