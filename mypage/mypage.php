<?php
    include "../connect/connect.php";
    include "../connect/session.php";
    include "../connect/sessionCheck.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP 사이트 만들기</title>

    <?php include "../include/head.php"?>
</head>
<body>
    <div id="skip">
        <a href="#header">헤더 영역 바로가기</a>
        <a href="#main">컨텐츠 영역 바로가기</a>
        <a href="#footer">푸터 영역 바로가기</a>
    </div>
    <!-- //skip -->

    <?php include "../include/header.php"?>
    <!-- header -->
    
    <main id="main" class="container">
<?php
    $myMemberID = $_SESSION['memberID'];

    $sql = "SELECT * FROM classMember WHERE memberID = '$myMemberID'";
    $result = $connect -> query($sql);

    $info = $result -> fetch_array(MYSQLI_ASSOC);
?>
        <section id="mypage" class="section">
            <div class="menu_mypage_cont">
                <h2><?=$info['youName']?>님의 회원정보</h2>
                <p>안녕하세요 <?=$info['youName']?>님!<br>이곳에서 회원정보를 수정 할 수 있어요</p>
            </div>
            <div class="mypage_cont">
                <div class="mypage_info">
                    <img class="profile_img" src="../assets/blog/card_bg_01.png" alt="s">

                    <div class="profile_desc">
                        <div class="intro">
                            안녕하세요 공부를 위해 앞으로도 열심히 해보겠습니다~!
                        </div>
                        <ul>
                            <li>
                                <strong>이메일</strong>
                                <span><?=$info['youEmail']?></span>
                            </li>
                            <li>
                                <strong>이름</strong>
                                <span><?=$info['youName']?></span>
                            </li>
                            <!-- <li>
                                <strong>닉네임</strong>
                                <span>리치클럽</span>
                            </li> -->
                            <li>
                                <strong>생성일자</strong>
                                <span><?=date('Y-m-d H:i',$info['regTime'])?></span>
                            </li>
                            <li>
                                <strong>연락처</strong>
                                <span><?=$info['youPhone']?></span>
                            </li>
                            <!-- <li>
                                <strong>성별</strong>
                                <span>남자</span>
                            </li>
                            <li>
                                <strong>웹 사이트</strong>
                                <span></span>
                            </li> -->
                        </ul>
                    </div>
                    
                </div>
                <div class="btn">
                    <a href="mypageModify.php">수정하기 <em>이곳을 통해 회원정보를 수정 할 수 있어요 :0</em></a>   
                    <a href="../login/logout.php">로그아웃 <em>안전하게 로그아웃 해주세요 :)</em></a>   
                    <a href="mypageRemove.php">탈퇴하기 <em>아쉽지만 다음에 또 만나요 :X</em></a>   
                </div>
            </div>
        </section>
    </main>
    <!-- //main -->

    <?php include "../include/footer.php"?>
    <!-- footer -->
</body>

</html>