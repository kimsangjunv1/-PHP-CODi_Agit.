<!-- TITLE -->
<title><?php echo $seo["title"]; ?> | 코디 아지트.</title>

<!-- META -->
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />

<!-- 반응형 -->
<meta content="yes" name="apple-mobile-web-app-capable" />
<meta name="author" content="CODi">
<meta name="description" content="<?php echo $seo["description"]; ?>">
<meta name="keyword" content="개발, 웹, 블로그, 김상준, 웹 프론트엔드, 2024">
<meta name="robots" content="all">

<!-- CSS -->
<link rel="stylesheet" href="/src/assets/css/index.min.css">
<link rel="icon" type="image/svg+xml" href="/src/assets/images/common/favicon.svg" />

<!-- 스크립트 -->
<script src="https://unpkg.com/lenis@1.1.13/dist/lenis.min.js"></script>
<script type="module" defer>
    import { pageController } from "/src/assets/js/pageController.js";

    // pageController.common.setScrollSmoother();
    pageController.common.setResizeElementOnScroll();
    pageController.layout.setCurrentProgressBar();
</script>