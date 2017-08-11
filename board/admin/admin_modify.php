<?
if ($HTTP_COOKIE_VARS[cook_userlevel] != 1) {
    echo "관리자가 아닙니다.";
    exit;
}
?>

<?
include "../lib/bm_dbconfig.php"; // DB 연결을 위한 환경 파일
include "../lib/bm_function.php"; // 사용자 정의 함수

$title = addslashes($title);
$head = addslashes($head);
$foot = addslashes($foot);

$connect = bm_dbconnect($host, $db_id, $db_passwd, $db_name); // MySQL DB 연결(사용자 정의 함수 bm_dbconnect 이용)
$sql = "update multiconfig set title='$title', 
	upload='$upload', img_file='$img_file', simplereply='$simplereply',skin='$skin',
	head_file='$head_file',head='$head',foot_file='$foot_file',foot='$foot',
	tbwidth='$tbwidth',tbalign='$tbalign',list_num='$list_num',page_num='$page_num',
	background='$background',strlen='$strlen',authlist='$authlist',authread='$authread',authwrite='$authwrite' where id='$id'";
mysql_query($sql) or die (mysql_error() . $sql);

$url = "admin_page.php?id=$id&exec=list_board";
$msg = "수정하였습니다";
golocation($url, $msg);

?>