<article id="search" class="none">
    <form action="/search/?type=" name="search" method="POST">
        <fieldset>
            <legend class="blind">게시판 검색 영역</legend>

            <select name="option" class="button border sm">
                <option value="title" selected>제목</option>
                <option value="content">내용</option>
                <option value="name">작성자</option>
            </select>

            <input type="search" name="keyword" placeholder="검색어를 입력해주세요." aria-label="search" class="input border">
            <button type="submit" class="button black lg">검색</button>
            <button type="button" class="btn-search-control" value=0>닫기</button>
        </fieldset>
    </form>
</article>