<?php
    header('Content-Type: application/json'); // JSON 응답을 위해 Content-Type 설정

    // 이미지 업로드 처리
    $imgInfo = $_FILES['imgFile']; // Toast UI Editor에서 보내는 파일 이름과 맞춰야 함
    $imgSize = $imgInfo['size'];
    $imgType = $imgInfo['type'];
    $imgName = $imgInfo['name'];
    $imgTmp = $imgInfo['tmp_name'];

    $eventView = 0;
    $regTime = time();

    // 함수: 이미지 사이즈 체크
    function checkImageSize($target) {
        if ($target > 1000000) { // 1MB 제한
            echo json_encode(['success' => false, 'message' => '이미지 용량이 1메가를 초과했습니다.']);
            exit;
        }
    }

    // 이미지 파일명 확인
    if (isset($imgInfo)) {
        $fileTypeExtension = explode("/", $imgType);
        $fileType = $fileTypeExtension[0];      // image
        $fileExtension = $fileTypeExtension[1]; // png, jpg, gif 등

        // 이미지 타입 확인
        if ($fileType == "image") {
            if ($fileExtension == "jpg" || $fileExtension == "jpeg" || $fileExtension == "png" || $fileExtension == "gif") {
                $imgPath = $_SERVER['DOCUMENT_ROOT'] . "/src/assets/images/storage/"; // 이미지 저장 경로
                $imgName = "Img_".time().rand(1,99999)."."."{$fileExtension}"; // 고유한 이미지 파일명 생성

                // 이미지 사이즈 확인
                checkImageSize($imgSize);

                // 이미지 업로드
                if (move_uploaded_file($imgTmp, $imgPath.$imgName)) {
                    // 업로드가 성공하면 이미지 경로 반환
                    $imageUrl = "/src/assets/images/storage/" . $imgName;
                    echo json_encode(['success' => true, 'imageUrl' => $imageUrl]);
                } else {
                    echo json_encode(['success' => false, 'message' => '이미지 업로드에 실패했습니다.']);
                }
            } else {
                echo json_encode(['success' => false, 'message' => '지원하는 이미지 파일 형식이 아닙니다.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => '이미지 파일이 첨부되지 않았습니다.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => '파일 업로드 에러']);
    }
?>