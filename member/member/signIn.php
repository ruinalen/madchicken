<?php
    include "../include/session.php";
    include "../include/dbConnect.php";
    /*echo "<pre>";
    var_dump($_POST);*/
    $memberId = $_POST['memberId'];
    $memberPw = md5($memberPw = $_POST['memberPw']);


    $sql = "SELECT * FROM member WHERE memberId = '{$memberId}' AND password = '{$memberPw}'";
    $res = $dbConnect->query($sql);


        $row = $res->fetch_array(MYSQLI_ASSOC);


        if ($row != null) {
            $_SESSION['ses_userid'] = $row['memberId'];
            $_SESSION['ses_perm'] = $row['permission'];
            echo $_SESSION['ses_perm'];
            echo $_SESSION['ses_userid'].'님 안녕하세요';
            echo "<a href='./signOut.php'>로그아웃 하기</a>";
        }

        if($row == null){
            echo '<script> history.back();</script>';}
?>



