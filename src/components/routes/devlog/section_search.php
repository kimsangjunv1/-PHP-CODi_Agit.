<div class="board__search">
    <div class="left">
        <?php
            function msg($alert){
                echo "<p>👩🏻‍💻".$alert."건의 게시물을 작성했습니다</p>";
            }
            // 전체 게시글 개수($count)
            msg($totalCount);
        ?>
        * 총 <em>21</em>건의 게시물이 등록되어 있습니다.
    </div>
    <div class="right">
        <form action="boardSearch.php" name="boardSearch" method="get">
            <fieldset>
                <legend class="blind">게시판 검색 영역</legend>
                <select name="option" id="searchOption">
                    <option value="title">제목</option>
                    <option value="content">내용</option>
                    <option value="name">등록자</option>
                </select>
                <input type="search" name="keyword" id="searchKeyword" class="input_style3" placeholder="검색어를 입력하세요!" aria-label="search" required>
                <button type="submit" >⚲</button>
                <a href="boardWrite.php" >글쓰기</a>
            </fieldset>
        </form>
    </div>
</div>