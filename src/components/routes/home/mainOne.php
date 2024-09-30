<?php
    $blogNewSql = "SELECT * FROM classBlog WHERE blogDelete = 0 ORDER BY blogID DESC LIMIT 1";
    $blogNewResult = $connect -> query($blogNewSql);
    foreach( $blogNewResult as $blogNew ){
?>
        <li>
            <a href="../blog/blogView.php?blogID=<?=$blogNew['blogID']?>">
                <img src="../assets/blog/<?=$blogNew['blogImgSrc']?>" alt="<?=$blogNew['blogTitle']?>">
                <em><?=$blogNew['blogTitle']?></em>
            </a>
         </li>
<?php } ?>