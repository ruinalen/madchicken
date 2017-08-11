<?
include "lib/bm_dbconfig.php";
include "lib/bm_function.php"; // 사용자 정의 함수

// 생성한 쿠키의 값의 유효기간을 생성 1시간 전으로 돌림으로써 쿠키 삭제 효과
SetCookie("cook_userid", "", time() - 3600, "/");
SetCookie("cook_username", "", time() - 3600, "/");
SetCookie("cook_useremail", "", time() - 3600, "/");
SetCookie("cook_userhome", "", time() - 3600, "/");
SetCookie("cook_sid", "", time() - 3600, "/");
SetCookie("cook_userlevel", "", time() - 3600, "/");

$msg = "정상적으로 로그아웃하였습니다.";
if ($ret_url == '') $ret_url = "logon.php";
golocation($ret_url, $msg);

?>