<?
if ($HTTP_COOKIE_VARS[cook_userlevel] != 1) {
    echo "관리자가 아닙니다.";
    exit;
}
?>

<?
include "../lib/bm_dbconfig.php"; // DB 연결을 위한 환경 파일
include "../lib/bm_function.php"; // 사용자 정의 함수

if ($id == '') {
    $msg = "게시판 ID를 입력하세요";
    bm_error($msg);
    return;
}

$title = addslashes($title);
$head = addslashes($head);
$foot = addslashes($foot);

$connect = bm_dbconnect($host, $db_id, $db_passwd, $db_name); // MySQL DB 연결(사용자 정의 함수 bm_dbconnect 이용)

// 게시판 ID 중복 검사
$sql = "select count(id) from multiconfig where id='$id'";
$result = mysql_query($sql);
$row = mysql_fetch_row($result);

if ($row[0] > 0) {
    $msg = "동일한 ID의 게시판이 이미 있습니다.";
    bm_error($msg);
    return;
}

// multiconfig 테이블에 새 게시판 정보 입력
$sql = "insert into multiconfig (
	id,title,
	upload, img_file, simplereply,skin,
	head_file,head,foot_file,foot,
	tbwidth,tbalign,list_num,page_num,
	reg_date,background,strlen,authlist,authread,authwrite,membership)
	values('$id','$title', 
	'$upload', '$img_file', '$simplereply','$skin',
	'$head_file','$head','$foot_file','$foot',
	'$tbwidth','$tbalign','$list_num','$page_num',
	UNIX_TIMESTAMP(CURRENT_TIMESTAMP),'$background','$strlen','$authlist','$authread','$authwrite','$membership') ";
mysql_query($sql) or die (mysql_error() . $sql);

//게시판 id 중복 검사 필요

// id에 해당되는 새 게시판 테이블 만들기
$sql = "CREATE TABLE $id (
	number int NOT NULL default '1' auto_increment,
	memberid varchar(20) NOT NULL,
	name varchar(10) NOT NULL,
	password varchar(15) NOT NULL,
	email varchar(50),
	homepage varchar(50),
	subject varchar(100) NOT NULL,
	memo text,
	count smallint,
	ip varchar(15),
	writetime int,
	file_name1 varchar(255),
	s_file_name1 varchar(255),
	file_name2 varchar(255),
	s_file_name2 varchar(255),
	file_name3 varchar(255),
	s_file_name3 varchar(255),
	replyno int NOT NULL,
	replyst varchar(5) NOT NULL,
	html char(1),
	br char(1),
	primary key(number)
	)
 ";

mysql_query($sql) or die (mysql_error() . $sql);


// 간단한 답변(코멘트)을 위한 연관 테이블 생성

$comment_tb = $id . "_simplereply";
$sql = "CREATE TABLE $comment_tb (
`number` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`parent` INT NOT NULL ,
`name` VARCHAR( 20 ) NOT NULL ,
`userid` VARCHAR( 20 ) NOT NULL ,
`password` VARCHAR( 60 ) NOT NULL ,
`comment` TEXT NOT NULL ,
`ip` CHAR( 15 ) NOT NULL ,
`writetime` INT NOT NULL 
) COMMENT = '$id 게시판의 코멘트 테이블'
";

mysql_query($sql) or die (mysql_error() . $sql);

$url = "admin_page.php?id=$id&exec=list_board";
$msg = "게시판을 새로 만들었습니다.";
golocation($url, $msg);

?>