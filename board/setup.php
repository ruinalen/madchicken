<?

include "lib/bm_dbconfig.php"; // DB 연결을 위한 환경 파일
include "lib/bm_function.php"; // 사용자 정의 함수

$connect = bm_dbconnect($host, $db_id, $db_passwd, $db_name); // MySQL DB 연결(사용자 정의 함수 bm_dbconnect 이용)

/*********************************
 * 기존 생성 다중 게시판 모두 삭제
 **********************************/
$sql = "select id from multiconfig";
$result = @mysql_query($sql);
while ($array = @mysql_fetch_array($result)) {
    $id = $array[id]; // 기본 테이블
    $simplereply_id = $id . "_simplereply"; // 간단한 답글 테이블
    $sql_temp = "drop table $id";
    mysql_query($sql_temp);
    $sql_temp = "drop table $simplereply_id";
    mysql_query($sql_temp);
}

/*********************************
 * 관리자 테이블(multiconfig) 생성
 **********************************/

$sql = "DROP TABLE multiconfig";
@mysql_query($sql); // 테이블이 있으면 먼저 삭제함

$sql = " 
	CREATE TABLE multiconfig (
	id varchar(50) NOT NULL,
	title varchar(100),
	upload varchar(1),
	img_file varchar(1),
	simplereply char(1),
	skin varchar(50),
	head_file varchar(50),
	head text,
	foot_file varchar(50),
	foot text,
	tbwidth varchar(10),
	tbalign varchar(10),
	list_num int(11),
	page_num int(11),
	admin_id varchar(15),
	admin_pw varchar(15),
	auth_read int(11),
	auth_write int(11),
	reg_date int(11),
	background varchar(50),
	strlen int(11),
	authlist char(2),
	authread char(2),
	authwrite char(2),
	membership char(1)
	)
	";

mysql_query($sql) or die(mysql_error() . $sql);


/*********************************
 * 회원 정보 테이블(member) 생성
 **********************************/

$sql = "DROP TABLE member";
@mysql_query($sql); // 테이블이 있으면 먼저 삭제함

$sql = "
CREATE TABLE member(
	number int NOT NULL default '1' auto_increment,
	userid varchar(15) NOT NULL,
	userpw varchar(15) NOT NULL,
	username varchar(20) NOT NULL,
	userjumin varchar(14) NOT NULL,
	useremail varchar(50),
	userhome varchar(50),
	userpost varchar(7),
	useraddr varchar(150),
	userphone varchar(15),
	userdate int(11),
	userlevel int(11),
	primary key(number)
	)
";

mysql_query($sql) or die(mysql_error() . $sql);

/*********************************
 * 관리자 페이지 바로가기
 **********************************/
$url = "admin/admin_reg.php";
$msg = "필요한 DB 테이블을 생성하였습니다.\\n관리자 등록을 하세요.";
golocation($url, $msg);


?>