<?
include "lib/bm_dbconfig.php"; // DB 연결을 위한 환경 파일
include "lib/bm_function.php"; // 사용자 정의 함수

$tablename = $simplereply_id;

$connect = bm_dbconnect($host, $db_id, $db_passwd, $db_name); // MySQL DB 연결(사용자 정의 함수 bm_dbconnect 이용)

//입력폼(write.php)에서 전송된 내용을 변수에 담습니다.
$name = addslashes($name);
$password = addslashes($password);
$comment = addslashes($comment);

//디폴트 값이 필요한 변수에는 디폴트 값을 넣습니다.
$writetime = time();
$ip = getenv("REMOTE_ADDR");

if ($HTTP_COOKIE_VARS[cook_userid] != '') { // 로그인한 상태이면 쿠키값을 이용해 이름 자동 입력
    $name = $HTTP_COOKIE_VARS[cook_username];
    $userid = $HTTP_COOKIE_VARS[cook_userid];
} else {
    $name = '손님';
    $userid = 'guest';
}

//SQL 명령을 이용해 입력받은 내용과 디폴트값 등을 MySQL에 입력(insert)합니다.

$sql = "insert into $tablename (number,parent,name,userid,password,comment,ip,writetime)
        values('','$parent','$name','$userid','$password','$comment','$ip',$writetime)";

mysql_query($sql) or die (mysql_error() . $sql);

//글 입력이 완료되면 보기 페이지로 자동 이동하도록 합니다

if ($msg == '') {
    $msg = "성공적으로 등록되었습니다";
    echo " <html><head>
                 <script name=javascript>
                  if('$msg' != '') {
                         self.window.alert('$msg');
                 }
                 location.href='view.php?id=$id&page=$page&number=$number&src_name=$src_name&src_value=$src_value';
                 </script>
                 </head>
                 </html> ";
//	mysql_query($sql) or die (mysql_error());
} else {
    echo " <html><head>
                 <script name=javascript>
                 if('$msg' != '') {
                         self.window.alert('$msg');
                 }
                 history.go(-1);
                 </script>
                 </head>
                 </html> ";
}

?>