﻿<?
//데이터 베이스 연결하기
include "db_info.php";
//파일업로드 관련 함수 파일
include "library.php";

//새글인 경우
//현재 글에서 가장 큰 값을 가져온다.
$max_thread_result = mysqli_query("select max(thread) from $board",$conn);
$max_thread_fetch = mysql_fetch_row($max_thread_result);
$max_thread = ceil($max_thread_fetch[0]/1000)*1000+1000;

//업로드 파일이 있으면 업로드 함수 호출 50*1024는 파일크기 제한 즉, 50KB이상은 업로드 불가
if ($HTTP_POST_FILES[upfile][name]) $filename=upload($HTTP_POST_FILES[upfile],50*1024);

$query = "insert into $board values ('',$max_thread,0,'$_POST[name]','$_POST[pass]','$_POST[email]','$_POST[title]',0," . time() . ",'$REMOTE_ADDR','$_POST[comment]',0,'$filename')";
$result=mysqli_query($query, $conn);

//데이터베이스와의 연결 종료
mysql_close($conn);

setCookie("Form_name",$_POST[name],99999999999,"/");
setCookie("Form_pass",$_POST[pass],99999999999,"/");

 // 새 글 쓰기인 경우 리스트로..
echo ("<meta http-equiv='Refresh' content='0; URL=list.php'>");

?>