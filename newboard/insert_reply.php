<?
//데이터 베이스 연결하기
include "db_info.php";
//파일업로드 관련 함수 파일
include "library.php";

//1000의 배수의 글들은 모두 새글로 등록된 것이다. 이하 새글
//3000에 답글이 달려지면 2999이 될것이다. 그렇다면 어떤 값이 업데이트(-1) 되어야 할까?
//2000보다는 크고 3000보다는 작은 값이 업데이트 되어야 한다.
//2998번 글에 답글이 달려지면 2000보다 크고 2998번보다 작은 값이 업데이트 되어야 한다.

//(답글이 달려질) 원본글보다 thread 값이 작은것중에서 제일 큰 새글의 thread 값(1000의 배수다)
//원본글의 값이 1999면 1.999를 내림하여 1이 된다. 여기에 1000을 곱하니 1000이다.
//그럼 1000이란 값은 1999번 보다는 작지만 작은 수들중에 가장 큰 1000의 배수가 맞나? 아~ 맞네.
//만약 원본글에 답글이 달리는 경우는 $parent_thread 에 1000을 빼면된다.
if ($parent_thread%1000 > 0) 
	$prev_parent_thread = floor($parent_thread/1000)*1000;
else 
	$prev_parent_thread = $parent_thread - 1000;

//원본글보다는 작고 위값보다는 큰 글들의 thread 값을 모두 1씩 낮춘다.
$update_thread = mysqli_query("update $board set thread=thread-1 where thread > $prev_parent_thread and thread < $parent_thread ",$conn);

//업로드 파일이 있으면 업로드 함수 호출 50*1024는 파일크기 제한 즉, 50KB이상은 업로드 불가
if ($HTTP_POST_FILES[upfile][name]) $filename=upload($HTTP_POST_FILES[upfile],50*1024);

//원본글보다는 1작은 값으로 답글을 등록한다.
//원본글의 바로 밑에 등록되게 된다.
//depth는 원본글의 depth + 1 이다. 원본글이 3(이글도 답글이군)이면 답글은 4가된다.
$query = "insert into $board (id,thread,depth,name,pass,email,title,see,wdate,ip,comment,filename) values ('','" . ($parent_thread-1) . "'";
$query .= ",'" . ($parent_depth+1) ."','$_POST[name]','$_POST[pass]','$_POST[email]','$_POST[title]',0,";
$query .= time() . ",'$REMOTE_ADDR','$_POST[comment]','$filename')";
$result=mysqli_query($query, $conn);

//데이터베이스와의 연결 종료
mysqli_close($conn);

setCookie("Form_name",$_POST[name],99999999999,"/");
setCookie("Form_pass",$_POST[pass],99999999999,"/");


// 새 글 쓰기인 경우 리스트로..
echo ("<meta http-equiv='Refresh' content='0; URL=list.php'>");

?>