<?
//데이터 베이스 연결하기
include "db_info.php";
//파일업로드 관련 함수 파일
include "library.php";

// 글의 비밀번호를 가져온다.
$result=mysqli_query("select pass,filename from $board where id='$_GET[id]'", $conn);
$row=mysqli_fetch_array($result);

//입력된 값과 비교한다.
if ($_POST[pass]==$row[pass]) { //비밀번호가 일치하는 경우

	 //업로드 파일이 있으면 업로드 함수 호출 50*1024는 파일크기 제한 즉, 50KB이상은 업로드 불가
	if ($HTTP_POST_FILES[upfile][name]) 
	{	
		 $filename=upload($HTTP_POST_FILES[upfile],50*1024);
		 $add_query = ",filename='$filename' ";
		
		 //기존에 첨부된 파일이 있으면 지운다.
		 if ($row[filename]) del_file($row[filename]);
	}
	$query = "update $board set name='$_POST[name]',title='$_POST[title]',email='$_POST[email]',comment='$_POST[comment]'";
	$query .= $add_query;
	$query .= "where id='$_GET[id]' ";
	 $result=mysqli_query($query, $conn);
} 
else { // 비밀번호가 일치하지 않는 경우
	echo ("
	<script>
		alert('비밀번호가 틀립니다.');
		history.go(-1);
	</script>
	");
	exit;
}

//데이터베이스와의 연결 종료
mysqli_close($conn);

//수정하기인 경우 수정된 글로..
echo ("<meta http-equiv='Refresh' content='0; URL=read.php?id=$_GET[id]'>");

?>