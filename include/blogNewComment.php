<?php
    $blogNewSql = "SELECT * FROM classComment WHERE commentDelete = 0 ORDER BY blogID DESC LIMIT 4";
    // $sql = "SELECT b.blogID  FROM classBlog b JOIN classMember m ON(b.memberID = m.memberID)  WHERE commentDelete = 0 ORDER BY blogID DESC LIMIT 4";
    $blogNewResult = $connect -> query($blogNewSql);
    foreach( $blogNewResult as $blogNew ){
?>
        <li>
            <a href="blogView.php?blogID=<?=$blogNew['blogID']?>">
                <img src="../assets/blog/card_bg_01.png" alt="<?=$blogNew['blogTitle']?>">
                <div class="comment_desc">
                    <p><?=$blogNew['commentName']?></p>
                    <em><?=$blogNew['commentMsg']?></em>
                </div>
            </a>
         </li>
<?php } ?>