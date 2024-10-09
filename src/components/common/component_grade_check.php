<?php
    if ($_SESSION['youGrade'] != 2) {
        echo "
            <script>
                alert('해당 기능을 사용할 권한이 허용 되어있지 않아요.'); 
            </script>
        ";
        Header("Location: /category");
    }
?>