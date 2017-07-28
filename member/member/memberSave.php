<?php
    include "../include/dbConnect.php";
    echo "<pre>";
    echo var_dump($_POST);

    $memberId = $_POST['memberId'];
    $memberName = $_POST['memberName'];
    $memberPw = $_POST['memberPw'];
    $memberPw2 = $_POST['memberPw2'];
    $memberNickName = $_POST['memberNickName'];
    $memberEmailAddress = $_POST['memberEmailAddress'];
    $memberBirthDay = $_POST['memberBirthDay'];

    //PHP에서 유효성 재확인

    //아이디 중복검사.
    $sql = "SELECT * FROM member WHERE memberId = '{$memberId}'";
    $res = $dbConnect->query($sql);
    if($res->num_rows >= 1){
        echo '이미 존재하는 아이디가 있습니다.';
        exit;
    }
echo "아이디 패스";
    //비밀번호 일치하는지 확인
    if($memberPw !== $memberPw2){
        echo '비밀번호가 일치하지 않습니다.';
        exit;
    }else{
        //비밀번호를 암호화 처리.
        $memberPw = md5($memberPw);
    }
echo "비밀번호 패스";
    //닉네임, 생일 그리고 이름이 빈값이 아닌지
    if($memberNickName == '' || $memberBirthDay == '' || $memberName == ''){
        echo '생일혹은 닉네임의 값이 없습니다.';
        exit;
    }
echo "생일 패스";
    //이메일 주소가 올바른지
    $checkEmailAddress = filter_var($memberEmailAddress, FILTER_VALIDATE_EMAIL);

    if($checkEmailAddress != true){
        echo "올바른 이메일 주소가 아닙니다.";
        exit;
    }
echo "이메일 패스";
    //이제부터 넣기 시작
    $sql = "INSERT INTO member VALUES('','{$memberId}','{$memberName}','{$memberNickName}','{$memberPw}','{$memberEmailAddress}','{$memberBirthDay}');";
echo "에스큐엘문 성공 패스";
    if($dbConnect->query($sql)){
        echo '회원가입 성공';
    }
    else{
        echo "실패";
    }
?>

