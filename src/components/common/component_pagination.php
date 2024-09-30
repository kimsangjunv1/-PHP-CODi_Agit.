<!-- 필요한것 -->
<!-- 테이블 명 : tableName -->

<article id="pagination">
    <ul>
        <?php
            // 총 페이지 갯수 계산
            $totalPages = max( 1, ceil($totalPosts / $viewNum) ); // 최소 1페이지

            // 현재 페이지를 기준으로 보여주고 싶은 갯수
            $pageCurrent = 5;
            $startPage = max( 1, $page - $pageCurrent );
            $endPage = min( $totalPages, $page + $pageCurrent );

            // 이전 페이지, 처음 페이지
            if ( $page > 1 ) {
                echo "
                    <li><a href='/" . $pathName . $search . "?page=1{$searchType}'>&lt;&lt;</a></li>
                    <li><a href='/" . $pathName . $search . "?page=" . ($page - 1) . "{$searchType}'>&lt;</a></li>
                ";
            }

            // 페이지 넘버 표시
            for ( $i = $startPage; $i <= $endPage; $i++ ) {
                $active = ($i == $page) ? "active" : ""; // 활성화 클래스 설정
                echo "<li class='{$active}'><a href='/" . $pathName . $search . "?page={$i}{$searchType}'>{$i}</a></li>";
            }
            
            // 다음 페이지, 마지막 페이지
            if ( $page < $totalPages ) {
                echo "
                    <li><a href='/" . $pathName . $search . "?page=" . ($page + 1) . "{$searchType}'>&gt;</a></li>
                    <li><a href='/" . $pathName . $search . "?page={$totalPages}{$searchType}'>&gt;&gt;</a></li>
                ";
            }
        ?>
    </ul>
</article>