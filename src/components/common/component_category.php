<?php
    $sql = "
        SELECT categoryID, categoryTitleKor, categoryTitleEng, categoryDescription, categoryUsageCount, categoryStatus, categoryOrder
        FROM boardCategory
        ORDER BY categoryOrder ASC
    ";

    $result = $connect -> query($sql);
    $categoryCount = $result -> num_rows;
    
    if ($categoryCount > 0) {
        for ($i=0; $i < $categoryCount; $i++) {
            $categoryList = $result -> fetch_array(MYSQLI_ASSOC);

            switch ($option) {
                case 'anchor':
                    echo "<a href='/{$path}/?type={$categoryList['categoryTitleEng']}' class='" . ($selectedType == $categoryList['categoryTitleEng'] ? 'active' : '') . "' data-category='{$categoryList['categoryTitleEng']}'>{$categoryList['categoryTitleKor']}</a>";
                    break;

                case 'button':
                    echo "<button value='{$categoryList['categoryTitleEng']}'>{$categoryList['categoryTitleKor']}</button>";
                    break;

                case 'option':
                    echo "<option value='{$categoryList['categoryTitleEng']}' " . ($selectedType == $categoryList['categoryTitleEng'] ? 'selected' : '') . " >{$categoryList['categoryTitleKor']}</option>";
                    break;
                
                default:
                    echo "<a href='/blog/?type={$categoryList['categoryTitleEng']}'>{$categoryList['categoryTitleKor']}</a>";
                    break;
            }
        };
    } else {
        echo "<p>생성된 카테고리가 없습니다.</p>";
    }
?>