<article id="recommended">
    <?php 
        // 필요한 데이터를 정의
        $isVertical = true;
        $isSearch = false;
        $viewLimit = 3;
        
        $postQuery = "
            SELECT b.postID, b.postTitle, b.postContents, b.postCategory, m.youName, b.regTime, b.postView, b.postLike, b.postImgFileUrl
            FROM boardPost b
            JOIN boardMember m
            ON (b.memberID = m.memberID)
            WHERE postCategory = '{$info['postCategory']}'
            ORDER BY postID DESC
        ";

        include $rootPath . "/src/components/common/component_post.php";
    ?>
</article>