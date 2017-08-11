<?
if ($HTTP_COOKIE_VARS[cook_userlevel] != 1) {
    echo "관리자가 아닙니다.";
    exit;
}
?>

<?
include "../lib/bm_dbconfig.php"; // DB 연결을 위한 환경 파일
include "../lib/bm_function.php"; // 사용자 정의 함수

if ($userid == '' || $userpw == '') {
    bm_error("ID와 Password를 모두 입력하세요");
}

$connect = bm_dbconnect($host, $db_id, $db_passwd, $db_name); // MySQL DB 연결(사용자 정의 함수 bm_dbconnect 이용)

$sql = "select userpw from member where userid='$userid' and userlevel='1'";
$result = mysql_query($sql);
$array = mysql_fetch_array($result);
if ($userpw != $array[userpw]) {
    bm_error("관리자가 아니거나, 비밀번호가 잘못되었습니다");
}

// multiconfig 테이블에서 삭제할 테이블 정보(레코드) 삭제
$sql = "delete from multiconfig where id = '$id'";
mysql_query($sql) or die (mysql_error() . $sql);

// 테이블 삭제
$sql = "drop table $id";
mysql_query($sql) or die (mysql_error() . $sql);

$url = "admin_page.php?exec=list_board";
$msg = "게시판을 삭제하였습니다";
golocation($url, $msg);

?>