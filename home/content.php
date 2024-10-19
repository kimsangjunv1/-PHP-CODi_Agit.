<?php include $rootPath . "/src/components/routes/home/section_post_showcase.php"; ?>
<?php include $rootPath . "/src/components/routes/home/section_post_all.php"; ?>
<?php include $rootPath . "/src/components/routes/home/section_post_tab.php"; ?>
<?php include $rootPath . "/src/components/routes/home/section_post_specific.php"; ?>
<?php include $rootPath . "/src/components/common/component_search.php"; ?>

<script type="module" defer>
    import { pageController } from "/src/assets/js/pageController.js";

    pageController.home.showcase();
    pageController.home.specific();
</script>