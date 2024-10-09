<article id="search" class="<?php echo isset($isSearchRoute) && $isSearchRoute ? 'unfixed' : 'none' ?>" >
    <form action="/search/?type=" name="search" method="POST">
        <fieldset>
            <legend class="blind">게시판 검색 영역</legend>
            <button type="button" class="btn-search-control <?php echo $isSearchRoute ? 'none' : '' ?> " value=0>
                <img src="/src/assets/images/icon/ico-close.svg" alt="닫기">
            </button>

            <a href="/home">
                <img src="/src/assets/images/common/img-logo-white.svg" alt="코디 아지트">
            </a>

            <div>
                <select name="option" class="select">
                    <option value="title" selected>제목</option>
                    <option value="content">내용</option>
                    <option value="name">작성자</option>
                </select>
    
                <input type="search" name="keyword" placeholder="검색어를 입력해주세요." aria-label="search" class="input border w-auto">
                <button type="submit" class="button brand lg w-auto">검색</button>
            </div>
        </fieldset>
    </form>
</article>