// ----------------------------------------
    $imgInfo = $_FILES['eventFile'];
    $imgSize = $imgInfo['size'];
    $imgType = $imgInfo['type'];
    $imgName = $imgInfo['name'];
    $imgTmp = $imgInfo['tmp_name'];

    $eventView = 0;
    $regTime = time();

    // 함수 : 이미지 사이즈 체크
    function checkImageSize($target){
        if ($target > 1000000) {
            echo "<script>alert('이미지 용량이 1메가를 초과했습니다.'); history.back(1)</script>";
            exit;
        }   
    }

    // 이미지 파일명 확인
    if (isset($imgInfo)) {
        $fileTypeExtension = explode("/", $imgType);
        $fileType = $fileTypeExtension[0];      //image
        $fileExtension = $fileTypeExtension[1]; //png

        //이미지 타입 확인
        if ($fileType == "image") {
            if ($fileExtension == "jpg" || $fileExtension == "jpeg" || $fileExtension == "png" || $fileExtension == "gif") {
                $imgPath = $rootPath . "/src/assets/images/storage";
                $imgName = "Img_".time().rand(1,99999)."."."{$fileExtension}";

                $imgInfo = "$imgName";
            } else {
                echo "<script>alert('지원하는 이미지 파일이 아닙니다.'); history.back(1)</script>";
            }
        } else {
            echo "이미지 파일을 첨부하지 않았습니다.";

            $imgInfo = "Img_default.jpg";
        }

        $sql = "
            INSERT INTO myEvent(myMemberID, eventTitle, eventSection, eventContents, eventImgFile, eventImgSize, eventView, regTime)
            VALUES('$myMemberID', '$eventTitle', '$eventSection', '$eventContents', '$imgInfo', '$imgSize', '$eventView', '$regTime')
        ";
    }

    //이미지 사이즈 확인
    checkImageSize($imgSize);

    $result = $connect -> query($sql);
    $result = move_uploaded_file($eventImgTmp, $imgPath.$imgName);

    // ----------------------------------------