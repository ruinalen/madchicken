<?
if ($HTTP_COOKIE_VARS[cook_userlevel] != 1) {
    echo "관리자가 아닙니다.";
    exit;
}
?>

<?
include "../lib/bm_dbconfig.php"; // DB 연결을 위한 환경 파일
include "../lib/bm_function.php"; // 사용자 정의 함수

$connect = bm_dbconnect($host, $db_id, $db_passwd, $db_name); // MySQL DB 연결(사용자 정의 함수 bm_dbconnect 이용)

if ($userjumin != '') {
    $sql = "select count(number) from member where userjumin='$userjumin' and userid != '$userid'"; // member 테이블에서 관리자 등록 여부 확인
    $result = mysql_query($sql) or die (mysql_error() . $sql);
    $row = mysql_fetch_row($result);
    if ($row[0] > 0) {
        bm_error("주민등록번호가 중복됩니다.");
        return;
    }
}


$sql = "update member set 
		userpw='$userpw',username='$username',userjumin='$userjumin',useremail='$useremail',
		userhome='$userhome',userpost='$userpost',useraddr='$useraddr',userphone='$userphone',userlevel='$userlevel'
		where number='$number'";

mysql_query($sql) or die (mysql_error() . $sql);

$url = "admin_page.php?&exec=list_member";
$msg = "수정하였습니다";
golocation($url, $msg);

?>