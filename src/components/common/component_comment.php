<?php
    // // 페이지 세팅
    // isset($_GET['page']) ? $page = (int) $_GET['page'] : $page = 1;

    // $viewNum = 10;
    // $viewLimit = ($viewNum * $page) - $viewNum;

    // // 두개의 테이블 join
    // $sql = $postQuery;

    // // 제한 갯수
    // $sql .= isset($limit) ? "LIMIT {$limit}" : "LIMIT {$viewLimit}, {$viewNum}";

    // // 내용 표시 방향
    // if (isset($isVertical)) {
    //     $direction = $isVertical ? "vertical" : "";
    // }

    // $result = $connect -> query($sql);

    // if ( $result ) {
    //     $count = $result -> num_rows;

    //     if ( $count > 0 ) {
    //         for ( $i=1; $i <= $count; $i++ ) {
    //             $info = $result -> fetch_array(MYSQLI_ASSOC);

    //             echo "
    //                 <a href='/blog/view?postID={$info['postID']}' class='item {$direction}'>
    //                     <img src='{$info['postImgFileUrl']}' alt='썸네일'>
                        
    //                     <section class='desc'>
    //                         <p class='category'>{$info['postCategory']}</p>
    //                         <h5 class='title'>{$info['postTitle']}</h5>
    //             ";

    //             if (isset($isNeedContents) && $isNeedContents) { echo "<p class='preview'>".strip_tags($info['postContents'])."</p>"; }
    //             if (isset($isNeedDate) && $isNeedDate) { echo "<p class='date'>".date('Y-m-d', $info['regTime'])."</p>"; }
                
    //             if (isset($isNeedInfo) && $isNeedInfo) { 
    //                 echo "
    //                     <div>
    //                         <p class='view'>".$info['postView']."</p>
    //                         <p class='like'>".$info['postLike']."</p>
    //                     </div>
    //                 "; 
    //             }

    //             echo "
    //                     </section>
    //                 </a>
    //             ";
    //         }
    //     } else {
    //         echo "<div class='item empty'>헉, 현재 작성된 게시물이 없어요.</div>";
    //     }
    // } else {
    //     echo "<div class='item empty'>헉, 현재 작성된 게시물이 없어요.</div>";
    // }
?>

<div class="item">
    <h6>호호호나나</h6>
    <p>안녕하세요 테스트 메세지 입니다.</p>
    <div></div>
</div>