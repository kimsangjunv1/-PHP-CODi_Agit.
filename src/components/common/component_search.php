<?php
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // 페이지 정보 저장
    $viewNum = 10;                                         // 게시물 갯수
    $viewLimit = ($viewNum * $page) - $viewNum;            // 제한
    // 게시물 개수를 세기 위한 SQL 쿼리. 'boardPost' 테이블에서 'postID' 필드의 개수를 셈.
    $sql = $postQuery;

    // 특정 키워드 검색 여부
    if ($isSearch) {
        $search = "/search";

        $searchKeyword = $connect -> real_escape_string(trim($_GET['keyword']));
        $searchOption = $connect -> real_escape_string(trim($_GET['option']));
        $searchType = "&keyword={$searchKeyword}&option={$searchOption}";

        switch($searchOption){
            case "title" : 
                $searchWhere = "WHERE b.postTitle";
                break;

            case "content" : 
                $searchWhere = "WHERE b.postContents";
                break;

            case "name" : 
                $searchWhere = "WHERE m.youName";
                break;
        };
        
        $sql .= "
            {$searchWhere}
            LIKE '%{$searchKeyword}%'
            {$orderRule}
        ";

        $postQuery .= "
            {$searchWhere}
            LIKE '%{$searchKeyword}%'
            {$orderRule}
        ";
    } else {
        $search = "";
        $searchType = "";
    };

    $sql .= "
        LIMIT {$viewLimit}, {$viewNum}
    ";

    // 쿼리를 실행하고 결과를 `$result`에 저장.
    $result = $connect -> query($sql);
?>

<article id="search">
    <form action="/<?= $currentPath ?>/search" name="search" method="get">
        <fieldset>
            <legend class="blind">게시판 검색 영역</legend>
            
            <!-- 키워드 설정 -->
            <?php
                if (isset($select) && is_array($select)) {
                    echo "<select name='option' class='button border sm'>";

                    for ($i = 0; $i < count($select); $i++) {
                        echo "<option value='".htmlspecialchars($select[$i]["title"])."'>".htmlspecialchars($select[$i]["desc"])."</option>";
                    };

                    echo "</select>";
                }
            ?>
            <!-- 키워드 설정 END -->

            <input type="search" name="keyword" id="keyword" placeholder="<?= htmlspecialchars($placeholder) ?>" aria-label="search" class="input border" required>
            <button type="submit" class="button black lg"><?= $title ?></button>
            
            <?php
                if (isset($_SESSION['memberID'])) {
                    echo "<a href='/{$currentPath}/write' class='button border lg'>글쓰기</a>";
                };
            ?>
            
        </fieldset>
    </form>
</article>