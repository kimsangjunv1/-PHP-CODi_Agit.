<?php
    // SEO 정보 설정
    $seo = [
        'title' => 'CODi_Agit.',
        'description' => '제가 생각하고 해보고 느낀것, 좋아하는 것들을 모아놓은 아지트입니다.',
        'currentPage' => 'home'
    ];

    // 최상위 경로 설정
    $rootPath = $_SERVER['DOCUMENT_ROOT'];

    // MySQL 연결 및 세션 포함
    include $rootPath . "/src/components/common/component_connect.php";
    include $rootPath . "/src/components/common/component_session.php";

    // 필수 변수
    $isTypeAvailable = isset($_GET['type']) ? $_GET['type'] : "";
    $selectedType = $connect -> real_escape_string(trim($isTypeAvailable));

    // 동적으로 불러올 콘텐츠 파일 설정
    $pageContent = $rootPath . "/home/content.php";

    // 레이아웃 파일 포함 (메인 템플릿)
    include $rootPath . "/src/components/layout/layout.php";
?>