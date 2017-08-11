<?
if ($HTTP_COOKIE_VARS[cook_userlevel] != 1) {
    echo "관리자가 아닙니다.";
    exit;
}
?>

<?
include "../lib/bm_dbconfig.php"; // DB 연결을 위한 환경 파일
include "../lib/bm_function.php"; // 사용자 정의 함수

if ($userid == '' || $userpw == '' || $username == '' || $userlevel == '' || $useremail == '') {
    bm_error("ID,Password,이름,이메일,등급은 반드시 입력해야 합니다");
    return;
}

$connect = bm_dbconnect($host, $db_id, $db_passwd, $db_name); // MySQL DB 연결(사용자 정의 함수 bm_dbconnect 이용)

// 회원 ID 중복 검사

$sql = "select count(number) from member where userid='$userid'";
$result = mysql_query($sql);
$row = mysql_fetch_row($result);

if ($row[0] > 0) {
    $msg = "회원 ID가 중복됩니다.";
    bm_error($msg);
    return;
}

// 주민등록번호 중복 검사

if ($userjumin != "") {
    $sql = "select count(number) from member where userjumin='$userjumin'";
    $result = mysql_query($sql);
    $row = @mysql_fetch_row($result);

    if ($row[0] > 0) {
        $msg = "주민등록번호가 중복됩니다.";
        bm_error($msg);
        return;
    }
}

// 신규 회원 등록

$sql = "insert into member 
		(userid,userpw,username,userjumin,useremail,userhome,userpost,useraddr,userphone,userlevel,userdate)
		values
		('$userid','$userpw','$username','$userjumin','$useremail','$userhome','$userpost','$useraddr','$userphone','$userlevel',UNIX_TIMESTAMP(CURRENT_TIMESTAMP))";

mysql_query($sql) or die (mysql_error() . $sql);

$url = "admin_page.php?&exec=list_member";
$msg = "회원을 추가하였습니다.";
golocation($url, $msg);

?>