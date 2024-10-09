<article id="tab">
    <a href="/<?php echo $pathName ?>/?type=" class="<?= $selectedType == '' ? 'active' : '' ?>">전체보기</a>
    <a href="/<?php echo $pathName ?>/?type=js" class="<?= $selectedType == 'js' ? 'active' : '' ?>">자바스크립트</a>
    <a href="/<?php echo $pathName ?>/?type=programmers" class="<?= $selectedType == 'programmers' ? 'active' : '' ?>">프로그래머스</a>
    <a href="/<?php echo $pathName ?>/?type=tip" class="<?= $selectedType == 'tip' ? 'active' : '' ?>">팁</a>
</article>