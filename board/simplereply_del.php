<?
include "lib/bm_dbconfig.php"; // DB 연결을 위한 환경 파일
include "lib/bm_function.php"; // 사용자 정의 함수

$connect = bm_dbconnect($host, $db_id, $db_passwd, $db_name); // MySQL DB 연결(사용자 정의 함수 bm_dbconnect 이용)

//변수
/*
$password = addslashes($password); // 로그인하지 않은 경우 패스워드 확인
*/

$simplereply_id = $id . "_simplereply"; // 간단 답변 테이블 이름

if ($HTTP_COOKIE_VARS[cook_userlevel] != '' && $HTTP_COOKIE_VARS[cook_userlevel] != '1') { // 로그인한 사용자(회원)일 경우
    //일반 회원일 경우
    $sql = "select number from $simplereply_id where number=$cmt_number and userid='$HTTP_COOKIE_VARS[cook_userid]'"; // 글을 쓴 사람과 현재 삭제하려는 사람이 동일인인지 비교
    $result = mysql_query($sql) or die (mysql_error());

    $msg = "자신의 글 이외에는 삭제할 수 없습니다.";

    if (mysql_num_rows($result)) {  //반환된 열이 있으면...
        //삭제합니다.
        $sql = "delete from $simplereply_id where number=$cmt_number";
        mysql_query($sql) or die (mysql_error());
        $msg = "삭제하였습니다.";
    }
} elseif ($HTTP_COOKIE_VARS[cook_userlevel] == '1') { // 관리자일 경우
    $sql = "select number from $simplereply_id where number=$cmt_number";
    $result = mysql_query($sql) or die (mysql_error());

    $msg = "관리자 삭제 오류";

    if (mysql_num_rows($result)) {  //반환된 열이 있으면...
        //삭제합니다.
        $sql = "delete from $simplereply_id where number=$cmt_number";
        mysql_query($sql) or die (mysql_error());
        $msg = "삭제하였습니다.";
    }
} else { // 로그인하지 않은 경우

    /*
        //비밀번호가 맞는지 확인합니다.
        $sql = "select number from $simplereply_id where number=$cmt_number and password='$password'";
        $result = mysql_query($sql) or die (mysql_error());

        $msg = "비밀번호가 틀립니다.";

        if(mysql_num_rows($result)) {  //반환된 열이 있으면...
            //삭제합니다.
            $sql = "delete from $simplereply_id where number=$cmt_number";
            mysql_query($sql) or die (mysql_error());
            $msg = "삭제하였습니다.";
        }
    */
    $msg = "로그인하지 않았습니다. 먼저 로그인하세요";
}


//메시지를 출력하고 목록 페이지로 이동합니다.
echo " <html><head>
		<script name=javascript>

		if('$msg' != '') {
			self.window.alert('$msg');
		}

		location.href='view.php?id=$id&page=$page&number=$number&src_name=$src_name&src_value=$src_value';

		</script>
		</head>
		</html> ";
?>