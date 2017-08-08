<?
//데이터 베이스 연결하기
include "db_info.php";
//파일업로드 관련 함수 파일
include "library.php";

$result=mysql_query("select pass,filename from $board where id=$_GET[id]", $conn);
$row=mysql_fetch_array($result);

 if ($_POST[pass]==$row[pass] )
 {
	 $conndel = "delete from $board where id=$_GET[id] ";
	 $result=mysql_query($conndel, $conn);

	//첨부된 파일이 있으면 지운다.
	 if ($row[filename]) del_file($row[filename]);

 } 
 else
{
	echo ("
	<script>
	alert('비밀번호가 틀립니다.');
	history.go(-1);
	</script>
	");
	exit;
 }
?>