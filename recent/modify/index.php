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
        <title>게시판 수정하기</title>

        <?php include "../src/components/layout/head.php"?>

    </head>
    <body>
        <div id="skip">
            <a href="#header">헤더 영역 바로가기</a>
            <a href="#main">컨텐츠 영역 바로가기</a>
            <a href="#footer">푸터 영역 바로가기</a>
        </div>

    <?php include "../src/components/layout/header.php"?>
        <!-- /header -->

        <main id="main">
            <section id="board" class="container">
            <h2>게시판 보기 영역입니다.</h2>
                <div class="board__inner">
                    <div class="board__title">
                        <h3>게시판</h3>
                        <p> 게시판 설명이 들어갈 자리입니다.</p>
                    </div>
                    <div class="board__modify">
                    <form action="boardModifySave.php" name="boardModify" method="post">
                        <fieldset>
                            <legend>게시판 수정 영역입니다.</legend>    
    <?php
        $postID = $_GET['postID'];

        $sql = "SELECT postID, postTitle, postContents FROM boardDevlog WHERE postID = {$postID}";
        $result = $connect -> query($sql);
        
        echo "<pre style='position:fixed; top:250px; left: 50px; color:red;'>";
        var_dump($postID);
        echo "</pre>";

        if($result){
            $info = $result->fetch_array(MYSQLI_ASSOC);


            echo "<div style='display:none'><label for='postID'>번호</label><input type='text' name='postID' id='postID' value='".$info['postID']."'></div>";
            echo "<div><label for='postTitle'>제목</label><input type='text' name='postTitle' id='postTitle' value='".$info['postTitle']."'></div>";
            echo "<div><label for='postContents'>내용</label><textarea name='postContents' id='postContents' rows='20'>".$info['postContents']."</textarea></div>";
            echo "<div><label for='youPass'>비밀번호</label><input type='password' name='youPass' id='youPass' placeholder='로그인 비밀번호를 입력해주세요!'autocomplete='off' required></input></div>";
        }
    ?>
                            <!-- <div>
                                <label for="postID">번호</label>
                                <input type="text" name="postID" id="postID">
                            </div>
                            <div>
                                <label for="postTitle">제목</label>
                                <input type="text" name="postTitle" id="postTitle">
                            </div>
                            <div>
                                <label for="postContents">내용</label>
                                <textarea name="postContents" id="postContents" rows="20"></textarea>
                            </div>
                            <div>
                                <label for="boardPass">비밀번호</label> 
                                <input type="password" name="boardPass" id="boardPass" placeholder="로그인 비밀번호를 입력해주세요 :3" autocomplete="off" required></input>
                            </div> -->
                            <button type="submit" value="수정하기" >수정하기</button>
                        </fieldset>
                    </form>
                    </div>
                </div>
            </section>  
            <!-- /board -->

        </main>
        <!-- /main -->  

        
        <?php include "../src/components/layout/footer.php" ?>
        <!-- /footer -->
        
    </body>
    </html>