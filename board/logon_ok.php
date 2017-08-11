<?
include "lib/bm_dbconfig.php"; // DB 연결을 위한 환경 파일
include "lib/bm_function.php"; // 사용자 정의 함수

$connect = bm_dbconnect($host, $db_id, $db_passwd, $db_name); // MySQL DB 연결(사용자 정의 함수 bm_dbconnect 이용)
$sql = "select * from member where userid = '$userid'"; // member 테이블에서 관리자 Password 불러옴
$result = mysql_query($sql) or die (mysql_error() . $sql);
$array = mysql_fetch_array($result);

if ($array[userpw] != $userpw || $array[userpw] == '') {
    $msg = "비밀번호가 잘못되었습니다.";
    bm_error($msg);
} else {
    SetCookie("cook_userid", $userid, 0, "/"); // 쿠키 변수명이 userid 이며, 변수에 저장하는 값은 $userid입니다, 쿠키 지속 시간은 브라우저가 닫힐 때까지. 적용 범위는 최상위 디렉토리 이하 모든 디렉토리임.
    SetCookie("cook_username", $array[username], 0, "/");
    SetCookie("cook_useremail", $array[useremail], 0, "/");
    SetCookie("cook_userhome", $array[userhome], 0, "/");
    if (!$HTTP_COOKIE_VARS[small_sid]) {
        $SID = md5(uniqid(rand())); // 세션 아이디 생성
        SetCookie("cook_sid", $SID, 0, "/");
    }
    SetCookie("cook_userlevel", $array[userlevel], 0, "/");

    $msg = "";

    golocation($ret_url, $msg);
}

?>