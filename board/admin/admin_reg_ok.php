<?
include "../lib/bm_dbconfig.php"; // DB 연결을 위한 환경 파일
include "../lib/bm_function.php"; // 사용자 정의 함수

if ($userpw != $userpw2) { // 비밀번호,비밀번호 확인이 다를 경우
    bm_error("입력한 두 개의 비밀번호가 다릅니다.");
    return;
}

$connect = bm_dbconnect($host, $db_id, $db_passwd, $db_name); // MySQL DB 연결(사용자 정의 함수 bm_dbconnect 이용)

$sql = "select count(number) from member where userlevel='1'"; // member 테이블에서 관리자 등록 여부 확인
$result = mysql_query($sql) or die (mysql_error() . $sql);
$row = mysql_fetch_row($result);

if ($row[0] > 0) {
    bm_error("이미 등록된 관리자가 있습니다.");
} else {

// multiconfig 테이블에 새 게시판 정보 입력
    $sql = "insert into member
	(number,userid,userpw,username,userjumin,useremail,userhome,userpost,useraddr,userphone,userdate,userlevel)
	values (
	'','$userid','$userpw','$username','$userjumin','$useremail','$userhome',
	'$userpost','$useraddr','$userphone',UNIX_TIMESTAMP(CURRENT_TIMESTAMP),'1'
	)
	";
    mysql_query($sql) or die (mysql_error() . $sql);

//$url = "admin_logon.php";
    $url = "../logon.php?ret_url=admin/admin_page.php";
    $msg = "관리자를 등록하였습니다.";
    golocation($url, $msg);
}
?>