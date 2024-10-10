<meta charset="UTF-8" />
<link rel="icon" type="image/svg+xml" href="/src/assets/images/common/favicon.ico" />

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />

<!-- 반응형 -->
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta content="yes" name="apple-mobile-web-app-capable" />
<!-- 반응형 END -->

<meta itemprop="name" content="코디 아지트" />
<meta name="Date" content="2024-01-14T18:33:13+09:00" />
<meta name="title" content="코디 아지트" />
<meta name="robots" content="index, follow" />
<meta name="author" content="CODi" />
<meta name="keywords" content="블로그, blog, 디자인, 개발, 프론트엔드, CODi" />
<meta name="description" content="<?php echo $seo["description"]; ?>">
<meta name="language" content="ko" />
<meta name="publisher" content="CODi" />
<meta name="msapplication-TileColor" content="#ffffff" />
<meta name="theme-color" content="#ffffff" />

<!-- OG 태그 -->
<meta property="og:url" content="https://codi-agit.com/" />
<meta property="og:title" content="코디 아지트" />
<meta property="og:description" content="<?php echo $seo["description"]; ?>" />
<meta property="og:site_name" content="코디 아지트" />
<meta property="og:type" content="website" />
<meta property="og:image" content="https://codi-agit.com/src/assets/images/common/img-og-thumbnail.png">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<!-- OG 태그 END -->

<!-- 트위터 태그 -->
<meta name="twitter:card" content="summary" />
<meta name="twitter:title" content="코디 아지트" />
<meta name="twitter:description" content="<?php echo $seo["description"]; ?>" />
<!-- 트위터 태그 END -->

<link rel="canonical" href="https://codi-agit.com/">

<meta name="google-site-verification" content="qlarp5kejHuLMiw9Co82-ZLSGQVUy6D6ZAQUURM_UJI" />
<meta name="naver-site-verification" content="904a6acfc526c8b6a22b2b3e3a9cc5ed4652f366" />

<title><?php echo $seo["title"]; ?> | 코디 아지트.</title>

<!-- CSS -->
<link rel="stylesheet" href="/src/assets/css/index.min.css">

<!-- 스크립트 -->
<script src="https://unpkg.com/lenis@1.1.13/dist/lenis.min.js"></script>
<script type="module" defer>
    import { pageController } from "/src/assets/js/pageController.js";

    // pageController.common.setScrollSmoother();
    pageController.common.setResizeElementOnScroll();
    pageController.layout.showSearchContainer();
    pageController.layout.setCurrentProgressBar();
</script>