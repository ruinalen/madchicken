<?
include "lib/bm_dbconfig.php"; // DB 연결을 위한 환경 파일
include "lib/bm_function.php"; // 사용자 정의 함수

if ($userpw != $userpw2) { // 비밀번호,비밀번호 확인이 다를 경우
    bm_error("입력한 두 개의 비밀번호가 다릅니다.");
    return;
}


$connect = bm_dbconnect($host, $db_id, $db_passwd, $db_name); // MySQL DB 연결(사용자 정의 함수 bm_dbconnect 이용)

$sql = "select count(number) from member where userid='$userid'"; // member 테이블에서 관리자 등록 여부 확인
$result = mysql_query($sql) or die (mysql_error() . $sql);
$row = mysql_fetch_row($result);
if ($row[0] > 0) {
    bm_error("회원 ID가 중복됩니다. 다른 ID로 가입해 주세요.");
    return;
}

if ($userjumin != '') {
    $sql = "select count(number) from member where userjumin='$userjumin'"; // member 테이블에서 관리자 등록 여부 확인
    $result = mysql_query($sql) or die (mysql_error() . $sql);
    $row = mysql_fetch_row($result);
    if ($row[0] > 0) {
        bm_error("주민등록번호가 중복됩니다.");
        return;
    }
}

// member 테이블에 새 회원 정보 입력
$sql = "insert into member
	(number,userid,userpw,username,userjumin,useremail,userhome,userpost,useraddr,userphone,userdate,userlevel)
	values (
	'','$userid','$userpw','$username','$userjumin','$useremail','$userhome',
	'$userpost','$useraddr','$userphone',UNIX_TIMESTAMP(CURRENT_TIMESTAMP),'9'
	)
	";
mysql_query($sql) or die (mysql_error() . $sql);

$msg = "감사합니다.\\n정상적으로 회원 가입 처리되었습니다.";

golocation($ret_url, $msg);

?>