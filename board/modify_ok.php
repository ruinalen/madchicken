<?
include "lib/bm_dbconfig.php"; // DB 연결을 위한 환경 파일
include "lib/bm_function.php"; // 사용자 정의 함수

$connect = bm_dbconnect($host, $db_id, $db_passwd, $db_name); // MySQL DB 연결(사용자 정의 함수 bm_dbconnect 이용)

//수정폼(modify.php)에서 전송된 내용을 변수에 담습니다. 
$name = addslashes($name);
$password = addslashes($password);
$email = addslashes($email);
$homepage = addslashes($homepage);
$subject = addslashes($subject);
$memo = addslashes($memo);

//디폴트 값이 필요한 변수에는 디폴트 값을 넣습니다. 
$tablename = $id; //테이블 이름
$writetime = time();
//$ip = getenv("REMOTE_ADDR"); 

//비밀번호가 맞는지 확인합니다.
//$sql = "select number from $tablename where number=$number and password='$password'";
//$result = mysql_query($sql) or die (mysql_error());


if ($HTTP_COOKIE_VARS[cook_userlevel] != '' && $HTTP_COOKIE_VARS[cook_userlevel] != '1') { // 로그인한 사용자(회원)일 경우
    //일반 회원일 경우
    $sql = "select number from $tablename where number=$number and memberid='$HTTP_COOKIE_VARS[cook_userid]'"; // 글을 쓴 사람과 현재 삭제하려는 사람이 동일인인지 비교
    $result = mysql_query($sql) or die (mysql_error());
    if (!mysql_num_rows($result)) { // 반환된 값이 없으면
        bm_error("자신의 글 이외에는 수정할 수 없습니다.");
    }
} elseif ($HTTP_COOKIE_VARS[cook_userlevel] == '1') { // 관리자일 경우
    $sql = "select number from $tablename where number=$number";
    $result = mysql_query($sql) or die (mysql_error());
    if (!mysql_num_rows($result)) { // 반환된 값이 없으면
        bm_error("관리자 수정 오류");
    }
} else { // 로그인하지 않은 경우
    //비밀번호가 맞는지 확인합니다.
    $sql = "select number from $tablename where number=$number and password='$password'";
    $result = mysql_query($sql) or die (mysql_error());
    if (!mysql_num_rows($result)) { // 반환된 값이 없으면
        bm_error("비밀번호가 틀립니다");
    }
}


if (mysql_num_rows($result)) {  //반환된 열이 있으면...


################파일 업로드를 위해 추가된 부분 : 시작 #########################

// 업로드한 파일이 저장될 디렉토리 정의
    $target_dir = "up";  // 서버에 up 이라는 디렉토리가 있어야 한다.

// if($upfile != '') {   // 파일이 업로드되었을 경우
//if(strcmp($upfile,"none") && $upfile !='') {   // 파일이 업로드되었을 경우

    for ($num = 1; $num <= 3; $num++) { // 업로드한 파일이 최대 3개일 경우

        $upfile = ${"upfile" . $num}; // 업로드된 임시 파일 이름
        $upfile_name = ${"upfile" . $num . "_name"}; // 실제 파일 이름

        if (!(strcmp($upfile, "") && strcmp($upfile, "none"))) {    //$upfile이 ""이면 0, 아니면 1이 됨. 따라서 업로드되지 않았을 경우에 strcmp 결과는 0이 되고, !strcmp 이므로 if 조건문은 1이 되어 참이 됨. 으~ 복잡해라. 한마디로 파일이 업로드되지 않았을 경우 아래 코드를 실행하라는 뜻.
            continue; // 아래 코드를 실행하지 말고 for 문으로 다시 돌아가라는 뜻.
        } else { // 파일이 업로드되었다면...
// 업로드 금지 파일 식별 부분
            $filename = explode(".", $upfile_name);
            $extension = $filename[sizeof($filename) - 1];

            if (!strcmp($extension, "html") ||
                !strcmp($extension, "htm") ||
                !strcmp($extension, "php") ||
                !strcmp($extension, "inc")) {
                $msg = "업로드가 금지된 파일입니다.";
            }

// 동일한 파일이 있는지 확인하는 부분
            $target = $target_dir . "/" . $upfile_name;
            ${"target" . $num} = $target; // $num의 값에 따라 변하는 변수명 만들기
            if (file_exists($target)) {
                $msg = "동일한 파일이 있습니다.";
            }

// 지정된 디렉토리에 파일 저장하는 부분
            if (!copy($upfile, $target)) {   // false일 경우
                $msg = "파일 저장 실패";
            }

// 임시 파일을 삭제하는 부분
            if (!unlink($upfile)) { // false일 경우
                $msg = "임시 파일 삭제 실패";
            }
        } // 66행 if문 닫기
    } // 61행 for문 닫기
################파일 업로드를 위해 추가된 부분 : 끝 ######################### 

    //수정한 내용을 UPDATE합니다.
    $sql = "update $tablename set
			name='$name',email='$email',homepage='$homepage', 
			subject='$subject',memo='$memo',html='$html',br='$br' where number=$number";
    mysql_query($sql) or die (mysql_error());
    if ($upfile1 != '') {  // 첨부한 파일이 있을 경우에만 첨부파일 이름 필드 수정
        mysql_query("update $tablename set file_name1='$target1',s_file_name1='$upfile1_name' where number=$number");
    }
    if ($upfile2 != '') {  // 첨부한 파일이 있을 경우에만 첨부파일 이름 필드 수정
        mysql_query("update $tablename set file_name2='$target2',s_file_name2='$upfile2_name' where number=$number");
    }
    if ($upfile3 != '') {  // 첨부한 파일이 있을 경우에만 첨부파일 이름 필드 수정
        mysql_query("update $tablename set file_name3='$target3',s_file_name3='$upfile3_name' where number=$number");
    }

    if ($msg == '') {
        $msg = "수정을 하였습니다.";
        echo " <html><head>
		<script name=javascript>
		if('$msg' != '') {
			self.window.alert('$msg');
		}
		location.href='djboard.php?id=$id&page=$page&src_name=$src_name&src_value=$src_value';
		</script>
		</head>
		</html> ";
    } else {
        echo " <html><head>
		<script name=javascript>
		if('$msg' != '') {
			self.window.alert('$msg');
		}
		history.go(-1);
		</script>
		</head>
		</html> ";
    }


} else {
    $msg = "수정할 수 없습니다.";
    echo " <html><head>
		<script name=javascript>

		if('$msg' != '') {
			self.window.alert('$msg');
		}

		history.go(-1);

		</script>
		</head>
		</html> ";

}

?>